<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10. 2. 2018
 * Time: 23:15
 */

include "config.php";
if(isset($_COOKIE["prihlaseno"]))
    setcookie("prihlaseno","0","1","/");

header("Location: index.php");