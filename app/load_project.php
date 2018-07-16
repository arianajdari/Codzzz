<?php

include 'Looper.php';

if($_GET['name']){


	$project_name = strtolower($_GET['name']);
	
	$project = new Looper;

	$dir = 'C:/workspace/' . $project_name . '/projects';

	$project = $project->getResult($dir);

	$_SESSION['project'] = $dir;
}