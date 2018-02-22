<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 16. 2. 2018
 * Time: 20:28
 */

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
session_start();
if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: index.php");
}
else {
        if (isset($_POST["name"]) && isset($_POST["surname"]) && $name != "" && $surname != "") {
            $result = mysqli_query($connection, $sql);
        }
    else{
        echo("<p>Nezadali jste kompletní údaje</p>");
    }
}
header("Location: /payForEventWeb.php?zadatAkci=".$id);