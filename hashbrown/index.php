<?php
session_start();
include('includes/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>hashbrown</title>
</head>
<body>
<div id="site_wrap">

    <?php
    include('nav.php');
    dbCredentials();
    $connection = mysqli_connect(HOST, USER, PASS, DB);
    $username = "";
    $password = "";
    $un_hashed = "";
    $header = "";

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $un_hashed = $password;
        $password = passwordHash($password);
        $query = "SELECT * FROM secureusers where username= '$username' and password= '$password'";
        $results = mysqli_query($connection, $query);

        if (mysqli_num_rows($results) > 0) {
            $_SESSION['granted'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['login_attempts'] = 0;
            //add to database the amount of times logged in
            $query = "SELECT * FROM secureusers where username= '$username'";
            $results = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($results);
            $login_count = $row['login_count'];
            $login_count++;
            $query = "UPDATE secureusers SET login_count = '$login_count' WHERE username = '$username'";
            mysqli_query($connection, $query);
        } else {
            $header = "Access Denied";
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] != 3) {
            echo "<h2><div class='warning'>$header</div></h2>";
            }
        }
    }

    if (isGranted() && !isset($_POST['open'])) {
        $header = "Access Granted";
        $username = $_SESSION['username'];
        $query = "SELECT * FROM secureusers where username= '$username'";
        $results = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($results);
        $login_count = $row['login_count'];
        echo "<h2><div class='success'>$header</div></h2>";

        echo "<h3>Welcome <div class='success'>&nbsp;".ucfirst($_SESSION['username'])."</div>&nbsp;Times logged on:<div class='success'>&nbsp;".$login_count. "</div></h3>";
        slectForm();
    }

    if (isset($_POST['open'])) {
        $open = $_POST['open'];
        if ($open == 'fbi') {
            openFbi();
        } elseif ($open == 'spies') {
            openSpies();
        }
    }

    if (!isGranted()) {
        if ($_SESSION['login_attempts'] >= 3) {
            $header = "Account Locked";
            echo "<h2><div class='warning'>$header</div></h2>";
        } else {
            if (!$header == "Access Denied") {
                $header = "Welcome";
                echo "<h2>$header</h2>";
            }
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
            </div>";
        }
    }
    ?>
</div>
</body>
</html>