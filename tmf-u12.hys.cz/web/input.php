<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<ul>
    <li><a href="NewTransaction.php">Add Transaction</a></li>
    <li><a href="NewUser.html">New User</a></li>
    <li><a href="AddPayment.php">Add payment</a></li>
    <li><a href="ShowData.php">Show Data</a></li>
    <li><a href="ShowUsers.php">Show Users</a></li>
    <li><a href="mailto:lukas.caha@outlook.com">Contact</a></li>
</ul>
</body>
</html>

<?php
$name = $_POST["name"];
$amount = $_POST["amount"];
$date = date("Y") . "-" . date("m") . "-" . date("d");
//$sum = $_POST["sum"]; add to last row
$comment = $_POST["comment"];
$password = $_POST["admincode"];
$sum = 0;

$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);

if (!$connection) {
    die("Připojení se nezdařilo" . mysqli_connect_error());
}
if ($password != "misakozel") {
    die("<h1>Wrong Admincode</h1>");
}
//insert new transaction
$sql = "INSERT INTO Transakce(Name, Amount, Date, Sum, Comment) VALUES('" . $name . "','" . $amount . "','" . $date . "','" . $sum . "','" . $comment . "')";
$result = mysqli_query($connection, $sql);

//add money to bank
$sql2 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = 'Pokladna'";
$result2 = mysqli_query($connection, $sql2);

//add money to user
$sql3 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = '$name'";
$result3 = mysqli_query($connection, $sql3);

$connection->close();

?>