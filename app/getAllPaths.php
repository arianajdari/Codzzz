<?php

include 'getAllPathsLibrary.php';

session_start();
                                 

header('Content-Type: application/json');


$paths = new getAllPaths;
$paths = $paths->get($_SESSION['project']);

$fixed_paths = [];
$fixed_paths[] = '\\'; 
for($i = 0; $i < count($paths); $i++){
	$fixed_paths[] = str_replace($_SESSION['project'], '', $paths[$i]);
}


echo json_encode(['fixed_path' => $fixed_paths]);
