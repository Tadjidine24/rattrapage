<?php
$servername = "localhost";
$username = "root";
$password = "Tadjidine24";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=meetic;charset=utf8" , $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $GLOBALS['bdd'];
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}