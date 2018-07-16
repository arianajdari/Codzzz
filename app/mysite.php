<?php

	session_start();

	

	include 'connection.php';

	




	$user_id = $_SESSION['user']['id'];

	$query = 'SELECT * FROM projects WHERE user_id=:user_id';

	$statement = $conn->prepare($query);

	$statement->execute([':user_id' => $user_id]);

	$project = $statement->fetch(PDO::FETCH_ASSOC);


	
	$unique_host = $project['unique_host'];

	$query = 'SELECT port FROM machines WHERE user_id=:user_id';
	$statement = $conn->prepare($query);
	$statement->execute([':user_id' => $user_id]);

	$port = $statement->fetch(PDO::FETCH_ASSOC);



	exec('lt --port ' .$port. ' --subdomain ' . $unique_host);

	

	header('Location: https://' . $unique_host . '.localtunnel.me/');