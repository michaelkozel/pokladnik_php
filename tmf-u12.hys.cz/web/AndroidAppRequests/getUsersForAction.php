<?php
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
$id = $_POST["id"]; // nazev tabulky
$nazevTabulky = $id . "dat";
//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
$sql = "SELECT Name,Surname,Zaplatil FROM " . $nazevTabulky . " ORDER BY ID ASC";
$result = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $name = $row['Name'];
    $surname = $row['Surname'];
    $zaplatil = $row['Zaplatil'];

    $posts[] = array('Name' => $name, 'Surname' => $surname, 'Zaplaceno' => $zaplatil);


}


$response['UsersForAction'] = $posts;
echo json_encode($response, JSON_UNESCAPED_UNICODE);