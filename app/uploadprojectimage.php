<?php


session_start();

include 'connection.php';

if($_POST){
	
	$id = $_SESSION['user']['id'];
	$name = uniqid() . '.png';

	move_uploaded_file($_FILES['image']['tmp_name'], '../storage/project_pictures/' . $name);

	$query = 'UPDATE projects SET profile_picture=:profile_picture WHERE user_id=:user_id';

	$statement = $conn->prepare($query);

	$values = [
		':profile_picture' => $name,
		':user_id' => $id
	];

	if($statement->execute($values)){
		header('Location: ../projects.php?id=' . $_SESSION['user']['id']);
	}

}