<?php include '../db.php'; ?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];

    $sql = "UPDATE products SET 
            category_id=$category_id,
            name='$name',
            description='$description',
            price=$price,
            stock=$stock,
            image='$image'
            WHERE id=$id";

    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
    <h1>Edit Product</h1>

    <form method="POST">
        <select name="category_id" required>
            <option value="1">CPU</option>
            <option value="2">GPU</option>
            <option value="3">PSU</option>
            <option value="4">RAM</option>
            <option value="5">Storage</option>
            <option value="6">Motherboard</option>
        </select>

        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" required>
        <input type="text" name="image" value="<?php echo $product['image']; ?>" required>

        <button class="btn" type="submit" name="update">Update Product</button>
    </form>
</div>

</body>
</html>