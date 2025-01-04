<?php
     $mysqli = new mysqli("127.0.0.1", "root", "", "db_inventaris");

     if ($mysqli->connect_error) {
         die("Connection failed: " . $mysqli->connect_error);
     }
     echo "Connected successfully";
     ?>
