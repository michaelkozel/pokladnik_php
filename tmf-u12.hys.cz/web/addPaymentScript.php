<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28. 1. 2018
 * Time: 4:46
 */
include 'utilities.php';
include 'config.php';
include 'AndroidAppRequests/Notifications/pushNotificationTopic.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "tmfu121474034453";

$amount = $_POST["amountPost"];
$datum = $_POST["datum"];
$popis = $_POST["popis"];
$titulek = $_POST["titulek"];

if (isset($_COOKIE["prihlaseno"]) && $_COOKIE["prihlaseno"] == 1) {
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
    createTableWithUsers($servername, $server_username, $server_password, "platbyakce", $id . "dat", getUsers());
    notifikuj("Nová platba!", "Do " . $datumnormalne . " " . $popis . " Zaplatit " . $amount . " Kč");
    header("Location: /index.php");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
} else {
    header("Location: /index.php");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}