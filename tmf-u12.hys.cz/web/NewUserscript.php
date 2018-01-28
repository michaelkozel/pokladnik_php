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
$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

$name = $_POST["namePost"];
$surname = $_POST["surnamePost"];
$admincode = $_POST["admincodePost"];
$balance = 0;

if (isset($_COOKIE["prihlaseno"]) && $_COOKIE["prihlaseno"] == 1) {

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
} else {
    header("Location: /index.php");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}

?>