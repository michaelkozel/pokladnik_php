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
?>
<h1>Smazání akce</h1>
<h1>Kterou akci smazat?</h1>
<div class="vstup">
    <ul>
        <form action="deleteEventScript.php" method="post">
            <?
            if (isset($_COOKIE["prihlaseno"]) && $_COOKIE["prihlaseno"] == 1) {

            $sql = "SELECT Titulek, Datum, Cena,id FROM Akce";
            $result = mysqli_query($connection2, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $titulek = $row['Titulek'];
                $datum = $row['Datum'];
                $cena = $row['Cena'];
                $id = $row['id'];
                ?>
                <!-- generování inputu z databáze pomocí php-->
                <input  type="radio"
                        name="smazani[]"
                        value="<?php echo htmlspecialchars($pocet); ?>"><?php echo htmlspecialchars($titulek . " " . $datum . " " . $cena); ?>
                <input type="hidden"
                       name="id[]"
                       value="<?php echo htmlspecialchars($id); ?>">

                <br>
                <?
            } ?>

            <input type="submit" name="buttonZmeny" value="Smazat">
        </form>
        <?
        } else {
            header("Location: /index.php");
            /* Make sure that code below does not get executed when we redirect. */
            exit;
        }
        ?>


    </ul>
</div>
</body>
</html>


