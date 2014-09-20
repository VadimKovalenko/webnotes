<?php
  // Start the session
  require_once('startsession.php');
  // Connect to the database
  require_once('connect_vars.php');
	try {
	  $DBH = new PDO(DB_DSN, DB_USER, DB_PASS);  
	}  
	catch(PDOException $e) {  
		echo $e->getMessage();  
	}
  
  if (isset($_POST['submit_note'])) {
	$data = strip_tags($_POST['note_text']);
	$color = $_POST['color'];
	$note_status = 0;
	
	if ($color == "#f8b39b") {
	$color_thumbs = 7;
	}else if($color == "#ed9d97"){
	$color_thumbs = 1;	
	}else if($color == "#fbf6a7"){
	$color_thumbs = 5;
	}else if($color == "#badbab"){
	$color_thumbs = 2;
	}else if($color == "#a0c3ff"){
	$color_thumbs = 3;
	}else if($color == "#c5a5cf"){
	$color_thumbs = 4;
	}else if($color == "#ffb6c1"){
	$color_thumbs = 6;
	}
	
	//Check or user and put the data
	if(!empty($data)) {
		$statement1 = $DBH->query("CREATE TABLE ". $_SESSION['username'] . "_table(table_id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(table_id), color CHAR(7),text VARCHAR(200),date DATE, note_status CHAR(1), note_password DEC(4), thumbs DEC(1))");
		//Prepare data
		$sql = "INSERT INTO " . $_SESSION['username'] . "_table (color, text, date, note_status, thumbs) VALUES (:color, :data, NOW(), :note_status, :color_thumbs)";
		$statement2 = $DBH->prepare($sql);
		//Execute the INSERT query
		$statement2->execute(array(
		':color' => $color,
		':data' => $data,
		':note_status' => $note_status,
		':color_thumbs' => $color_thumbs
		));
		// Redirect to the home page
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: ' . $home_url);
	} else {
		// Redirect to the home page
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: ' . $home_url);
	}
  }
?>