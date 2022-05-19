<?php

define('DB_SERVER', 'localhost'); 
define('DB_USERNAME', 'asarraxy');
define('DB_PASSWORD', 'd70A8zr4Kl');
define('DB_NAME', 'asarraxy_damn-main-db');

 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERREUR : " . mysqli_connect_error());
};
date_default_timezone_set('Europe/Paris');

/*
if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

*/


$sql = "CREATE TABLE authorized_users (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_username VARCHAR(30) NOT NULL,
    user_email VARCHAR(30) NOT NULL,
    user_password VARCHAR(30) NOT NULL,
    verification INT NOT NULL,
    verification_token VARCHAR(30) NOT NULL,
    password_reset INT NOT NULL,
    password_reset_token VARCHAR(30) NOT NULL
    )";
    
if ($conn->query($sql) === TRUE) {
};