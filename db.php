<?php
$servername = "db";
$username = "myuser";
$password = "mypassword";
$dbname = "todo";

// Create connection
$pdo = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($pdo->connect_error) {
    die("Connection failed: " . $pdo->connect_error);
}
?>
