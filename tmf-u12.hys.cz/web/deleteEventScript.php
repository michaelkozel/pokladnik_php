<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 16. 2. 2018
 * Time: 22:00
 */

include '../utilities.php';
$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "platbyakce";  //db s tabulkami lidí pro dané akce s daty jestli zaplatili nebo ne
$dbName2 = "tmfu121474034453"; // db s tabulkami akcí
$connection = new mysqli($servername, $server_username, $server_password, $dbName); //připojení k databázi, kde jsou tabulky platičů k jednotlivým akcím
$connection2 = new mysqli($servername, $server_username, $server_password, $dbName2); //připojení k databázi s názvy akcí cenou datem titulkem a popisem akce
$pocet = $_POST["pocet"];
$id = $_GET["odstranitAkci"];
if (isset($_POST['pocet'])) {
    echo("pocet set");
}
if (isset($_GET["odstranitAkci"])) {
    smazatAkci($id);
} else {
    //Nic neni zaskrtnute
    header("Location: /deleteEvent.php");
}

//header("Location: /index.php");

function smazatAkci($id)
{
//zjistit cenu
    $servername = "sql.endora.cz:3308";
    $server_username = "tmfu121474034453";
    $server_password = "jahnvita";
    $nazevTabulky = $id . "dat";
    $dbName = "platbyakce";  //db s tabulkami lidí pro dané akce s daty jestli zaplatili nebo ne
    $dbName2 = "tmfu121474034453"; // db s tabulkami akcí
    $connection = new mysqli($servername, $server_username, $server_password, $dbName); //připojení k databázi, kde jsou tabulky platičů k jednotlivým akcím
    $connection2 = new mysqli($servername, $server_username, $server_password, $dbName2); //připojení k databázi s názvy akcí cenou datem titulkem a popisem akce

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
    echo("odecitanaCastka = " . $odecitanaCastka . " amount pokladny " . $pokladnaAmount . " pocet zaplacenych " . $pocetZaplacenych . "cena " . $cena);

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
    echo("Smazana akce s id " . $id . " odecetlo se " . $odecitanaCastka . "" . "");
}

?>