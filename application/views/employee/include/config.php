<?php
    // Create connection
    //$con = new mysqli("localhost", "", "", "");
    $con = new mysqli("localhost", "root", "", "crm_db");
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
?>