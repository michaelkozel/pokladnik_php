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
			<li><a href="ShowUsers.php">Show Users</a></li>
			<li><a href="mailto:lukas.caha@outlook.com">Contact</a></li>
		</ul>
		
		<?php
		$servername = "sql.endora.cz:3308";
		$server_username = "tmfu121474034453";
		$server_password = "jahnvita";
		$dbName = "tmfu121474034453";

		//connection
		$connection = new mysqli($servername, $server_username, $server_password, $dbName);
		
		if(!$connection){
			die("Připojení se nezdařilo". mysqli_connect_error());
		}
		$sql = "SELECT ID, Name, Amount, Date, Sum, Comment FROM Transakce ORDER BY ID";
		$result = mysqli_query($connection ,$sql);
		
		if(mysqli_num_rows($result) > 0){
				echo "<table>";
				echo "<tr><th>Name</th><th>Amount</th><th>Date</th><th>Comment</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>"."<td>".$row['Name']."</td><td>".$row['Amount']."</td><td>".$row['Date']."</td><td>".$row['Comment']."</td></tr>";
			}
				echo "</table>";
		}
		?>

	</body>
</html>

