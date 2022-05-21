<?php
    $server = "localhost";
    $user = "sixletters";
    $password = "turner1970";

    $db = new mysqli($server, $user, $password,"turner-record-company");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    //echo "Connected successfully";
?>