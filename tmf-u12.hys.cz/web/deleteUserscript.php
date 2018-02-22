<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14. 2. 2018
 * Time: 19:42
 */
include("menu.php"); ?>
<?php
include 'utilities.php';
include 'config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "tmfu121474034453";

$name = $_POST["namePost"];
$surname = $_POST["surnamePost"];
$balance = 0;

if (isset($_COOKIE["prihlaseno"]) && $_COOKIE["prihlaseno"] == 1) {

    //connection
    $connection = new mysqli($servername, $server_username, $server_password, $dbName);

    if (!$connection) {
        die("Připojení se nezdařilo" . mysqli_connect_error());
    }
    $sql = "DELETE FROM Users WHERE Name = $name AND Surname = '$surname'";
    $result = mysqli_query($connection, $sql);
    echo "uživatel odebrán";
    header("Location: /index.php");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
} else {
    header("Location: /index.php");
    /* Make sure that code below does not get executed when we redirect. */
    exit;
}

?>