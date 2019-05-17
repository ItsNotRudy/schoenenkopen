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
		$statement = $conn->prepare("SELECT JSON_OBJECT('schoen_id', schoen_id, 'schoen_prijs', schoen_prijs, 'schoen_naam', schoen_naam, 'schoen_url', schoen_url, 'schoen_desc', schoen_desc) FROM schoenen");
		$statement->execute();
		#$data = json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
		$data = $statement->fetchAll(PDO::FETCH_ASSOC);
		echo $data;

		
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>