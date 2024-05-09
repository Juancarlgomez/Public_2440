<?php
session_start();
include('includes/functions.php');
if (!isGranted()) {
    header('location:.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Account</title>
</head>
<body>
<div id="site_wrap">
    <?php
    include('nav.php');
    dbCredentials();
    $connection = mysqli_connect(HOST, USER, PASS, DB);

    $username = $_SESSION['username'];
    $query = "SELECT image FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['image'];
    ?>
    <!--echo the $username with the first letter capitalized-->
    <h2><?php echo "Welcome " . ucfirst($username); ?></h2>
    <div class="main">
        <div class="profile">
            <img src="<?php echo $imagePath; ?>" alt="profile picture">
        </div>
    </div>
</div>
</body>
</html>