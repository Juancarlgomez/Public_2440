<?php
function isGranted()
{
    if(isset($_SESSION['granted'])) return true;
    return false;
}
function passwordHash($hash)
{
    $salt1 = "mzuRnDVjPsbnjBv95xeYNtMKV0aQ6Z2w";
    $salt2 = "rX6pM01JyjnWTiq0JaVSehcxVVV5Z2w";
    $hash = $salt1.$hash.$salt2;
    $hash = hash('sha512', $hash);
    return $hash;
}
