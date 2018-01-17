<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
	<body>
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="mailto:lukas.caha@outlook.com">Contact</a></li>
		</ul>
		<div class="vstup">
		<form action="Reporty.php" method="post">
		Name: <input type="text" name="name" required autofocus><br>
		Report: <input type="text" name="report" required><br>
		<input type="submit">
		</form>
		</div>
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
		$sql = "SELECT ID, Name, Report, Date FROM Reporty ORDER BY ID";
		$result = mysqli_query($connection ,$sql);
		
		if(mysqli_num_rows($result) > 0){
				echo "<table>";
				//echo "<tr><th>Name</th><th>Amount</th><th>Date</th><th>Comment</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>"."<td>".$row['Name']."</td><td>".$row['Report']."</td><td>".$row['Date']."</td></tr>";
			}
		}



		$name = $_POST["name"];
		$report = $_POST["report"];
		$date = date("Y")."-".date("m")."-".date("d");
	
		//insert new transaction
		$sql2 = "INSERT INTO Reporty(Name, Report, Date) VALUES('".$name."','".$report."','".$date."')";
		echo "<tr>"."<td>".$name."</td><td>".$report."</td><td>".$date."</td></tr>";
		$result2 = mysqli_query($connection ,$sql2);
		$connection->close();
		echo "</table>";
		?>

		
		
	</body>
</html>

