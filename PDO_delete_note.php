<?php
  session_start();
  // Connect to the database
  require_once('connect_vars.php');
	try {
	  $DBH = new PDO(DB_DSN, DB_USER, DB_PASS);  
	}  
	catch(PDOException $e) {  
		echo $e->getMessage();  
	}
  
  if (isset($_POST['delete'])) {
		$DBH -> exec("DELETE FROM " . $_SESSION['username'] ."_table WHERE table_id=".$_POST['table_identifier']."");
		// Redirect to the home page
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: ' . $home_url);		
	}
?>