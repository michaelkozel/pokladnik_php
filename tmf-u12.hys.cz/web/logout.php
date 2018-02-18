<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10. 2. 2018
 * Time: 23:15
 */
session_start();
include "config.php";
$_SESSION["logged"] = false;
header("Location: /loginformular.php?sitefrom=/index.php");