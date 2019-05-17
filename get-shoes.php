<?php
	$database = include('config.php');
	$hostname = $database['hostname'];
	$username = $database['username'];
	$dbname = $database['dbname'];
	$password = $database['password'];
	$options = array(
		PDO::MYSQL_ATTR_SSL_KEY =>'/var/lib/mysql/client-key.pem',
		PDO::MYSQL_ATTR_SSL_CERT => '/var/lib/mysql/client-cert.pem',
		PDO::MYSQL_ATTR_SSL_CA =>'/var/lib/mysql/ca.pem'
	);

	try {
		$conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password, $options);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully"; 
		var_dump($conn->query("SHOW STATUS LIKE 'Ssl_cipher';")->fetchAll());
        $conn = null;
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		var_dump($conn->query("SHOW STATUS LIKE 'Ssl_cipher';")->fetchAll());
        $conn = null;
	}

	$statement = $pdo->prepare("SELECT * FROM schoenen");
	$statement->execute();
	$data = json_encode($statement->fetchAll(PDO::FETCH_ASSOC));

	echo $conn;
	echo $data;
?>