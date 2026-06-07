<?php
$conn = mysqli_connect("localhost", "root", "", "pc_parts_store");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
?>