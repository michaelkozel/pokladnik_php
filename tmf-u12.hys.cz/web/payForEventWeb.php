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
$servername = "sql.endora.cz:3308";
$server_username = "tmfu121474034453";
$server_password = "jahnvita";
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
?>
<h1>Platba za akci: <? echo($title); ?></h1>
<div class="vstup">
    <ul>
        <form action="payForEventWebExecute.php" method="post">
            <?
            if (isset($_COOKIE["prihlaseno"]) && $_COOKIE["prihlaseno"] == 1) {
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
                        ?>
                        <!-- generování inputu z databáze pomocí php-->
                        <input  type="checkbox"  <?php echo htmlspecialchars($checkedString); ?>
                                name="platci[]"
                                value="<?php echo htmlspecialchars($pocet); ?>"><?php echo htmlspecialchars($name . " " . $surname); ?>
                        <br>
                        <?
                    }
                    ?>
                    <input type="hidden" name="pocet" value="<?php echo htmlspecialchars($pocet); ?>"/>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
                    <input type="hidden" name="zaplatilo" value="<?php echo htmlspecialchars($zaplatilo); ?>"/>
                    <input type="submit" name="buttonZmeny" value="Potvrdit změny"><?
                }
            } else {
                header("Location: /index.php");
                /* Make sure that code below does not get executed when we redirect. */
                exit;
            }
            ?>

        </form>
    </ul>
</div>
</body>
</html>

