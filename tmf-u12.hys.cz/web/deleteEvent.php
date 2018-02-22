<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 16. 2. 2018
 * Time: 22:00
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 22. 1. 2018
 * Time: 17:30
 */
session_start();
if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/NewTransaction.php");
}
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
?>
<h1>Smazání akce</h1>
<h1>Kterou akci smazat?</h1>
<div class="vstup">
    <ul>
        <form action="deleteEventScript.php" method="GET">
            <select name="odstranitAkci">
                <option value="none">Odstranit akci</option>
                <?

                $sql = "SELECT Titulek, Datum, Cena,id FROM Akce";
                $result = mysqli_query($connection2, $sql);
                $pocet = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $titulek = $row['Titulek'];
                    $datum = $row['Datum'];
                    $cena = $row['Cena'];
                    $id = $row['id'];
                    $pocet++;
                    ?>
                    <!-- generování inputu z databáze pomocí php-->
                    <option value="<?php echo htmlspecialchars($id); ?>"> <?
                        echo htmlspecialchars($titulek . " " . $popis . " " . $datum . " " . "Cena: " . $cena . " Kč") ?></option>
                    <br>
                    <?

                } ?>

                <input type="submit" name="buttonZmeny" value="Smazat">
            </select>
        </form>
    </ul>
</div>
</body>
</html>


