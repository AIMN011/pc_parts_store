<?php include '../db.php'; ?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: dashboard.php");
?>