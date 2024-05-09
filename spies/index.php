<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>spies</title>
</head>
<body>

<?php
$header = "";
//this if statement is for displaying the header and prevents multiple headers from being displayed
if (!isset($_POST['username']) && !isset($_POST['password']) && !isset($_POST['open'])) {
    $username = "";
    $password = "";
    $header = "Welcome";
    echo "<h2>$header</h2>";
} //checks if there's a username and password
elseif (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    //checks if the username and password are correct
    if (($username == "chuck" && $password == "roast") || ($username == "bob" && $password == "ross")) {
        $header = "Access Granted";
        echo "<h2>$header</h2>";
        echo "
        <form action='.' method='post'>
        <label for='open'>Open:</label>
        <select id='open' name='open'>
            <option value='fbi'>FBI</option>
            <option value='spies'>Spies</option>
        </select>
        <input type='submit' value='Submit'>
        </form>";
    } else {
        $header = "Access Denied";
        echo "<h2>$header</h2>";
    }
}

if (isset($_POST['open'])) {
    $open = $_POST['open'];
    if ($open == 'fbi') {
        openFbi();
    } elseif ($open == 'spies') {
        openSpies();
    }
}

//if the username and password are not set it will display the form
if (($header == "Welcome" || $header == "Access Denied") && !isset($_POST['open'])) {
    echo "
    <form action='.' method='post'>
    <label for='username'>User Name:</label>
    <input id='username' type='text' name='username' value='$username'><br>
    <label for='password'>Password:</label>
    <input id='password' type='password' name='password' value='$password'> <br>
    <div class=column>
    <input type='reset' value='Reset'>
    <input type='submit' value='Submit'>
    </div>
    </form> ";
}

function openFbi()
{
    define('FILE_PATH', './includes/fbi.txt');
    if (file_exists(FILE_PATH)) {
        $fileFBI = fopen(FILE_PATH, "r");
        $content = fread($fileFBI, filesize(FILE_PATH));
        $words = explode('||>><<||', $content);
        echo "<table> <tbody> <tr> <th>Agent</th> <th>Code Name</th> </tr>";
        foreach ($words as $word) {
            echo "<tr>";
            $names = explode(',', $word);
            foreach ($names as $name) {
                echo "<td>$name</td>";
            }
            echo "</tr>";
        }
        echo "</tbody> </table>";
        fclose($fileFBI);
    } else {
        echo "File not found.";
    }
}

function openSpies()
{
    define('FILE_PATH', './includes/spies.txt');
    if (file_exists(FILE_PATH)) {
        $fileSpies = fopen(FILE_PATH, "r");
        $content = fread($fileSpies, filesize(FILE_PATH));
        $words = explode('||>><<||', $content);
        echo "<table> <tbody> <tr> <th>Agent</th> <th>Code Name</th> </tr>";
        foreach ($words as $word) {
            echo "<tr>";
            $names = explode(',', $word);
            foreach ($names as $name) {
                echo "<td>$name</td>";
            }
            echo "</tr>";
        }
        echo "</tbody> </table>";
        fclose($fileSpies);
    } else {
        echo "File not found.";
    }
}

?>
</body>
</html>