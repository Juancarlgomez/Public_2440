<?php

$siteNames = array("index.php","account.php","video.php", "users.php", "create-account.php","logout.php");
echo'<nav><ul>';
    foreach($siteNames as $siteName)
    {
        if($siteName == "index.php") {$navText = "Home"; $siteName = ".";}
        //only allow video.php to be accessed if the user is granted
        elseif($siteName == "video.php" && !isGranted()) continue;
        elseif ($siteName == "account.php" && !isGranted()) continue;
        elseif($siteName == "logout.php"  && !isGranted()) continue;
        elseif($siteName == "users.php" && !isGranted()) continue;
        elseif($siteName == "create-account.php" && isGranted()) continue;
        else $navText = ucfirst(substr($siteName, 0, -4));
       echo'<li><a href="'.$siteName.'">'.$navText.'</a></li>';
    }
   echo'</ul></nav>';

?>