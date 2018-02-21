<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>


<?php
session_start();
include("menu.php");

?>
<h1>Transakce:</h1>
<?php
if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/NewTransaction.php");
}
$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);

if (!$connection) {
    die("Připojení se nezdařilo" . mysqli_connect_error());
}
$sql = "SELECT ID, Name, Amount, Date, Sum, Comment FROM Transakce ORDER BY ID";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Amount</th><th>Date</th><th>Comment</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $rawDate = $row['Date'];
        $dateArray = explode("-", $rawDate);
        $dateString = $dateArray[2] . "." . $dateArray[1] . "." . $dateArray[0];
        if ($row['Amount'] != 0) {
            echo "<tr>" . "<td>" . $row['Name'] . "</td><td>" . $row['Amount'] . "</td><td>" . $dateString . "</td><td>" . $row['Comment'] . "</td></tr>";

        }
    }
    echo "</table>";
}
?>

</body>
</html>

