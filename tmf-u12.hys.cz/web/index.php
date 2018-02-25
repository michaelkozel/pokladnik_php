<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php
session_start();
include("menu.php");
include "config.php"
?>
<?php
create();
if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: /loginformular.php?sitefrom=/index.php");
}
?>
<h1>Vítejte!</h1>
<p>Vítejte na stránkách systému pro pokladnu třídy!</p>



</body>
</html>