<?php 

    try {
        //host
        if(!defined('HOSTNAME')) define("HOSTNAME", "localhost");

        //DBNAEM
        if(!defined('DBNAME')) define("DBNAME", "homeland");

        //user
        if(!defined('USER')) define("USER", "root");

        //pass
        if(!defined('PASS')) define("PASS", "");

        $conn = new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME.";", USER, PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }  