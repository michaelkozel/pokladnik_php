<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php include("menu.php");
include "config.php"
?>
<?php
create();
if (!isset($_COOKIE["prihlaseno"])) {
    header("Location: /loginformular.php?sitefrom=/index.php");
} else {
    echo("<p>Přihlášen</p>");
}
?>
<h1>Vítejte!</h1>
<p>Vítejte na stránkách systému pro pokladnu třídy!</p>


</body>
</html>