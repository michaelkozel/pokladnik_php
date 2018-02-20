<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 27. 1. 2018
 * Time: 13:08
 */
$GLOBALS['adminPassword'] = "auticko";  //admin heslo pro přístup k datům
//databaze
$GLOBALS['servername'] = "sql.endora.cz:3308";
$GLOBALS['username'] = "tmfu121474034453";   //username k databazi
$GLOBALS['password'] = "jahnvita";           //password k databazi

function create()
{
// Create connection
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], "tmfu121474034453");
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password']);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Create database
    $sql = "CREATE DATABASE IF NOT EXISTS platbyakce";
    $sql2 = "CREATE DATABASE IF NOT EXISTS tmfu121474034453";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating database: " . $conn->error;
    }
    if ($conn->query($sql2) === TRUE) {
    } else {
        echo "Error creating database: " . $conn->error;
    }


//create tables
    /*
    $sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";
    */
    $dbname = "tmfu121474034453";
// Create connection
    $conn = mysqli_connect($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $dbname);
    $sql = "CREATE TABLE IF NOT EXISTS Akce (
  Cena int(11) NOT NULL,
  Popis varchar(120) CHARACTER SET utf8 NOT NULL,
  Datum date NOT NULL,
  id int(11) NOT NULL AUTO_INCREMENT,
  Titulek varchar(60) CHARACTER SET utf8 DEFAULT NULL,
 PRIMARY KEY (id))";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error creating table Akce " . $conn->error;
    }
// Users db creation
    $sql3 = "CREATE TABLE IF NOT EXISTS Users (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
 `Name` varchar(20) CHARACTER SET utf8 NOT NULL,
 `Surname` varchar(20) CHARACTER SET utf8 NOT NULL,
 `Balance` int(5) NOT NULL,
 UNIQUE KEY `ID` (`ID`))";

    if ($conn->query($sql3) === TRUE) {
    } else {
        echo "Error creating table Users " . $conn->error;
    }

    $sql5 = "CREATE TABLE IF NOT EXISTS Transakce (
 ID int(11) NOT NULL AUTO_INCREMENT,
 Name varchar(40) NOT NULL,
 Amount int(11) NOT NULL,
 Date date NOT NULL,
 Sum int(11) NOT NULL,
 Comment text NOT NULL,
 UNIQUE KEY ID (ID))";
    if ($conn->query($sql5) === TRUE) {
    } else {
        echo "Error creating table Transakce " . $conn->error;
    }
}

function getServerPassword()
{
    return $GLOBALS['password'];
}

function getPassword()
{
    return $GLOBALS['adminPassword'];
}

function getusername()
{
    return $GLOBALS["username"];
}

function getservername()
{
    return $GLOBALS["servername"];
}

function overit()
{
    if ($GLOBALS['nainstalovano'])
        return true;
    else
        return false;
}




