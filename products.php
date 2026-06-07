<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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
    <h1>Computer Parts</h1>

    <?php
    $sql = "SELECT products.*, categories.name AS category_name 
            FROM products 
            JOIN categories ON products.category_id = categories.id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="card">
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['category_name']; ?></p>
            <p>RM <?php echo $row['price']; ?></p>
            <p>Stock: <?php echo $row['stock']; ?></p>
            <a class="btn" href="product_details.php?id=<?php echo $row['id']; ?>">View Details</a>
        </div>
    <?php } ?>

</div>

</body>
</html>