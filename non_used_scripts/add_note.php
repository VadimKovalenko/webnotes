<?php
  // Start the session
  require_once('startsession.php');
  
  $error_data = '';
  
  // Connect to the database
  $dbc = mysqli_connect('localhost', 'root', '', 'webnotes_db');
  
  //connect utf8 charset
  //require_once('utf8.php');
  
  if (isset($_POST['submit_note'])) {
	mysqli_query($dbc, "SET NAMES UTF8");
	$data = mysqli_real_escape_string($dbc, trim($_POST['note_text']));
	$color = mysqli_real_escape_string($dbc, trim($_POST['color']));
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
	
	//$note_password = "NULL";
	//Check or user and put the data
	if(!empty($data)) {
		$query1 = "CREATE TABLE ". $_SESSION['username'] . "_table(table_id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(table_id), color CHAR(7),text VARCHAR(200),date DATE, note_status CHAR(1), note_password DEC(4), thumbs DEC(1))";
		$query2 = "INSERT INTO " . $_SESSION['username'] . "_table (color, text, date, note_status, thumbs) VALUES ('$color', '$data', NOW(), $note_status, $color_thumbs)";
		mysqli_query($dbc, $query1);
		mysqli_query($dbc, $query2);
		mysqli_close($dbc);
		// Redirect to the home page
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: ' . $home_url);
	}
	
	//$query = "SELECT  * FROM webnotes_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
	//$query = "SELECT  * FROM webnotes_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
?>