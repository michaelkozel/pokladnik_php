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
$dbName = "platbyakce";
$dbName2 = "tmfu121474034453";
$connection = new mysqli($servername, $server_username, $server_password, $dbName); //připojení k databázi, kde jsou tabulky platičů k jednotlivým akcím
$connection2 = new mysqli($servername, $server_username, $server_password, $dbName2); //připojení k databázi s názvy akcí cenou datem titulkem a popisem akce
$id = $_POST["zadatAkci"]; // id tabulky
$nazevTabulky = $id . "dat";  //cely jeji nazev
$zaplatilo = 0; //kolik zaplatilo lidi pred zmenami
$pocet = 0;
//zjištění titulku akce
$sql1 = "SELECT Titulek FROM Akce WHERE ID = '$id'";
$result1 = mysqli_query($connection2, $sql1);
$row = mysqli_fetch_assoc($result1);
$title = $row["Titulek"];
?>
<h1>Platba za akci: <? echo($title); ?></h1>
<div class="vstup">
    <ul>
        <form action="payForEventWeb.php" method="post">
            <?
            if (isset($_POST["zadatAkci"]) && $_POST["zadatAkci"] == "none") {
                echo("Žádná vybraná akce");
            } else if (isset($_POST["zadatAkci"])) {
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
                ?> <input type="submit" name="buttonZmeny" value="Potvrdit změny"><?
                $_SESSION["zaplatilo"] = $zaplatilo; //kolik lidí zaplatilo před změnami
                $_SESSION["pocet"] = $pocet;         //kolik je lidí v databázi
                $_SESSION["id"] = $id;
            } elseif (isset($_POST["buttonZmeny"])) {
                $zaplatilo = $_SESSION["zaplatilo"]; //kolik zaplatilo lidi pred zmenami
                $id = $_SESSION["id"];
                $nazevTabulky = $id . "dat";
                $pocet = $_SESSION["pocet"];
                $zaplatilo = $_SESSION["zaplatilo"];
                $zaplatilopoPridani = 0;
                echo $_SESSION["ahoj"];
               //todo zjistit lidi co zaplatili a update
                if (isset($_POST['platci'])) {
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
            }
            ?>

        </form>
    </ul>
</div>
</body>
</html>

