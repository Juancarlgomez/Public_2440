<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User Input</title>
</head>
<body>
<div class="center">
    <div class='container'>
        <?php

// if any part of the form is filled out, Thank you message will be displayed
if (!empty($_POST['fname']) || !empty($_POST['lname']) ||
    !empty($_POST['phone']) || !empty($_POST['email'])) {
    echo " <h2 class='thank_mgs'> Thank you! </h2>";

    // display first name if first name is filled out
    if (!empty($_POST['fname'])) {
        echo " Name: " . $_POST['fname'];
    }

    // display last name if last name is filled out
    if (!empty($_POST['lname'])) {
        echo " " . $_POST['lname'] . "<br>";
    }

    // display email if email is filled out
    if (!empty($_POST['email'])) {
        echo " Email: " . $_POST['email'] . "<br>";
    }

    // display phone if phone is filled out
    if (!empty($_POST['phone'])) {
        echo " Phone: " . $_POST['phone'] . "<br>";
    }

    // else display the form
} else {
    echo "<form action='index.php' method='POST'>";

    // first name input
    echo "<label for='fname'>First Name</label> <br>
                <input id='fname' type='text' name='fname' placeholder='John'> <br>";

    // last name input
    echo "<label for='lname'>Last Name</label> <br>
                <input id='lname' type='text' name='lname' placeholder='Doe'> <br>";

    // email input
    echo "<label for='email'>Email</label> <br>
                <input id='email' type='text' name='email' placeholder= Johndoe@gmail.com> <br>";

    // phone number input
    echo "<label for='phone'>Phone Number</label> <br>
                <input id='phone' type='text' name='phone' placeholder='801-123-4567'> <br>
                <div class='buttons'>
                    <input type='submit' value='Submit'>
                    <input type='reset' value='Reset'>
                </div>
                </form>";
}

?>

    </div>
</div>

</body>
</html>