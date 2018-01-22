<?php

$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);

if (!$connection) {
    die("Připojení se nezdařilo" . mysqli_connect_error());
}
$sql = "SELECT Datum, Popis, Cena, Titulek,id FROM Akce";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $datum = $row['Datum'];
        $popis = $row['Popis'];
        $cena = $row['Cena'];
        $titulek = $row['Titulek'];
        $id = $row['id'];

        $posts[] = array('datum' => $datum, 'popis' => $popis, 'titulek' => $titulek, 'cena' => $cena . " Kč", 'id' => $id);


    }

}

$response['Akce'] = $posts;
echo json_encode($response, JSON_UNESCAPED_UNICODE);

?>

		
