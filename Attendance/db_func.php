<?php

    function openDb(){
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "class";
        $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    
    return $mysqli;
    }
