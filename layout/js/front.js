$(function(){
     'use strict';
     //switch between login & sign //
     $('.login-page h1 span').click(function(){
      $(this).addClass('selected').siblings().removeClass('selected');
      $('.login-page form').hide();
      $('.' + $(this).data('class')).fadeIn(100);
     });

     //Hide Placeholder On Form Focus

     $('[placeholder]').focus(function(){

       $(this).attr('data-text' , $(this).attr('placeholder'));
       $(this).attr('placeholder','');


     }).blur(function(){
         $(this).attr('placeholder', $(this).attr('data-text'));
     });

     //Add Asterisk on required field //
     $('input').each (function(){
          if($(this).attr('required') === 'required' ){
            $(this).after('<span class = "asterisk">*</span>');
          }


     });
     
     //Confirmation Message On Button
     $('.confirm').click(function(){

      return confirm ('Are You Sure?');


     });


});