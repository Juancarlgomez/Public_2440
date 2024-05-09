<?php
if(isset($_GET['phone'])) {
$errorNum = $_GET['phone'];
 } else { $errorNum = "";
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Number Validation</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Enter Your Phone Number</h2>
        <form action="process.php" method="POST">
            <input type="text" name="phone" placeholder="(801)123-4567" value = "<?php echo $errorNum; ?>"> <br>
        <?php
        //error if not correct format
        if(isset($_GET['error']) && $_GET['error'] == "true") {
            echo '<p class="error">Error: Phone number must be in this format (801)123-4567</p>';
        }
        //error if empty
        elseif (isset($_GET['error1']) && $_GET['error1'] == "true") {
            echo '<p class="error"> Error: Please enter a phone number </p>';
        }
        ?>
        <br>
            <button type="reset">Reset</button>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
