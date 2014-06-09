
<!DOCTYPE html!>
<html>
<head>
	<title> Add subject </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800' rel='stylesheet' type='text/css'>

</head>
<body>

	<nav>
		<h2>SAMMANFATTNING.nu</h2>
		<ul>
			<li class="start_line"><a href="index.php"> STARTSIDA </a></li>
			<li class="subject_line"><a href="subjects.php"> KURSER </a></li>
			<li class="selected add_subject"><a href="summaries.php"> LÄGG TILL</a></li>
		</ul>
	</nav>
	
<?php
	// PDO Values
	$host     = "localhost";
	$dbname   = "summary";
	$username = "summary";
	$password = "fw9LNj3PSpKn9BcD";
	$dsn      = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
	$attr     = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

	//Create PDO
	$pdo = new PDO($dsn, $username, $password, $attr);
?>
	
	<div class="summaryForm">
		<!--Write to database -->
	<?php 
		if(!empty($_POST))	
		{
			$_POST = null;
			$subject_id = filter_input(INPUT_POST, 'subject_id', FILTER_VALIDATE_INT);
			$summary    = filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW);
			$title	    = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW); 
			$statement  = $pdo->prepare("INSERT INTO summary (subject_id, content, title) VALUES (:subject_id, :content, :title)");
			$statement  ->bindParam(":title", $title);
			$statement  ->bindParam(":subject_id", $subject_id);
			$statement  ->bindParam(":content", $summary);
			$statement  ->execute();
		}
	?>


	<h3>Lägg till sammanfattning</h3>
	<form action="summaries.php" method="POST">
	<select id="subject_input" name="subject_id" value="$subject_id">
	
	<?php
		$statement = $pdo->prepare('SELECT * FROM subject ORDER BY group_id,name');
		$statement->execute();
		foreach ($statement->fetchAll() as $row) {
			echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
		}
	?>	
		<input  id="title_input" type="text" name="title" placeholder="Skriv title här:">
	<textarea id="text_input" name="summary" value="$summary" rows="10" cols="50" placeholder="Skriv sammanfattning här:" ></textarea> <br>
	<input id="submit_input" type="submit" value="Post" />
	</form>
	</div>

</body>
</html>
