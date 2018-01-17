<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 30. 8. 2017
 * Time: 16:14
 */

include '../utilities.php';
$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

$connection = pripojitNaDb($servername, $server_username, $server_password, $dbName);

if (!$connection) {
    die("Připojení se nezdařilo" . mysqli_connect_error());
}
$sql = "SELECT Titulek, Datum, Cena FROM Akce";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $titulek = $row['Titulek'];
        $datum = $row['Datum'];
        $cena = $row['Cena'];
        if ($titulek == null) {
            $titulek = "";
        }

        if ($cena == null) {
            $cena = "0";
        }

        $posts[] = array('datum' => $datum, 'titulek' => $titulek, 'cena' => $cena . " Kč");


    }

}

$response['EventsDatesAndPayments'] = $posts;
echo json_encode($response, JSON_UNESCAPED_UNICODE);
