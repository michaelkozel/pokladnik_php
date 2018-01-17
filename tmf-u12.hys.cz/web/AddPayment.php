<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<ul>
    <li><a href="NewTransaction.html">Add Transaction</a></li>
    <li><a href="NewUser.html">New User</a></li>
    <li><a href="AddPayment.html">Add payment</a></li>
    <li><a href="ShowData.php">Show Data</a></li>
    <li><a href="ShowUsers.php">Show Users</a></li>
    <li><a href="mailto:lukas.caha@outlook.com">Contact</a></li>
</ul>
</body>
</html>
<?php
include './AndroidAppRequests/Notifications/pushNotificationTopic.php';
include 'utilities.php';


$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

$amount = $_POST["amountPost"];
$titulek = $_POST["titulek"];
$popis = $_POST["popis"];
$datum = $_POST["datum"];
$admincode = $_POST["admincodePost"];

if ($admincode != "misakozel")
    die("<h1>Wrong admincode</h1>");

//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
if (!$connection) {
    die("Připojení se nezdařilo" . mysqli_connect_error());
}

$parsed_date = date_parse_from_format('Ymd', $datum);
$datumnormalne = $parsed_date['day'] . '. ' . $parsed_date['month'] . '. ' . $parsed_date['year'];

//insert new transaction
$sql = "INSERT INTO Akce(Cena, Popis, Datum,Titulek) VALUES('" . $amount . "','" . $popis . "','" . $datum . "','" . $titulek . "')";
$result = mysqli_query($connection, $sql);
$id = mysqli_insert_id($connection);
echo "New record has id: " . $id;


;
//vytvořit tabulku s uživatelema v databázi platbyakce
$dbName = "platbyakce";
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
createTableWithUsers("sql.endora.cz:3308", "tmfu121474034453", "jahnvita", "platbyakce", $id."dat", getUsers());
notifikuj("Nová platba!", "Do " . $datumnormalne . " " . $popis . " Zaplatit " . $amount . " Kč");


?>