<?php
    // header('Access-Control-Allow-Origin: *');
    $host = 'localhost';
    $dbName = 'tdt';
    $userName = 'root';
    $password = '';
    try{
        $dbCon = new PDO("mysql:host=".$host.";dbname=".$dbName, $userName, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => 'Unable to connect: ' . $ex->getMessage())));
    }
?>