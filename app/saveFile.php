<?php

	header('Content-Type: application/json');


	$txt = $_POST['text'];
	$path = $_POST['path'];


	$myfile = fopen($path, 'w');

	fwrite($myfile, $txt);
	fclose($myfile);


	echo json_encode(array('message' => 'File was saved successfully'));