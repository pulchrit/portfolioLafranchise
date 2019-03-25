// Javascript for weatherreport index.html

// Use Google map of user location as background following instructions provided here http://www.labnol.org/internet/embed-google-maps-background/28457/
// Use New York City lat/long as default
// Get lat and long of user using navigator and geolocation and reset center of map to lat/long

var map;

    function initMap() {
       // Constructor creates a new map
       // Use New York City as default lat/long
         map = new google.maps.Map(document.getElementById("google_map"), {
            center: {lat: 40.730610, lng: -73.935242},
            zoom: 9
         });
     }
// Prompt user to enable location access; get user's lat/lng
if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(position) {

      var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
       };
       // Re-set center of map based on user's lat/lng
       map.setCenter(pos);

       var lat = position.coords.latitude;
       var lon = position.coords.longitude;

       // Ajax call for OpenWeatherMap: https://openweathermap.org/current
       $.ajax({
          url: "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + lon + "&units=imperial&APPID=d3964a45d06264825164f78a5f5e4543",
          dataType: "json",
          success: function(json) {
            console.log(json);

            var location = json.name;
            $("#city").html(location);

            var temp_f = Math.floor(json.main.temp) + "&deg;F / <a id='get_C'>Change to &deg;C</a>";
            var temp_c = (parseInt(temp_f) - 32) * 5/9; 
            var temp_c_string = Math.floor(temp_c) + "&deg;C / <a id='get_F'>Change to &deg;F</a>";
            $("#toggle-temp").html(temp_f);

            /*Toggle function based on: https://www.html5andbeyond.com/jquery-toggle-click-function-simple-solution/ Thank you. Thank you. Thank you.*/
            $('#toggle-temp').on('click',function(){

              if($(this).attr('data-click-state') == 1) {
                $(this).attr('data-click-state', 0);
                $(this).html(temp_f);
              } else {
                $(this).attr('data-click-state', 1);
                $(this).html(temp_c_string);
              }

            });

            var weather = json.weather[0].description;
            $("#weather_desc").html(weather);

            var icon = "<img src='https://openweathermap.org/img/w/" + json.weather[0].icon + ".png' alt='" + weather + " icon'>";
            $("#icon").html(icon);

            var openWeatherMapLink = "Weather data provided by <a href='https://openweathermap.org/'>OpenWeatherMap</a>";
            $("#weather-data-provider").html(openWeatherMapLink);
          }
       });
    });
}
