<?php
$host = 'your_database_host';
$user = 'your_database_user';
$pass = 'your_database_password';
$db   = 'bt_tailop_db';

$conn = new mysqli("localhost", "root", "", $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
