<?php
session_start();
include 'includes/functions.php';
include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>Catalog</title>
</head>
<body>
<?php
include 'nav.php';
if (isset($_SESSION['message'])) {
    echo "<div class='message'>" . $_SESSION['message']. "</div>";
    unset($_SESSION['message']);
}

dbCredentials();
$connection = mysqli_connect(HOST, USER, PASS, DB);
$result = mysqli_query($connection, "SELECT * FROM product");

While ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='inventory'>
    <h2 class='item'>" . $row['name'] . "</h2>
    <p class='description'>" . $row['description'] . "</p>
    <p><strong> Price: $" . $row['price'] . "</strong></p>
    <img src= " . $row['image'] . " >
    <a href='product.php?id=" . $row['id'] . "' class='button'>View Product</a>
    </div>";
}
?>

</body>
</html>