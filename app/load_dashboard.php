<?php

include 'connection.php';

$query =   "SELECT 	p.user_id  AS 'user_id',
					p.name AS 'project_name',
		  			p.description AS 'project_description',
		  			CONCAT(CONCAT(u.first_name,' '), u.last_name) AS 'owner',
		  			p.unique_host AS 'project_unique_host',
		  			p.profile_picture AS 'project_profile_picture'
 		    FROM 	projects p INNER JOIN users u
			ON 	 	p.user_id = u.id";

$statement = $conn->prepare($query);

$statement->execute([]);

$projects = $statement->fetchAll(PDO::FETCH_ASSOC);


$query = "SELECT c.project_id AS 'project_id',
		 c.colloborator_id AS 'user_id',
		 p.name AS 'project_name'
		 FROM colloborations c INNER JOIN projects p
		 ON c.project_id = p.id";

$statement = $conn->prepare($query);

$statement->execute([]);

$colloborations = $statement->fetchALL(PDO::FETCH_ASSOC);



