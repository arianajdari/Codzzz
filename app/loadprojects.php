<?php

	

	include 'connection.php';


	if ($_GET) {

		$user_id = $_GET['id'];

		$query = 'SELECT * FROM projects WHERE user_id=:user_id';

		$statement = $conn->prepare($query);

		$statement->execute([':user_id' => $user_id]);

		$project = $statement->fetch(PDO::FETCH_ASSOC);

		$query = 'SELECT first_name,last_name FROM users WHERE id=:id';

		$statement = $conn->prepare($query);

		$values = [
			':id' => $user_id
		];	

		$statement->execute($values);

		$data = $statement->fetch(PDO::FETCH_ASSOC);

		$project['first_name'] = $data['first_name'];
		$project['last_name'] = $data['last_name'];
	}