<?php
	$servername = "sql.endora.cz:3308";
	$server_username = "tmfu121474034453";
	$server_password = "jahnvita";
	$dbName = "tmfu121474034453";
	
	$name = $_POST["namePost"];
	$amount = $_POST["amountPost"];
	$date = date("Y")."-".date("m")."-".date("d");
	$sum = $_POST["sumPost"];
	$comment = $_POST["commentPost"];

	//connection
	$connection = new mysqli($servername, $server_username, $server_password, $dbName);
	
	if(!$connection){
		die("Připojení se nezdařilo". mysqli_connect_error());
	}
	
	//insert new transaction
	$sql = "INSERT INTO Transakce(Name, Amount, Date, Sum, Comment) VALUES('".$name."','".$amount."','".$date."','".$sum."','".$comment."')";
	$result = mysqli_query($connection ,$sql);

	//add money to bank
	$sql2 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = 'Pokladna'";
	$result2 = mysqli_query($connection ,$sql2);
	
  //add money to user
  if($name=="AdamičkaMi")
  {
       	$sql3 = "UPDATE Users SET Balance = Balance + '$amount' WHERE ID = 2";
	$result3 = mysqli_query($connection ,$sql3);
  
  }
  if($name=="AdamičkaMa")
  {
  	$sql3 = "UPDATE Users SET Balance = Balance + '$amount' WHERE ID = 1";
	$result3 = mysqli_query($connection ,$sql3);
  }
  else {
  	
	$sql3 = "UPDATE Users SET Balance = Balance + '$amount' WHERE Surname = '$name'";
	$result3 = mysqli_query($connection ,$sql3);

  }

	$connection->close();
?>