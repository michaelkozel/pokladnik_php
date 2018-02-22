<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2. 1. 2018
 * Time: 18:34
 */
include '../utilities.php';
include '../config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "platbyakce";
$name = $_POST["name"];
$surname = $_POST["surname"];
//samotná funkce v utilities
addUser($name, $surname);