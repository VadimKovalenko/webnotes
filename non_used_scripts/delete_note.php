<?php
  session_start();
  $error_data = '';
  // Connect to the database
  $dbc = mysqli_connect('localhost', 'root', '', 'webnotes_db');
  
  if (isset($_POST['delete'])) {
		$query = "DELETE FROM " . $_SESSION['username'] ."_table WHERE table_id=".$_POST['table_identifier']."";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		// Redirect to the home page
		$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		header('Location: ' . $home_url);		
	}
	echo mysql_error();
?>