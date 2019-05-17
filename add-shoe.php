<?php
	$database = include('config.php');
	$hostname = $database['hostname'];
	$username = $database['username'];
	$dbname = $database['dbname'];
	$password = $database['password'];
	
	try {
		$conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully"; 
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	$statement = $pdo->prepare("INSERT INTO schoenen (schoen_id, schoen_naam, schoen_url) VALUES ('', 'Flyknit Racer', 'images/flyknit-racer.jpg'); ");
	$statement->execute();
	$data = json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
?>