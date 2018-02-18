<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<? include("menu.php");
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/NewTransaction.php");
}

?>
<!--
<div class="vstup">
    Seřadit podle jména
    <form action="#" method="post">
        <input type="checkbox" name="check1">
        <input type="submit">
    </form>
</div>
--!>
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

$sql2 = "SELECT Name, Balance FROM Users WHERE Surname = 'Pokladna'";
$result2 = mysqli_query($connection, $sql2);
if (mysqli_num_rows($result2) > 0) {
    echo "<table>";
    while ($row = mysqli_fetch_assoc($result2)) {
        if ($row['Name'] == 'Pokladna')
            echo "<center><h3>" . $row['Name'] . " právě obsahuje " . $row['Balance'] . " Kč</h3></center>";
    }
    echo "</table>";
}

if (isset($_POST['check1'])) {

    $sql = "SELECT Name, Surname, Balance FROM Users ORDER BY Surname, Name";
} else {

    $sql = "SELECT Name, Surname, Balance FROM Users ORDER BY Balance, Surname, Name";
}
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Surname</th><th>Balance</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Name'] != 'Pokladna')
            echo "<tr>" . "<td>" . $row['Name'] . "</td><td>" . $row['Surname'] . "</td><td>" . $row['Balance'] . "</td></tr>";
    }
    echo "</table>";
}
?>

</body>
</html>

