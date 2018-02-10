<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<?php include("menu.php");
if (!isset($_COOKIE["prihlaseno"])) {
    header("Location: /loginformular.php?sitefrom=/NewTransaction.php");
} else {
    echo("<p>Přihlášen</p>");
}
?>
<div class="vstup">
    <form action="payForEventWeb.php" method="get">
        <?php
        include 'utilities.php';
        //údaje k připojení k databázi
        $servername = "sql.endora.cz:3308";
        $server_username = "tmfu121474034453";
        $server_password = "jahnvita";
        $dbName = "tmfu121474034453";
        $connection = pripojitNaDb($servername, $server_username, $server_password, $dbName);
        if (!$connection) {
            die("Připojení se nezdařilo" . mysqli_connect_error());
        }
        $sql = "SELECT Titulek, Datum, Cena, id FROM Akce";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            ?><p>Platba za akci:</p>  <select name="zadatAkci">
                <option value="none">Zaplatit za akci</option>
                <?
                while ($row = mysqli_fetch_assoc($result)) {
                    $datum = $row['Datum'];
                    $popis = $row['Popis'];
                    $cena = $row['Cena'];
                    $titulek = $row['Titulek'];
                    $id = $row['id'];
                    ?>
                <option value="<?php echo htmlspecialchars($id); ?>"> <?
                    echo htmlspecialchars($titulek . " " . $datum . " " . "Cena: " . $cena . " Kč") ?></option><?
                    if ($titulek == null) {
                        $titulek = "";
                    }
                    if ($cena == null) {
                        $cena = "0";
                    }

                }
                ?>
            </select>
            <?
        } else {
            ?><p>Žádné akce nejsou zatím v plánu</p><?
        }
        ?>
        <input type="submit" value="Jít dále">
    </form>
</div>
</body>
</html>
