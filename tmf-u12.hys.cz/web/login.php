<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28. 1. 2018
 * Time: 4:11
 */
include "config.php";

if (isset($_POST["sitefrom"])) {
    $sitefrom = $_POST["sitefrom"];
} else {
    $sitefrom = "/index.php";
}
if (isset($_POST["heslo"])) {
    $password = $_POST["heslo"];
}
if ($password == getPassword()) {
    $_SESSION["logged"] = true;
    echo "prihlaseno";
} else {
    echo "spatne heslo " . $password . " a " . getPassword();
}
header("Location: $sitefrom");

/* Make sure that code below does not get executed when we redirect. */
/*exit;
