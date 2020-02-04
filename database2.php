<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$username = 'gary';  // Your username provided by instructor
$password = 'gary';  // Your password provided by instructor
$dsn = "mysql:host=localhost;dbname=diver";
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
//    include('/var/www/cweb146/database_error.php');
    exit();
}

?>