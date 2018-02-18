<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14. 2. 2018
 * Time: 19:39
 */
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php include ("menu.php"); ?>
<?php

if (!isset($_COOKIE["prihlaseno"])) {
    header("Location: /loginformular.php?sitefrom=NewUser.php");
} else {
    echo("<p>Přihlášen</p>");
}
?>
<div class="vstup">
    <p>Odebrat uživatele</p>
    <form action="deleteUserscript.php" method="post">
        Name: <input type="text" name="namePost" required autofocus><br>
        Surname: <input type="text" name="surnamePost" required><br>
        <input type="submit">
    </form>
</div>
</body>
</html>
