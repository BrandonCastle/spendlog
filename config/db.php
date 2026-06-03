<?php
$host = 'localhost';
$db   = 'spendlog';
$user = 'spendlog';
$pass = 'spendlog123';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
