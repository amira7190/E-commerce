<?php
  function lang( $phrase ){
        static $lang = array (
              'MESSAGE' => 'اهلا',
            'ADMIN' => 'ادمن',

        );
        return $lang[$phrase];

  }