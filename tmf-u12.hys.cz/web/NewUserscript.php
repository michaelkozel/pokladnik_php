<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<? include("menu.php"); ?>
</body>
</html>
<?php
include './config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "tmfu121474034453";

$name = $_POST["namePost"];
$surname = $_POST["surnamePost"];
$admincode = $_POST["admincodePost"];
$balance = 0;
session_start();
if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/NewUser.php");
}
else{
//connection
    $connection = new mysqli($servername, $server_username, $server_password, $dbName);

    if (!$connection) {
        die("Připojení se nezdařilo" . mysqli_connect_error());
    }

    $sql = "INSERT INTO Users(Name, Surname, Balance) VALUES('" . $name . "','" . $surname . "','" . $balance . "')";
    $result = mysqli_query($connection, $sql);
    echo "uživatel přidán";
    header("Location: /index.php");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}

?>