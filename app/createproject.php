<?php

	session_start();

	include 'connection.php';


	if ($_POST) {

		$user_id = $_SESSION['user']['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$unique_host = $_SESSION['user']['first_name'] . $_SESSION['user']['last_name'];

		$query = 'INSERT INTO projects (user_id, name, unique_host, description) VALUES (:user_id, :name, :unique_host, :description)';

		$statement = $conn->prepare($query);

		$values = [
			':user_id' => $user_id,
			':name' => $name,
			':unique_host' => strtolower($unique_host),
			':description' => $description
		];

		$statement->execute($values);

		$last_row = $conn->lastInsertId();

		$query = 'INSERT INTO colloborations (project_id, colloborator_id) VALUES (:project_id, :colloborator_id)';

		$statement = $conn->prepare($query);

		$values = [
			':project_id' => (int)$last_row,
			':colloborator_id' => $user_id
		];

		if ($statement->execute($values)) {
			header('Location: ../projects.php?id=' . $_SESSION['user']['id']);
		}
	}