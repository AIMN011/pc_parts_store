<?php include 'db.php'; ?>

<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    header("Location: cart.php");
}

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="cart.php">Cart</a>
    <a href="checkout.php">Checkout</a>
</div>

<div class="container">
    <h1>Shopping Cart</h1>

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php
        $grand_total = 0;

        foreach ($_SESSION['cart'] as $id => $quantity) {
            $sql = "SELECT * FROM products WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            $product = mysqli_fetch_assoc($result);

            $total = $product['price'] * $quantity;
            $grand_total += $total;
        ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td>RM <?php echo $product['price']; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>RM <?php echo $total; ?></td>
            <td><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></td>
        </tr>
        <?php } ?>

        <tr>
            <th colspan="3">Grand Total</th>
            <th colspan="2">RM <?php echo $grand_total; ?></th>
        </tr>
    </table>

    <br>
    <a class="btn" href="checkout.php">Checkout</a>
</div>

</body>
</html>