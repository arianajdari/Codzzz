<?php
	
	include 'Looper.php';
	include 'Elements.php';

	session_start();

	header('Content-Type: application/json');


	$fileName = $_POST['fileName'];
	$fileAction = $_POST['fileAction'];
	$fileFolder = $_POST['fileFolder'];
	$mainpath = $_SESSION['project'];



	if ($fileAction === 'File') {

		if ($fileFolder === '\\') {
			$file = fopen($mainpath . $fileFolder  . $fileName, 'w');
			
		} else {
			$file = fopen($mainpath . $fileFolder . '\\' . $fileName, 'w');
		}
		fwrite($file, '');
		fclose($file);

	} else if ($fileAction === 'Folder') {
		exec('cd ' . $mainpath . $fileFolder . ' && mkdir ' .  $fileName);
	} else if ($fileAction === 'Delete') {

		$mainpath = str_replace('/', "\\", $mainpath);
		$fileFolder = str_replace('/', "\\", $fileFolder);

		if(is_dir($mainpath . $fileFolder)){
			exec('RD /S /Q ' . $mainpath . $fileFolder);
		}
		else
			exec('DEL /F /Q /A ' . $mainpath . $fileFolder);
	}

	$project = new Looper;

	$project = $project->getResult($mainpath);

	$printelements = new Elements;
	$printElements = $printelements->get($project);


	$result = [
		'result' => $printElements
	];
	echo json_encode($result);
