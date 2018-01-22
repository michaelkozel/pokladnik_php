<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 17. 1. 2018
 * Time: 17:51
 */
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2. 1. 2018
 * Time: 18:08
 */
include '../utilities.php';

$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$id = $_POST["id"]; // id tabulky
$nazevTabulky = $id . "dat"; // id je pouze cislo nazev pridava za cislo "dat"

//zjistit cenu
$dbName = "tmfu121474034453";
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$cenasql = "SELECT Cena FROM Akce WHERE id = '$id'";
$result = mysqli_query($connection, $cenasql);
$row = mysqli_fetch_assoc($result);
$cena = $row['Cena'];

//odecist zaplacene
$dbName = "platbyakce";
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$sql = "SELECT Zaplatil FROM " . $nazevTabulky . " ORDER BY ID ASC";
$result = mysqli_query($connection, $sql);
$pocetZaplacenych = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $zaplatil = $row['Zaplatil'];
    if ($zaplatil == 1) {
        $pocetZaplacenych++;
    }
}
$odecitanaCastka = $pocetZaplacenych * $cena;
$dbName = "tmfu121474034453";
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$sql = "SELECT Balance FROM Users WHERE Name = 'Pokladna'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$pokladnaAmount = $row['Balance'];
echo("aktualni" . $pokladnaAmount);
$pokladnaAmount = $pokladnaAmount - $odecitanaCastka;
$sql = "UPDATE Users SET Balance = '$pokladnaAmount' WHERE Name = 'Pokladna'";
$result = mysqli_query($connection, $sql);
echo( "odecitanaCastka = " . $odecitanaCastka . " amount pokladny " . $pokladnaAmount . " pocet zaplacenych " . $pocetZaplacenych . "cena " . $cena);

//smazat tabulky
$dbName = "platbyakce";
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$sql = "DROP TABLE $nazevTabulky";
//$sql = "INSERT INTO ".$nazevTabulky." (Name, Surname, Zaplatil)VALUES ('jmeno', 'prijmeni', 0)";
$result = mysqli_query($connection, $sql);
echo("Smazana tabulka '$nazevTabulky' ");
//connection
$dbName = "tmfu121474034453";
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$sql = "DELETE FROM Akce WHERE id = '$id'";

//$sql = "INSERT INTO ".$nazevTabulky." (Name, Surname, Zaplatil)VALUES ('jmeno', 'prijmeni', 0)";
$result = mysqli_query($connection, $sql);


//echo(" Smazan radek s id '$id' ");