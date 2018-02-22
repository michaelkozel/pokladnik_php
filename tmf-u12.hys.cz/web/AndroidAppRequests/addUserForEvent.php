<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2. 1. 2018
 * Time: 18:08
 */
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2. 9. 2017
 * Time: 23:50
 */


include '../utilities.php';
include '../config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "platbyakce";
$id = $_POST["id"]; // id tabulky
$nazevTabulky = $id . "dat"; // id je pouze cislo nazev pridava za cislo "dat"
$name = $_POST["name"];
$surname = $_POST["surname"];
//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$sql = "INSERT INTO " . $nazevTabulky . " (Name, Surname, Zaplatil)VALUES ('" . $name . "', '" . $surname . "', 0)";
//$sql = "INSERT INTO ".$nazevTabulky." (Name, Surname, Zaplatil)VALUES ('jmeno', 'prijmeni', 0)";
$result = mysqli_query($connection, $sql);

echo("Pridan uzivatel do tabulky '$nazevTabulky' se jmenem '$name' a prijmenim '$surname' ");


