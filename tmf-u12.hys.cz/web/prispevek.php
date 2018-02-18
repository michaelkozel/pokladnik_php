<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php
/**
 * vyhodnocení přispění do třídní pokladny z webu
 */
session_start();
include "menu.php";

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/NewTransaction.php");
}

?>
<div class="vstup">
    <p>Přispět do pokladny</p>
    <form action="input.php" method="post">
        Name: <input type="text" name="name" required autofocus><br>
        Surname: <input type="text" name="surname" required autofocus><br>
        Comment: <input type="text" name="comment" required autofocus><br>
        Amount: <input type="text" name="amount" required><br>
        <input type="submit">
    </form>
</div>
</body>
</html>

