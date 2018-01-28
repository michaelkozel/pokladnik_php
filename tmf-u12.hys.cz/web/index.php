<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php include("menu.php");
include "config.php"
?>
<h1>Vítejte!</h1>
<p>Vítejte na stránkách systému pro pokladnu třídy!</p>

<div class="vstup">
    <form action="login.php" method="post">
        <?php
        create();
        if (!isset($_COOKIE["prihlaseno"])) {
            echo("<p>Jako první zadejte heslo pro přístup</p>");
            include "loginformular.php";
        } else {
            echo("Přihlášen");
        }
        ?>
    </form>
</div>
</body>
</html>