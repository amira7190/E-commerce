<?php
  function lang( $phrase ){
        static $lang = array (
           //   'MESSAGE' => 'welcome',
           // 'ADMIN' => 'administrator',
           //Dashboard page :
           'HOME_ADMIN' => 'admin area',

        );
        return $lang[$phrase];

  }