<?php

     $dsn ='mysql:host=ecom.test; dbname=shop' ;   //Data Source name
     $user = 'root'; //the user to connect
     $pass = '12345678';  //password of this user
     $options = array(
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' , 
     );
        
     
     try {
     
         $con = new PDO($dsn , $user , $pass , $options);   //start a new connection with PDO class
         $con->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
         //$q = "INSERT INTO items (name) VALUES ('منتج٣)";
         //$db ->exec($q);
     
         //echo "you are connected welcome to database";
     
     }
     catch(PDOException $e){
     
         echo 'failed' . $e->getMessage();
     }
     