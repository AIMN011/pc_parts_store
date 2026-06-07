<?php include '../db.php'; ?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
}

if (isset($_POST['add'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products (category_id, name, description, price, stock, image)
            VALUES ($category_id, '$name', '$description', $price, $stock, '$image')";
    mysqli_query($conn, $sql);

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="container">
    <h1>Add Product</h1>

    <form method="POST">
        <select name="category_id" required>
            <option value="1">CPU</option>
            <option value="2">GPU</option>
            <option value="3">PSU</option>
            <option value="4">RAM</option>
            <option value="5">Storage</option>
            <option value="6">Motherboard</option>
        </select>

        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="number" name="stock" placeholder="Stock" required>
        <input type="text" name="image" placeholder="Image name example cpu1.jpg" required>

        <button class="btn" type="submit" name="add">Add Product</button>
    </form>
</div>

</body>
</html>