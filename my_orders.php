<?php include 'db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id=$user_id ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="cart.php">Cart</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h1>My Orders</h1>

    <table>
        <tr>
            <th>Order ID</th>
            <th>Total</th>
            <th>Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>RM <?php echo $row['total']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>