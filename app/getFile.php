<?php
	
	
	session_start();
	
	header('Content-Type: application/json');


	$dir = $_SESSION['project'] ;
	$fileName = $_POST['file'];

	$fullPath = $dir . '/' . $fileName;	


	$file = file_get_contents($fullPath, FILE_USE_INCLUDE_PATH);

	$result = [
		'fullPath' => $fullPath,
		'file' => $file
	];	

	echo json_encode($result);