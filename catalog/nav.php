<?php

$siteNames = array("index.php","catalog.php","create-account.php", "cart.php","logout.php");
echo'<nav><ul>';
foreach($siteNames as $siteName)
{
    if($siteName == "index.php") {$navText = "Home"; $siteName = ".";}
    elseif($siteName == "logout.php"  && !isGranted()) continue;
    elseif($siteName == "create-account.php" && isGranted()) continue;
    elseif($siteName == "cart.php" && !isGranted()) continue;
    else $navText = ucfirst(substr($siteName, 0, -4));
    echo'<li><a href="'.$siteName.'">'.$navText.'</a></li>';
}
echo'</ul></nav>';

?>