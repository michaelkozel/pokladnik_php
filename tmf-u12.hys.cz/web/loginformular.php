<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 28. 1. 2018
 * Time: 4:31
 */
include("menu.php");
$sitefrom = $_GET["sitefrom"];
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<h1>Vítejte!</h1>
<p>Vítejte na stránkách systému pro pokladnu třídy!</p>
<p>Pro zobrazení akcí, klikněte v menu na show actions!</p>
<div class="vstup">
    <form action="login.php" method="post">

        <p>Pro pokročilé akce se prosím přihlašte!</p>
Heslo: <input type="password" name="heslo" autocomplete="off" required>
        <input type="hidden" name="sitefrom" value="<?php echo htmlspecialchars($sitefrom); ?>">
        <input type="submit">
    </form>
</div>
</body>
</html>