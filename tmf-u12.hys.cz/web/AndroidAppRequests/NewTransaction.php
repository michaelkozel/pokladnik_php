<?php
include '../utilities.php';
include '../config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "tmfu121474034453";

$name = $_POST["namePost"];
$surname = $_POST["surnamePost"];
$amount = $_POST["amountPost"];
$date = date("Y") . "-" . date("m") . "-" . date("d");
$sum = $_POST["sumPost"];
$comment = $_POST["commentPost"];
$heslo = $_POST["heslo"];
$ulozeneHeslo = getPassword();

if (isset($_POST["heslo"])) {
    if (($heslo) == $ulozeneHeslo) {
//connection
        $connection = new mysqli($servername, $server_username, $server_password, $dbName);

        if (!$connection) {
            die("Připojení se nezdařilo" . mysqli_connect_error());
        }
        $allName = $name . " " . $surname;
//insert new transaction
        $sql = "INSERT INTO Transakce(Name, Amount, Date, Sum, Comment) VALUES('" . $allName . "','" . $amount . "','" . $date . "','" . $sum . "','" . $comment . "')";
        $result = mysqli_query($connection, $sql);
//add money to bank
        $sql2 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = 'Pokladna'";
        $result2 = mysqli_query($connection, $sql2);

        $sql3 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = '$surname' AND Name = '$name'";
        $result3 = mysqli_query($connection, $sql3);
        $connection->close();
    } else {
        echo "Špatné heslo";
    }
} else {
    echo "Nepřišel parametr heslo";
}
?>