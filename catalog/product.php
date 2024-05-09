<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>Product</title>
</head>
<body>
<?php
include_once 'nav.php';
if (!isGranted()) {
    echo "Please <a href='index.php'>log in</a> to add items to your cart.";
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: catalog.php');
}

$id = $_GET['id'];
dbCredentials();
$connection = mysqli_connect(HOST, USER, PASS, DB);

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $productId = $_POST['id'];

    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    // Fetch product details
    $productQuery = mysqli_query($connection, 'SELECT * FROM product WHERE id = ' . $productId);
    $productDetails = $productQuery->fetch_assoc();

    if (isset($_SESSION['cart'][$productId])){
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        // Store product details and quantity in the session
        $_SESSION['cart'][$productId] = [
            'name' => $productDetails['name'],
            'price' => $productDetails['price'],
            'quantity' => $quantity
        ];
    }
    $_SESSION['message'] = "You have successfully added $quantity {$productDetails['name']} to your cart.";
}

// Display product details
$result = mysqli_query($connection,'SELECT * FROM product WHERE id = ' . $id);

if  ($product = $result->fetch_assoc()) {
    echo "<div class='inventory'>
    <h2>" . $product['name'] . "</h2>
    <p>" . $product['description'] . "</p>
    <p>Price: $" . $product['price'] . "</p>
    <img src= " . $product['image'] . " >
    <form action='product.php' method='post'>
    <input type='number' name='quantity' value='1' min='1' max='99'>
    <input type='hidden' name='id' value='" . $product['id'] . "'>
    <input type='submit' value='Add to Cart'>
    </form> 
    </div>";
}