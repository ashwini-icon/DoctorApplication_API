<?php
$servername = "mysql:unix_socket=/cloudsql/doctor-mobile-application:asia-south1:doctor-app;dbname=doctor_app";
$username = "root";
$dbname = "doctor_app";
$password = "123456";
try {
    $db = new PDO($servername, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        die(json_encode(array('outcome' => true)));
}
catch(PDOException $e) {
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
    echo("Can't open the database.". $e);
}


