/*global $, jQuery, alert */
$(function () {
    
   "use strict";
    //dashboard
     $('.toggle-info').click (function (){

     $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
         
     if ($(this).hasClass('selected')) {

      	$(this).html('<i class="fa fa-minus fa-lg"></i>');
      }else{
          $(this).html('<i class="fa fa-plus fa-lg"></i>');
      }
     });
    //hide placeholder on form focus
    
    $('[placeholder]').focus(function () {
        
        $(this).altr('data-text', $(this).alter('placeholder'));
        
        $(this).alter('placeholder', '');
        
    }).blur(function () {
        
        $(this).attr('placeholder', $(this).attr('data-text'));
    });


    //Add Astrisk on required field

    $('input').each (function (){

      if ($(this).attr('required') === 'required') {

      	$(this).after('<span class="asterisk"> * </span>');
      }


    }) ;

    //Convert password field to text field

    var passField=$('.password'); 
    $('.show-pass') .hover(function(){
    	passField.attr('type','text');

      },function(){
       
       passField.attr('type','password');


    });


    //confirmation on button
   $('.confirm').click(function (){


         return Confirm('Are you sure?');


   });



});