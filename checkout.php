<?php include 'db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];
    $total = 0;

    foreach ($_SESSION['cart'] as $id => $quantity) {
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
        $total += $product['price'] * $quantity;
    }

    mysqli_query($conn, "INSERT INTO orders (user_id, total) VALUES ($user_id, $total)");
    $order_id = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $id => $quantity) {
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
        $price = $product['price'];

        mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) 
                             VALUES ($order_id, $id, $quantity, $price)");
    }

    unset($_SESSION['cart']);
    header("Location: my_orders.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="cart.php">Cart</a>
    <a href="my_orders.php">My Orders</a>
</div>

<div class="container">
    <h1>Checkout</h1>
    <form method="POST">
        <p>Click confirm to place your order.</p>
        <button class="btn" type="submit" name="checkout">Confirm Order</button>
    </form>
</div>

</body>
</html>