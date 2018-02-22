<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28. 1. 2018
 * Time: 2:35
 */
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "platbyakce";  //db s tabulkami lidí pro dané akce s daty jestli zaplatili nebo ne
$dbName2 = "tmfu121474034453"; // db s tabulkami akcí
$connection = new mysqli($servername, $server_username, $server_password, $dbName); //připojení k databázi, kde jsou tabulky platičů k jednotlivým akcím
$connection2 = new mysqli($servername, $server_username, $server_password, $dbName2); //připojení k databázi s názvy akcí cenou datem titulkem a popisem akce
$zaplatilo = $_SESSION["zaplatilo"]; //kolik zaplatilo lidi pred zmenami
$id = $_POST["id"];
$nazevTabulky = $id . "dat";
$pocet = $_POST["pocet"];
$zaplatilo = $_POST["zaplatilo"];
$zaplatilopoPridani = 0;
if (isset($_POST['platci'])) { // nejaka policka jsou zaskrtnuta
    //cyklus který zjistí kolik lidí zaplatilo a také aktualizuje data v tabulce platičů k akci
    for ($i = 1; $i <= $pocet; $i++) {
        if (in_array($i, $_POST['platci'])) {
            echo($i . " zaplaceno <br>");
            $sql = "UPDATE $nazevTabulky SET Zaplatil = '1' WHERE ID = '$i'";
            $result = mysqli_query($connection, $sql);
            $zaplatilopoPridani++;
        } else {
            echo($i . " nezaplaceno <br>");
            $connection = new mysqli($servername, $server_username, $server_password, $dbName);
            $sql = "UPDATE $nazevTabulky SET Zaplatil = '0' WHERE ID = $i";
            $result = mysqli_query($connection, $sql);
        }
    }
} else {
    //Nic neni zaskrtnute
    for ($i = 1; $i <= $pocet; $i++) {
        echo($i . " nezaplaceno <br>");
        $connection = new mysqli($servername, $server_username, $server_password, $dbName);
        $sql = "UPDATE $nazevTabulky SET Zaplatil = '0' WHERE ID = $i";
        $result = mysqli_query($connection, $sql);

    }

}


//Aktualizace celkového počtu peněz v pokladně pomocí rozdílu zaplacených před aktualizací a po aktualizaci
//zjištění ceny
$sql1 = "SELECT Cena FROM Akce WHERE ID = $id";
$result1 = mysqli_query($connection2, $sql1);
$row = mysqli_fetch_assoc($result1);
$cena = $row['Cena'];
$rozdilZaplacenych = $zaplatilopoPridani - $zaplatilo;
$amount = $cena * $rozdilZaplacenych;
//samotná měna počtu peněz v pokladně
$sql2 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = 'Pokladna'";
$result2 = mysqli_query($connection2, $sql2);
header("Location: /payForEventWeb.php?zadatAkci=".$id);
/* Make sure that code below does not get executed when we redirect. */
exit;
