<?php


session_start();

include 'connection.php';

if($_POST){
	
	$id = $_SESSION['user']['id'];
	$name = uniqid() . '.png';

	move_uploaded_file($_FILES['image']['tmp_name'], '../storage/profile_pictures/' . $name);

	$query = 'UPDATE users SET profile_picture=:profile_picture WHERE id=:id';

	$statement = $conn->prepare($query);

	$values = [
		':profile_picture' => $name,
		':id' => $id
	];

	if($statement->execute($values)){
		header('Location: ../profile.php?id=' . $_SESSION['user']['id']);
	}

}