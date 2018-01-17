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
//transactions


$sql2 = "SELECT Name, Amount, Comment FROM Transakce ORDER BY Name";
$result2 = mysqli_query($connection, $sql2);

if (mysqli_num_rows($result2) > 0) {

    while ($row = mysqli_fetch_assoc($result2)) {

        $Name = $row['Name'];
        $Amount = $row['Amount'];
        $Comment = $row['Comment'];

        $transactions_posts[] = array('Name' => $Name, 'Amount' => $Amount, 'Comment' => $Comment);


    }

}

$response['transactions'] = $transactions_posts;
echo json_encode($response, JSON_UNESCAPED_UNICODE);


?>