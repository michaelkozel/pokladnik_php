<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php include 'menu.php'; ?>
<div class="vstup">
    <form action="addPaymentScript.php" method="post">
        Datum: <input type="date" name="datum" required autofocus><br>
        Amount: <input type="number" value="0" name="amountPost" required autofocus><br>
        Title: <input type="text" value="0" name="titulek" required autofocus><br>
        Description: <input type="text" placeholder="description" name="popis" required><br>
        <input type="submit">
    </form>
</div>
</body>
</html>
