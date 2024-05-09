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
    <title>users</title>
</head>
<body>
<div id="site_wrap">
    <!--When clicking on "users" it shows the username and password for all users as they are stored in the database-->
    <?php
    include('nav.php');
    ?>
    <h2>Users</h2>
    <div class="main">
        <?php
        dbCredentials();
        $connection = mysqli_connect(HOST, USER, PASS, DB);
        $query = "SELECT * FROM secureusers";
        $results = mysqli_query($connection, $query);
        echo "<table class='users'>";
        echo "<tr><th>Username</th><th>Password</th></tr>";
        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr><td>" . $row['username'] . "</td><td class='tablePass'>" . $row['password'] . "</td></tr>";
        }
        echo "</table>";
        ?>
    </div>

</body>
</html>