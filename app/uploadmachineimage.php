<?php


session_start();

include 'connection.php';

if($_POST){
	
	$user_id = $_SESSION['user']['id'];
	$name = uniqid() . '.png';

	move_uploaded_file($_FILES['image']['tmp_name'], '../storage/virtual_machine_pictures/' . $name);

	$query = 'UPDATE machines SET profile_picture=:profile_picture WHERE user_id=:user_id';

	$statement = $conn->prepare($query);

	$values = [
		':profile_picture' => $name,
		':user_id' => $user_id
	];

	if($statement->execute($values)){
		header('Location: ../machine.php?id=' . $_SESSION['user']['id']);
	}

}