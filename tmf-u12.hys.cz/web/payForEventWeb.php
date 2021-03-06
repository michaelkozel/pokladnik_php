<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 22. 1. 2018
 * Time: 17:30
 */
session_start();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php include("menu.php");
include 'utilities.php';
include 'config.php';
$servername = getservername();
$server_username = getusername();
$server_password = getServerPassword();
$dbName = "platbyakce";  //db s tabulkami lidí pro dané akce s daty jestli zaplatili nebo ne
$dbName2 = "tmfu121474034453"; // db s tabulkami akcí
$connection = new mysqli($servername, $server_username, $server_password, $dbName); //připojení k databázi, kde jsou tabulky platičů k jednotlivým akcím
$connection2 = new mysqli($servername, $server_username, $server_password, $dbName2); //připojení k databázi s názvy akcí cenou datem titulkem a popisem akce
$id = $_GET["zadatAkci"]; // id tabulky
$admincode = $_POST["admincodePost"]; // id tabulky
$nazevTabulky = $id . "dat";  //cely jeji nazev
$zaplatilo = 0; //kolik zaplatilo lidi pred zmenami
$pocet = 0;     //kolik je lidi
//zjištění titulku akce
$sql1 = "SELECT Titulek FROM Akce WHERE ID = '$id'";
$result1 = mysqli_query($connection2, $sql1);
$row = mysqli_fetch_assoc($result1);
$title = $row["Titulek"];

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/payForEventWeb.php");
}
?>
<h1>Platba za akci: <? echo($title); ?></h1>
<div class="vstup">
    <ul>
        <form action="payForEventWebExecute.php" method="post">
            <?
                if (isset($_GET["zadatAkci"]) && $_GET["zadatAkci"] == "none") {
                    echo("Žádná vybraná akce");
                } else if (isset($_GET["zadatAkci"])) {
                    //Zjištění lidí a údaje o zaplacení z databáze s uživateli k akci
                    $sql = "SELECT Name,Surname,Zaplatil FROM " . $nazevTabulky . " ORDER BY ID ASC";
                    $result = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $name = $row['Name'];
                        $surname = $row['Surname'];
                        $zaplatil = $row['Zaplatil'];
                        $pocet++;
                        if ($zaplatil == 1) {
                            $checkedString = "checked";
                            $zaplatilo++;
                        } else {
                            $checkedString = "";
                        }
                        if($name!= "Pokladna"){
                        ?>
                        <!-- generování inputu z databáze pomocí php-->
                        <input  type="checkbox"  <?php echo htmlspecialchars($checkedString); ?>
                                name="platci[]"
                                value="<?php echo htmlspecialchars($pocet); ?>"><?php echo htmlspecialchars($name . " " . $surname); ?>
                        <br>
                        <?
                    }}
                    ?>
                    <input type="hidden" name="pocet" value="<?php echo htmlspecialchars($pocet); ?>"/>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
                    <input type="hidden" name="zaplatilo" value="<?php echo htmlspecialchars($zaplatilo); ?>"/>
                    <input type="submit" name="buttonZmeny" value="Potvrdit změny">
                    </form>
        <p>Přidat uživatele pro tuto akci</p>
                    <form action="addUserForEvent.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
                        Name: <input type="text" name="name" required autofocus><br>
                        Surname: <input type="text" name="surname" required><br>
            <input type="submit" name="buttonAddUser" value="Přidat uživatele pro tuto akci">
        </form>
        <? }
             else {
                header("Location: /index.php");
                /* Make sure that code below does not get executed when we redirect. */
                exit;
            }
            ?>


    </ul>
</div>
</body>
</html>

