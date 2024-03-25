<?php
     /*
** Title of the page if exist
** default title if not exist
*/

   function getTitle() {

    global $pageTitle ;

    if(isset($pageTitle)){

         echo $pageTitle;

    } else {

         echo 'Default';
    }
   }