<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
    <title>Poll</title>
</head>
<body>
<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '1550');
    define('DB', 'poll');
} else {
    define('HOST', 'remote-host');
    define('USER', 'user');
    define('PASS', 'password');
    define('DB', ' database');
}

$connection = mysqli_connect(HOST, USER, PASS, DB);

$query = "SELECT * FROM colors";
$results = mysqli_query($connection, $query);

if (!isset($_POST['color'])) {
    echo " <h1>Welcome to the color voting poll</h1>";
    echo "<div class='form-container'>";
    echo "<form action='.' method='post'>";
    echo "<h3>What is your favorite color?<img src='img/background.png' class='thumbnail' alt='background image'></h3>";
    $colorOptions = ['red', 'green', 'blue', 'yellow',];
    foreach ($colorOptions as $colorOption) {
        echo "<input type='radio' name='color' value='$colorOption' id='$colorOption'>
        <label for='$colorOption' class='$colorOption'>" . ucfirst($colorOption) . "</label>
        <br>";
    }
    echo "<input onclick='customColor();' type='radio' name='color' value='other' id='customColorOption'>";
    echo "<label for='customColorOption' class='other'>Other</label>";
    echo "<input type='text' name='other' id='customColor' placeholder='Enter your favorite color' disabled>";
    if (isset($_GET['error']) && $_GET['error'] == 'empty') {
        echo "<h3 class='warning'>Please enter a color</h3>";
    }
    echo "<br><input type='submit' value='Submit'>";
    echo "</form></div>";
} else {
    $colorSelect = $_POST['color'];
    if ($colorSelect === 'other') {
        if (!empty($_POST['other'])) {
            $colorSelect = $_POST['other'];
        } else {
            header("Location: .?error=empty");
            exit();
        }
    }
    $colorSelect = mysqli_real_escape_string($connection, $colorSelect);
    // Check if the color already exists in the database
    $query = "SELECT * FROM colors WHERE color_name = '$colorSelect'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the color exists, update the vote count
        $query = "UPDATE colors SET votes = votes + 1 WHERE color_name = '$colorSelect'";
    } else {
        //color should all be lowercase
        $colorSelect = strtolower($colorSelect);
        // If the color doesn't exist, insert a new row with a vote count of 1
        $query = "INSERT INTO colors (color_name, votes) VALUES ('$colorSelect', 1)";
    }
    mysqli_query($connection, $query);
    echo "<h1>Thanks for voting!</h1>
        <div class='center'>
        <div class= 'vote-container'>
        <h3> vote results </h3>";
    $query = "SELECT * FROM colors";
    $results = mysqli_query($connection, $query);
    $colors = [];
    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        $colors[] = [$row['color_name'], $row['votes']];
    }

    $totalVotes = array_sum(array_column($colors, 1));
    $votes = array_combine(array_column($colors, 0), array_column($colors, 1));
    arsort($votes);
    foreach ($votes as $color => $vote) {
        $percentage = round(($vote / $totalVotes) * 100);
        echo "<p class='$color'>" . ucfirst($color) . ": $percentage%</p>";
    }
    echo "</div>";
    echo "<div class= 'chart-container'>";
    echo "<h3>Vote Chart</h3>";
    echo "<div class='chart'>";
    foreach ($colors as $color) {
        $colorName = $color[0];
        $colorVotes = $color[1];
        $percentage = round(($colorVotes / $totalVotes) * 100);
        echo "<div style='width: $percentage%; background-color: $colorName; height: 60px;'>$colorName</div>";
    }
    echo "</div></div>";
}
?>

</body>
</html>