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
    <title>session</title>
</head>
<body>
<div id="site_wrap">

    <?php
    include('nav.php');
    dbCredentials();
    $connection = mysqli_connect(HOST, USER, PASS, DB);
    $username = "";
    $password = "";
    $header = "";
    //this if statement is for displaying the header and prevents multiple headers from being displayed
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users where username= '$username' and password= '$password'";
        $results = mysqli_query($connection, $query);
        //checks if the username and password match the database
        if (mysqli_num_rows($results) > 0) {
            $_SESSION['granted'] = true;
            $_SESSION['username'] = $username;
        } else {
            $header = "Access Denied";
            echo "<h2>$header</h2>";
        }
    }
    if (isGranted() && !isset($_POST['open'])) {
        $header = "Access Granted";
        echo "<h2>$header</h2>";
        slectForm();
    }
    //this if statement is for displaying the table of agents
    if (isset($_POST['open'])) {
        $open = $_POST['open'];
        if ($open == 'fbi') {
            openFbi();
        } elseif ($open == 'spies') {
            openSpies();
        }
    }

    //if the username and password are not set it will display the form
    if (!isGranted()) {
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
    <input id='password' type='password' name='password' value='$password'> <br>
    <div class=column>
    <input type='reset' value='Reset'>
    <input type='submit' value='Submit'>
    </div>
    </form> 
    </div>";
    }


    ?>
</div>
</body>
</html>