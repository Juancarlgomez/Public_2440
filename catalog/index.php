<?php
session_start();
include_once('includes/functions.php');
include_once('includes/db.php');
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
include('nav.php');
echo "<div class='center'>";
dbCredentials();
$connection = mysqli_connect(HOST, USER, PASS, DB);
$username = "";
$password = "";
$un_hashed = "";
$header = "Log In";

//login form page
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $un_hashed = $password;
    $password = passwordHash($password);
    $query = "SELECT * FROM user where username= '$username' and password= '$password'";
    $results = mysqli_query($connection, $query);

    if (mysqli_num_rows($results) > 0) {
        $_SESSION['granted'] = true;
        $_SESSION['username'] = $username;
        header('Location: .'); //webpage refresh, updates the nav

    } else {
        $header = "Access Denied";
    }

}
if (!isGranted()) {
    echo "<h2>$header</h2>";
    echo "
    <div class='main'>
            <form action='.' method='post'>
            <label for='username'>User Name:</label>
            <input id='username' type='text' name='username' value='$username'><br>
            <label for='password'>Password:</label>
            <input id='password' type='password' name='password' value='$un_hashed'> <br>
            <div class=column>
            <input type='reset' value='Reset'>
            <input type='submit' value='Submit'>
            </div>
            </form>
            need an account? <a href='create-account.php'>Create Account</a>
            </div>";
} else {
    $username = $_SESSION['username'];
    echo "<h2>Welcome to our store $username</h2>
    <p> view our <a href='catalog.php'>catalog</a></p>";

}
echo "</div>";
?>

</body>
</html>