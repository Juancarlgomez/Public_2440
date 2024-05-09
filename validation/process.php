<?php
$phoneNum = "";
$errorNum = "";

if (!empty($_POST['phone']) && preg_match('/^\(\d{3}\)\d{3}-\d{4}$/', $_POST['phone'])) {
    $phoneNum = $_POST['phone'];

} elseif (!empty($_POST['phone'])) {
    $errorNum = $_POST['phone'];
    header('location: .?error=true&phone=' . $errorNum);
} else {
    $errorNum = $_POST['phone'];
    header('location: .?error1=true&phone=' . $errorNum);
}
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Phone Number Validation</title>
    <link rel='stylesheet' href='css/style.css'>
</head>
<body>
    <div class='container'>
<p>Thank you! Your phone number $phoneNum is valid.</p>
    </div>
</body>
</html>";