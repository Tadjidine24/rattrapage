<?php

// $username  = 'root';
// $password  = 'Tadjidine24';
require_once __DIR__.'/config.php';
try {

    $conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $GLOBALS['conn'];
    echo 'Connextion reussi !'; 

} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";

    die();

}