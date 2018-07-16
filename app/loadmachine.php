<?php


include 'connection.php';

if($_GET){

	$user_id = $_GET['id'];

	$query = 'SELECT * FROM machines WHERE user_id=:user_id';

	$statement = $conn->prepare($query);

	$values = [
		':user_id' => $user_id
	];

	$statement->execute($values);

	$machine = $statement->fetch(PDO::FETCH_ASSOC);

	$query = 'SELECT first_name,last_name FROM users WHERE id=:id';

	$statement = $conn->prepare($query);

	$values = [
		':id' => $user_id
	];	

	$statement->execute($values);

	$data = $statement->fetch(PDO::FETCH_ASSOC);

	$machine['first_name'] = $data['first_name'];
	$machine['last_name'] = $data['last_name'];
}
