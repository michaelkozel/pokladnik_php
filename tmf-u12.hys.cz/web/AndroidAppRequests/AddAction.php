<?php
include '../utilities.php';
include '../config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "tmfu121474034453";

$amount = $_POST["amountPost"];
$datum = $_POST["datum"];
$popis = $_POST["popis"];
$titulek = $_POST["titulek"];

$connection = new mysqli($servername, $server_username, $server_password, $dbName);
if (!$connection)
    die();

$parsed_date = date_parse_from_format('Ymd', $datum);
$datumnormalne = $parsed_date['day'] . '. ' . $parsed_date['month'] . '. ' . $parsed_date['year'];
//insert new transaction
$sql = "INSERT INTO Akce(Cena, Popis, Datum,Titulek) VALUES('" . $amount . "','" . $popis . "','" . $datum . "','" . $titulek . "')";
$result = mysqli_query($connection, $sql);
$id = mysqli_insert_id($connection);
//vytvořit tabulku s uživatelema v databázi platbyakce
createTableWithUsers("sql.endora.cz:3308", "tmfu121474034453", "jahnvita", "platbyakce", $id . "dat", getUsers());
notifikuj("Nová platba!", "Do " . $datumnormalne . " " . $popis . " Zaplatit " . $amount . " Kč");
?>