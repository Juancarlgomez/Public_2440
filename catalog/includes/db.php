<?php
function dbCredentials()
{
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '1550');
        define('DB', 'final');
    } else {
        define('HOST', 'remote-host');
        define('USER', 'user');
        define('PASS', 'password');
        define('DB', ' database');
    }
}
