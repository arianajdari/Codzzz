<?php

include 'connection.php';

if($_GET){

	$id = $_GET['id'];

	$query = 'SELECT * FROM users WHERE id=:id';

	$statement = $conn->prepare($query);

	$values = [
		':id' => (int)$id
	]; 

	$statement->execute($values);

	$user = $statement->fetch(PDO::FETCH_ASSOC);


}