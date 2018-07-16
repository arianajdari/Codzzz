<?php
	
	include 'Looper.php';
	include 'Elements.php';
	session_start();
	header('Content-Type: application/json');
	
	
	$dir = $_SESSION['project'];
	
	if($_FILES){
		
		

		foreach ($_FILES['file']['name'] as $position => $name) {
			move_uploaded_file($_FILES['file']['tmp_name'][$position], $dir . $_POST['key'] .  '/' . $name);
		}
	}


	$project = new Looper;

	$project = $project->getResult($dir);

	$printelements = new Elements;
	$printElements = $printelements->get($project);


	$result = [
		'result' => $printElements
	];
	echo json_encode($result);