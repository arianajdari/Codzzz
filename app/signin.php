<?php

session_start();

include 'connection.php';

if($_POST){

	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$query = 'SELECT * FROM users WHERE (email=:email AND password=:password)';

	$statement = $conn->prepare($query);

	$values = [
		':email' => $email,
		':password' => $password
	]; 


	$statement->execute($values);
	$values = $statement->fetch(PDO::FETCH_ASSOC);
	unset($values['password']);

	if($values){

		
		$_SESSION['user'] = $values;
		
		header('Location: ../dashboard.php');
		die();
	} else {
		header('Location: ../index.php');
		die();
	}
}