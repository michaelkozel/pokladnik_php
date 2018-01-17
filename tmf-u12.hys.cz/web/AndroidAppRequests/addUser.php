<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2. 1. 2018
 * Time: 18:34
 */
include '../utilities.php';

$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "platbyakce";
$name = $_POST["name"];
$surname = $_POST["surname"];
//samotná funkce v utilities
addUser($name, $surname);