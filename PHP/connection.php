<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password
$dbname = "college_db";


$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

session_start();
?>