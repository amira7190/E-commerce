<?php
  function lang( $phrase ){
        static $lang = array (
           //   'MESSAGE' => 'welcome',
           // 'ADMIN' => 'administrator',
           //NAVBAR LINKS:
           'HOME_ADMIN'        =>  'Home',
           'CATEGORIES'        =>  'Categories',
           'ITEMS'             =>  'Items',
           'MEMBERS'           =>  'Members',
           'STATISTICS'        =>  'Statistics',
           'LOGS'              =>  'Logs', 

        );
        return $lang[$phrase];

  }