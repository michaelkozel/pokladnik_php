<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 14. 2. 2018
 * Time: 19:39
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
<?php include ("menu.php"); ?>

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
