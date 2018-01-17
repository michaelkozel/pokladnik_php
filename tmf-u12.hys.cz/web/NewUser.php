<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>   
		<ul>
			<li><a href="NewTransaction.html">Add Transaction</a></li>
			<li><a href="NewUser.html">New User</a></li>
			<li><a href="AddPayment.html">Add payment</a></li>
			<li><a href="ShowData.php">Show Data</a></li>
			<li><a href="mailto:lukas.caha@outlook.com">Contact</a></li>
		</ul>
		<br>
	</body>
</html>
<?php
	$servername = "sql.endora.cz:3308";
	$server_username = "tmfu121474034453";
	$server_password = "jahnvita";
	$dbName = "tmfu121474034453";
	
	$name = $_POST["namePost"];
	$surname = $_POST["surnamePost"];
	$admincode = $_POST["admincodePost"];
	$balance = 0;
	
	if($admincode != "misakozel")
		die("<h1>Wrong admincode</h1>");

	//connection
	$connection = new mysqli($servername, $server_username, $server_password, $dbName);
	
	if(!$connection){
		die("Připojení se nezdařilo". mysqli_connect_error());
	}
	
	$sql = "INSERT INTO Users(Name, Surname, Balance) VALUES('".$name."','".$surname."','".$balance."')";
	$result = mysqli_query($connection ,$sql);
	
?>