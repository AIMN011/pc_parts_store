<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT products.*, categories.name AS category_name 
        FROM products 
        JOIN categories ON products.category_id = categories.id 
        WHERE products.id = $id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="about.php">About</a>
    <a href="cart.php">Cart</a>
    <a href="my_orders.php">My Orders</a>
    <a href="login.php">Login</a>
</div>

<div class="container">
    <div class="card">
        <img src="images/<?php echo $product['image']; ?>">
        <h2><?php echo $product['name']; ?></h2>
        <p>Category: <?php echo $product['category_name']; ?></p>
        <p><?php echo $product['description']; ?></p>
        <p>Price: RM <?php echo $product['price']; ?></p>
        <p>Stock: <?php echo $product['stock']; ?></p>
        <a class="btn" href="cart.php?id=<?php echo $product['id']; ?>">Add to Cart</a>
    </div>
</div>

</body>
</html>