<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>
    <?php include ("menu.php"); ?>
		<div class="vstup">
		<form action="NewUserscript.php" method="post">
		Name: <input type="text" name="namePost" required autofocus><br>
		Surname: <input type="text" name="surnamePost" required><br>
		Admincode: <input type="text" name="admincodePost" autocomplete="off" required><br>
		<input type="submit">
		</form>
		</div>
	</body>
</html>

