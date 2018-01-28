<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28. 1. 2018
 * Time: 4:11
 */
include "config.php";
if (isset($_POST["heslo"])) {
    $password = $_POST["heslo"];
}
if (!isset($_COOKIE["prihlaseno"]) && $password == getPassword()) {
    setcookie("prihlaseno", "1", time() + (300), "/");
    echo "prihlaseno";
}
elseif(isset($_COOKIE["prihlaseno"])&& $password == getPassword())
{
    setcookie("prihlaseno","1",time() + (300),"/");
    echo "prihlaseno";
}
else{

    echo "spatne heslo ". $password." a ".getPassword();
}

header("Location: /index.php");
/* Make sure that code below does not get executed when we redirect. */
/*exit;
