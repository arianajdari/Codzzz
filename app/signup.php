<?php

include 'connection.php';

if ($_POST) {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$query = 'INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';

	$statement = $conn->prepare($query);

	$values = [
		':first_name' => $first_name,
		':last_name' => $last_name,
		':email' => $email,
		':password' => $password
	]; 

	if ($statement->execute($values)) {
		header('Location: ../dashboard.php');
		die();
	} else {
		header('Location: ../index.php');
		die();
	}
}