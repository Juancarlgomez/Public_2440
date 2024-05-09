<?php
session_start();
include('includes/functions.php');
include('includes/db.php');
$header = "Create Account";
$username = "";
$un_hashed = "";
$verifyPassword = "";
$account_created = false;

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verifyPassword'];
    $un_hashed = $password;

    if ($password == $verifyPassword) {
        dbCredentials();
        $connection = mysqli_connect(HOST, USER, PASS, DB);
        $password = passwordHash($password); //hash the password
        $check = "SELECT * FROM user WHERE username = '$username'";
        $results = mysqli_query($connection, $check);

        if (mysqli_num_rows($results) > 0) {
            $header = "User already exists";
        } else {
            $query = 'INSERT INTO user (username, password) VALUES ("' . $username . '", "' . $password . '")';
            mysqli_query($connection, $query);
            mysqli_close($connection);
            $header = "User Account Created";

        }
    } else {
        $header = "Passwords do not match";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    <title>Create Account</title>
</head>
<body>
<?php
include('nav.php');
echo "<div class='center'>";
if ($header == "User already exists" || $header == "Passwords do not match") {
    $header = "<div class='warning'> $header </div>";
} elseif ($header == "User Account Created") {
    $header = "<div class='success'> $header </div>";
    $account_created = true;
}
echo "<h2> $header </h2>"; ?>
<div class="main">
    <div id="feedback"></div>
    <?php
    if (!$account_created) {
        echo "<form action='create-account.php' method='post'>
    <label for='username'>Username:</label>
    <input type='text' id='username' name='username' required value='$username'>
    <br>
    <label for='password'>Password:</label>
    <input type='password' id='password' name='password' required value='$verifyPassword'>
    <br>
    <label for='verifyPassword'>Verify Password:</label>
    <input type='password' id='verifyPassword' name='verifyPassword' required value='$verifyPassword'>
    <br>
    <div class='column'>
        <input type='submit' value='Create Account'>
        <input type='reset' value='Reset'>
        </div>
        </form>";
    }

    echo "<a class='button' href='.'>Login here </a>";
    echo "</div>";
    ?>
</body>
</html>