/*global $, jQuery, alert */
$(document).ready(function () {
    
    "use strict";
    
    //nice scroll
    $("html").niceScroll();
   
    

    $('.carousel').carousel({
        
        interval: 3000 //Time of slider changed photo 3 second
        
    });
    
    //Show Color Option Div When Click On The Gear
    
    $(".gear-check").click(function () {
        
        $('.color-option').fadeToggle();

    });
    
    //Change Theme Color on Click
    
    var colorLi = $(".color-option ul li"),
        scrollButton = $("#scroll-top");
    
    colorLi
         .eq(0).css("backgroundColor", "#E41B17").end()
         .eq(1).css("backgroundColor", "#E426D5").end()
         .eq(2).css("backgroundColor", "#009AFF").end()
         .eq(3).css("backgroundColor", "#FFD500").end()
         .eq(4).css("backgroundColor", "#3fad2c");
    
    colorLi.click(function () {
         
        $("link[href*='theme']").attr("href", $(this).attr("data-value"));
    });
    //caching the scroll top element
    
    
       
    $(window).scroll(function () {
        
        if ($(this).scrollTop() >= 700) {
            
            scrollButton.show();
        } else {
                
            scrollButton.hide();
        }
    });
    
    //click on button to scroll top
    
    scrollButton.click(function () {
        
        $("html,body").animate({ scrollTop: 0 }, 600);
                            
    });
});

//loading page
$(window).load(function () {
    "use strict";
    $(".loading-overlay .sk-circle").fadeOut(1000,
          function () {
        //show the scroll  
            $("body").css("overflow", "auto");
            $(this).parent().fadeOut(1000,
                function () {
                    $(this).remove();
    
                });
        });
});























