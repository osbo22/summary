<!DOCTYPE html!>
<html>
<head>
	<title> Startsida </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800' rel='stylesheet' type='text/css'>

</head>
<body>
	<nav>
		<h2>SAMMANFATTNING.nu</h2>
		<ul>
			<li class="selected start_line"><a href="index.php"> STARTSIDA </a></li>
			<li class="subject_line"><a href="subjects.php"> KURSER </a></li>
			<li><a href="summaries.php">LÄGG TILL</a></li>
		</ul>
	</nav>
	<div class="searchform">
	<form action="search.php" method="GET">
		<input type="text" name="query" placeholder="Sök här!"/>
		<input type="submit" value="Sök" />
	</form>
	</div>

	<div id="startpage">
	<?php
	// PDO Values
	$host     = "localhost";
	$dbname   = "summary";
	$username = "summary";
	$password = "fw9LNj3PSpKn9BcD";
	$dsn      = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
	$attr     = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

	"<div class=\"resultat\">";
	
	// Create PDO
	$pdo = new PDO($dsn, $username, $password, $attr);
	
	//Amount of summaries
	$numsummaries = 0;
		$statement = $pdo->prepare('SELECT count(id) FROM summary');
		$statement->execute();
		echo "<h3>Antal sammanfattningar på sidan:</h2>";
		echo "<p>{$statement->fetchColumn()}</p>";
	?>
	
	<?php
	//amount of subjects
	$numcourses = 0;
		$statement = $pdo->prepare('SELECT count(id) FROM subject');
		$statement->execute();
		echo "<h3>Antal kurser på sidan:</h2>";
		echo "<p>{$statement->fetchColumn()}</p>";
	?>
	</div>
</body>
</html>
