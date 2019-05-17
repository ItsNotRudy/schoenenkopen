<?php
	$database = include('config.php');
	$hostname = $database['hostname'];
	$username = $database['username'];
	$dbname = $database['dbname'];
	$password = $database['password'];
	#$options = array(
	#	PDO::MYSQL_ATTR_SSL_KEY =>'/var/www/ssl/client-key.pem',
	#	PDO::MYSQL_ATTR_SSL_CERT => '/var/www/ssl/client-cert.pem',
	#	PDO::MYSQL_ATTR_SSL_CA =>'/var/www/ssl/ca.pem'
	#);

	echo $hostname;
	echo $username;
	echo $dbname;
	echo $password;

	try {
		$conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully"; 
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	$statement = $pdo->prepare("SELECT * FROM schoenen");
	$statement->execute();
	$data = json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
?>