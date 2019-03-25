//Wait for page to fully load before enabling javascript
$(document).ready(function() {

   //Jquery click function when Click for quote is clicked
   $("#get_quote").click(function() {
      //Use ajax call to perform cross-domain API call from forismatic.com
      $.ajax({
         //Named the callback function as a parameter per forismatic instructions, jsonp=callback=?
         //Leave ? so that Jquery will automatically replace it with the temporary callback function name
         url: "http://api.forismatic.com/api/1.0/?method=getQuote&format=jsonp&lang=en&jsonp=callback=?",
         //Specify datatype here even though it is also passed in the url as format. I get a cross-domain error if I do not specify jsonp as dataType here.
         dataType: "jsonp",
         //Again, specify this is a Get even though get is also specified in url
         type: "GET",
         //Write the function that manages the data returned through the API when the call is successful
         success: function(data) {
              //Create html variable to hold html and data from API
              var html = "";
              //Start building html with data from API
              html = "<p class='quote_text'>" + data.quoteText + "</p>";

              //Add if statement to handle anonymous quotes, forismatic returns an empty string instead of attributing to "anonymous"
              if (data.quoteAuthor === "") {
                  html += "<p class='byline'>&#126; Anonymous</p>";
              } else {
                  html += "<p class='byline'>&#126; " + data.quoteAuthor + "</p>";
              }
              //Use Jquery to add built-up html to quote_area
              $("#quote_area").html(html);
          } //End of success function
      }); //End of ajax API call function

   }); //End of click function

}); //End of document.ready function
