<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2. 9. 2017
 * Time: 22:32
 */

$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
$dbName = "platbyakce";
$dbName2 = "tmfu121474034453";
$idTabulky = $_POST["tableName"]; // id tabulky - cislo
$zaplaceno = $_POST["zaplaceno"];  // json pole hodnot 0 1 nebo 2 podle toho jak zaplatili,  serazenych v tabulce
$tableNameFinal = $idTabulky . "dat"; // nazev tabulky nemuze byt cislo, pridava se za cislo retezec "dat"
$hodnoty = json_decode($zaplaceno);
$id = 1;
//připojení do databáze s daty uživateli co zaplatili či ne
$connection = new mysqli($servername, $server_username, $server_password, $dbName);
//připojení do databáze s akcemi
$connection2 = new mysqli($servername, $server_username, $server_password, $dbName2);

$sql1 = "SELECT Cena FROM Akce WHERE ID = '$idTabulky'";
$result1 = mysqli_query($connection2, $sql1);

$row = mysqli_fetch_assoc($result1);
$amount = $row['Cena'];
echo("amount :" . $amount . "\n");
foreach ($hodnoty as $hodnota) {
    //ziskat amount
    echo($hodnota . "  : ");
    $sql2 = "SELECT Zaplatil FROM $tableNameFinal WHERE ID = '$id'";
    $result2 = mysqli_query($connection, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $hodnotaPredZmenou = $row2['Zaplatil'];
    $sql3 = "UPDATE $tableNameFinal SET Zaplatil = '$hodnota' WHERE ID = '$id'";
    $result3 = mysqli_query($connection, $sql3);
    //add money to bank
    if ($hodnota === $hodnotaPredZmenou) {
    } else if ($hodnota != $hodnotaPredZmenou) {
        if ($hodnota === 1) {
            $sql2 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = 'Pokladna'";
            $result2 = mysqli_query($connection2, $sql2);
            echo("pricteno ");
        } else if ($hodnota === 0) {
            $sql2 = "UPDATE Users SET Balance = Balance -  '$amount' WHERE Surname = 'Pokladna'";
            $result2 = mysqli_query($connection2, $sql2);
            echo("odecteno");
        }
    }
    echo("id '$id' hodnota pred zmenou'  $hodnotaPredZmenou 'hodnota po zmene '$hodnota' +\n");
    /*
        //todo možné na později přidat do transakcí
        //todo find name and surname maybe done???
        $sqlFindName = "SELECT Name FROM Users WHERE ID = '$id'";
        $result = mysqli_query($connection2, $sqlFindName);
        $jmeno = mysqli_fetch_assoc($result);
        $sqlFindSurname = "SELECT Surname FROM Users WHERE ID = '$id'";
        $result = mysqli_query($connection2, $sqlFindSurname);
        $prijmeni = mysqli_fetch_assoc($result);
        echo("jmeno '$jmeno' prijmeni' $prijmeni' \n");
        //insert into transactions db
        //todo dodělat logiku
        $sql = "INSERT INTO Transakce(Name, Amount, Date, Sum, Comment) VALUES('" . $jmeno . " " . $prijmeni . "','" . $amount . "','" . $date . "','" . $sum . "','" . "zaplatil akci s id" . $id . "')";
        $result = mysqli_query($connection2, $sql);
    */
    $id++;
}

