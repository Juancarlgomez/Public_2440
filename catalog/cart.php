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
dbCredentials();
$connection = mysqli_connect(HOST, USER, PASS, DB);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $productId => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION['cart'][$productId]);
            } else {
                $_SESSION['cart'][$productId]['quantity'] = $quantity;
            }
        }
    } elseif (isset($_POST['place_order'])) {
        echo "<div class='center'>";
        echo "<h2>Thank you for your order!</h2>";
        echo "<p>You ordered:</p>";
        foreach ($_SESSION['cart'] as $productId => $productDetails) {
            echo "<p>{$productDetails['quantity']} x {$productDetails['name']}</p>";
        }
        unset($_SESSION['cart']);
        exit;
    }
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty";
} else {
    echo "<form action='cart.php' method='post'>
    <table>
    <tr>
        <th>Product</th>
        <th>Price per unit</th>
        <th>Quantity</th>
        <th>Total price</th>
    </tr>";

    $totalCartPrice = 0;
    foreach ($_SESSION['cart'] as $productId => $productDetails) {
        $totalPrice = $productDetails['price'] * $productDetails['quantity'];
        $totalCartPrice += $totalPrice;

        echo "<tr>
        <td>{$productDetails['name']}</td>
        <td>{$productDetails['price']}</td>
        <td><input type='text' name='quantity[{$productId}]' value='{$productDetails['quantity']}'></td>
        <td> $ {$totalPrice}</td>
        </tr>";
    }

    echo "<tr>
    <td colspan='3'>Total</td>
    <td> $ {$totalCartPrice}</td>
    </tr>
    </table>
    <input type='submit' name='update_cart' value='Update Cart'>
    <input type='submit' name='place_order' value='Place Order'>
    </form>";
}
?>
</body>
</html>
