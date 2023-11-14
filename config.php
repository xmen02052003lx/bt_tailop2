<?php
$conn = new mysqli("localhost", "root", "", 'bt_tailop_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
