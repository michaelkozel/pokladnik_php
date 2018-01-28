<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28. 8. 2017
 * Time: 15:16
 */


include "/config.php";

/**
 * vrací 2d pole
 * první je normální a druhé asociativní
 * Name se jménem
 * Surname s příjmením
 * @return array
 */
function getUsers()
{
    $connection = pripojitNaDb("sql.endora.cz:3308", "tmfu121474034453", "jahnvita", "tmfu121474034453");
    $sql = "SELECT Name,Surname FROM Users ORDER BY ID ASC";
    $result = mysqli_query($connection, $sql);

    $jmena = array();
    foreach ($result as $u) {
        $array = array(
            "Name" => $u['Name'],
            "Surname" => $u['Surname'],
        );

        array_push($jmena, $array);

    }
    //echo ("users funkce LOG");
    return $jmena;
}

function addUser($name, $surname)
{
    $connection = pripojitNaDb("sql.endora.cz:3308", "tmfu121474034453", "jahnvita", "tmfu121474034453");
    $sql = "INSERT INTO Users(Name, Surname)VALUES ('" . $name . "', '" . $surname . "')";
    $result = mysqli_query($connection, $sql);
}

function createTableWithUsers($servername, $server_username, $server_password, $dbName, $tableName, $users)
{

    $connection = pripojitNaDb($servername, $server_username, $server_password, $dbName);

    //Create table with event
    $sql = "CREATE TABLE " . $tableName . " (
ID int NOT NULL auto_increment PRIMARY KEY,
Name varchar (30) NOT NULL,
Surname varchar (30) NOT NULL,
Zaplatil int (1)
)";
    $result = mysqli_query($connection, $sql);
    //echo(count($users));
    //Fill table with users
    for ($i = 0; $i < count($users); $i++) {
        $sql2 = "INSERT INTO " . $tableName . "(Name, Surname, Zaplatil) VALUES('" . $users[$i]['Name'] . "','" . $users[$i]['Surname'] . "','0')";
        $result2 = mysqli_query($connection, $sql2);
        // LOG echo($users[$i]['Name'] . $users[$i]['Surname']. "</br>");
    }


}


function pripojitNaDb($servername, $server_username, $server_password, $dbName)
{
    return $connection = new mysqli($servername, $server_username, $server_password, $dbName);
}
