<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<head>
	<title> Sökresultat </title>
		<meta http-equiv="content-Type" content="Text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="header">
	<h1> Sökresultat </h1>
</div>
<hr />
	<nav class="navigation">
        <h2>SAMMANFATNNING:nu</h2>
		<ul>
			<li class="start_line"><a href="index.php"> STARTSIDA </a></li>
			<li class="subject_line"><a href="subjects.php"> KURSER </a></li>
			<li><a href="summary.php"> ADDERA </a></li>
		</ul>
	</nav>
	
	<?php
		mysql_connect("localhost", "summary", "fw9LNj3PSpKn9BcD") or die("Error connecting to database: ".mysql_error());
		mysql_select_db("summary") or die(mysql_error());
	?>
 

    <title>Sök resultat</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
        <form action="search.php" method="GET">
            <input type="text" name="query" />
            <input type="submit" value="Sök" />
        </form>
</div>
<h3> Resultat </h3>
	
<?php
    $query = $_GET['query']; 
    $min_length = 2;
     
    if(strlen($query) >= $min_length){
         
        $query = htmlspecialchars($query); 
        $query = mysql_real_escape_string($query);
        $raw_results = mysql_query("SELECT * FROM summary
            WHERE (`content` LIKE '%".$query."%') OR (`title` LIKE '%".$query."%')")or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
		
            while($results = mysql_fetch_array($raw_results)){
             
                echo "<p>".$results['title']." </br>".$results['content']." </p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
        }
        else{
            echo "Din sökning gav inget resultat!";
        }
    }
    else{
        echo "Minimum length is ".$min_length;
    }
?>

</body>
</html>
