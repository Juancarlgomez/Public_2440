<?php
//Make some Consents
if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    define ('HOST', 'localhost');
    define ('USER', 'root');
    define ('PASS', '1550');
    define ('DB', 'palindromes');
}
else
{
    define('HOST', 'remote-host');
    define('USER', 'user');
    define('PASS', 'password');
    define('DB', ' database');
}
//Connect to the database
$connection = mysqli_connect(HOST, USER, PASS, DB);

//Write a DB query
$sql = 'SELECT * FROM palindrome;';

//Run the query
$result = mysqli_query($connection, $sql);

//Loop through the data
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo $row['phrase'] . '<br>';
}
?>