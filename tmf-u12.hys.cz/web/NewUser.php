<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>
    <?php
    session_start();
    if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
        header("Location: /loginformular.php?sitefrom=/NewTransaction.php");
    }
    include ("menu.php"); ?>
    <?php

    ?>
		<div class="vstup">
            <p>Přidat uživatele</p>
		<form action="NewUserscript.php" method="post">
		Name: <input type="text" name="namePost" required autofocus><br>
		Surname: <input type="text" name="surnamePost" required><br>
		<input type="submit">
		</form>
		</div>
	</body>
</html>

