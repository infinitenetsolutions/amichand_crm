<?php 
   // session_start();
    date_default_timezone_set("Asia/Kolkata");
    require_once("database-class.php");
    require_once("setting.php");
    ini_set('max_execution_time', 0);
    $databaseObj = new DATABASE("localhost", "root", "", "crm_db");
    $databaseObj_sec = new DATABASE("localhost", "root", "", "crm_db");
    $setting = new SETTING($databaseObj);
    $databaseObj->error();
?>