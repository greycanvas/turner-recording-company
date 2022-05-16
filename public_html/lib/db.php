<?php
    $server = "localhost";
    $user = "root";
    $password = "sixletters";

    $db = new mysqli($server, $user, $password,"turner-record-company");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    //echo "Connected successfully";
?>