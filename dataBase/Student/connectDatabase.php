<?php
    $severname = 'localhost';
    $username = 'root';
    $pass = '';
    $databasename = 'student';

    $conn = new mysqli($severname, $username, $pass, $databasename);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected";