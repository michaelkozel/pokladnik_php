<?php
include '../config.php';
$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";
$heslo = $_POST["heslo"];
$view = $_POST["view"];
$ulozeneHeslo = getPassword();
if (isset($_POST["heslo"]) || (isset($_POST["view"]))) {
    if (($heslo) == $ulozeneHeslo || $view == "view") {
//connection
        $connection = new mysqli($servername, $server_username, $server_password, $dbName);
        if (!$connection) {
            die("Připojení se nezdařilo" . mysqli_connect_error());
        }
        $sql = "SELECT Name, Surname, Balance FROM Users ORDER BY Surname, Name";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $surname = $row['Surname'];
                $name = $row['Name'];
                $balance = $row['Balance'];

                $posts[] = array('surname' => $surname, 'name' => $name, 'balance' => $balance);

            }

        }
        $response['users'] = $posts;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        $fp = fopen('test', 'w');
        fwrite($fp, json_encode($response, JSON_UNESCAPED_UNICODE));
        fclose($fp);
    } else {
        echo "Špatné heslo";
    }
} else {
    echo "Nepřišel parametr heslo";
}


?>

		
