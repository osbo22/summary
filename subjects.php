<!DOCTYPE html!>
<html>
<head>
	<title> Index </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800' rel='stylesheet' type='text/css'>

</head>
<body>
	<nav>
		<h2>SAMMANFATTNING.nu</h2>
		<ul>
			<li class="start_line"><a href="index.php"> STARTSIDA </a></li>
			<li class="selected subject_line"><a href="subjects.php"> KURSER </a></li>
			<li ><a href="summaries.php"> LÄGG TILL </a></li>
		</ul>
	</nav>
		
	<div class="searchbar">
	<form action="search.php" method="GET">
		<input type="text" name="query" placeholder="Sök..."/>
		<input type="submit" value="Sök" />
	</form>
	</div>
	
	
	<div class="subject">
	
	<?php
		// Values for  pdo
		$host     = "localhost";
		$dbname   = "summary";
		$username = "summary";
		$password = "fw9LNj3PSpKn9BcD";
		$dsn      = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
		$attr     = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

		// Create pdo
		$pdo = new PDO($dsn, $username, $password, $attr);

		echo "<ul>";
			$statement = $pdo->prepare('SELECT id, name FROM subject ORDER BY group_id, name');
			$statement->execute();
			foreach ($statement->fetchAll() as $row) {
				echo "<li><a href=\"?subject_id={$row['id']}\">{$row['name']}</a></li>";
			}
		echo "</ul>";

	?>
	
	</div>
	
	<div class="summaries">
	<?php
	if(!empty($_GET))
	{
		$_GET = null;
		$subject_id = filter_input(INPUT_GET, 'subject_id', FILTER_VALIDATE_INT);
		
		$statement = $pdo->prepare('SELECT title, content FROM summary WHERE subject_id = :subject_id');
		$statement->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
		$statement->execute();
		foreach ($statement->fetchAll() as $row) {
			echo "<p> <h4> Titel: </h4> {$row['title']} </br> <h4> Sammanfattning: </h4> {$row['content']} <p/>";
		}
	}
	?>
	</div>
</body>
</html>
