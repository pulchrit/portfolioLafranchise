/* JQuery for www.melissalafranchise.com */

// ------------------------JQuery for accordian left navigation menu ------------------------ 

$(document).ready(function(){

    $("#accordmenu ul ul li:odd").addClass("odd");
    
    $("#accordmenu ul ul li:even").addClass("even");
    
    $("#accordmenu > ul > li > a").click(function() {

        var checkElement = $(this).next();
      
        $("#accordmenu li").removeClass("active");
        
        $(this).closest("li").addClass("active"); 
      
        if((checkElement.is("ul")) && (checkElement.is(":visible"))) {
        
            $(this).closest("li").removeClass("active");
        
            checkElement.slideUp("normal");
            
            $("#minus").text("+")

        }
        
        if((checkElement.is("ul")) && (!checkElement.is(":visible"))) {
        
            $("#accordmenu ul ul:visible").slideUp("normal");
            
        
            checkElement.slideDown("normal");
            
            $("#minus").text("-")
        
        }

});
    
});

// ------------------------End JQuery for accordian left navigation menu ------------------------ 
