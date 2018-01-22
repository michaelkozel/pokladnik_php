<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<form action="payForEventWeb.php" method="post">
    <?php include("menu.php"); ?>
    <div class="vstup">
        <?php
        $servername = "sql.endora.cz:3308";
        $server_username = "tmfu121474034453";
        $server_password = "jahnvita";
        $dbName = "tmfu121474034453";
        include 'utilities.php';
        $connection = pripojitNaDb($servername, $server_username, $server_password, $dbName);

        if (!$connection) {
            die("Připojení se nezdařilo" . mysqli_connect_error());
        }
        $sql = "SELECT Titulek, Datum, Cena, id FROM Akce";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            ?><p>Platba za akci:</p>  <select placeholder="Zvol akci">
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
        <input type="submit">
</form>
</html>
<div class="vstup">
    <form action="input.php" method="post">
        <input type="text" name="name" placeholder="Name" required autofocus><br>
        <input type="number" placeholder="0" placeholder="Amount" name="amount" min="1" max="5000" required><br>
        <input type="text" placeholder="Comment" name="comment" required><br>
        <input type="password" name="admincode" autocomplete="off" placeholder="Admincode" required><br>
        <input type="submit">
    </form>
</div>
</body>
</html>
