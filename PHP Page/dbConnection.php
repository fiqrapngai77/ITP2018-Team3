<?php
    session_start();
    $name = "";
    $servername = "den1.mysql4.gear.host";
    $username = "pestbuster";
    $password = "Bq3!-9Y6v678";
    $dbname = "pestbuster";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    ?>
