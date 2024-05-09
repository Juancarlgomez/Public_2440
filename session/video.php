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
    <title>Video</title>
</head>
<body>
<div id="site_wrap">
    <?php
    include('nav.php');
    ?>
    <h2>Video</h2>
    <div class="main">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=6Ps1ekYFF4PPpHsW&autoplay=1"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
</div>
</body>
</html>