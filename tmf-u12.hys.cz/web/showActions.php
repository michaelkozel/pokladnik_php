<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 10. 2. 2018
 * Time: 23:01
 */
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php include("menu.php");
?>

<?php

$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "tmfu121474034453";

//connection
$connection = new mysqli($servername, $server_username, $server_password, $dbName);

if(!$connection){
    die("Připojení se nezdařilo". mysqli_connect_error());
}
$sql = "SELECT ID, Cena, Popis, Datum,Titulek FROM Akce ORDER BY ID";
$result = mysqli_query($connection ,$sql);

if(mysqli_num_rows($result) > 0){
    echo ("<h1>Zobrazení akcí</h1>");
    echo "<table>";
    echo "<tr><th>Cena</th><th>Název</th><th>Popis</th><th>Datum</th></tr>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>"."<td>".$row['Cena']."</td><td>".$row['Titulek']."</td><td>".$row['Popis']."</td><td>".$row['Datum']."</td></tr>";
    }
    echo "</table>";
}
else{
    echo ("<h1> Žádná akce zatím v plánu není</h1>");
}
?>


</body>
</html>