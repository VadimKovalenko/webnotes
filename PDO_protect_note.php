<?php
  session_start();
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
  // Connect to the database
  require_once('connect_vars.php');
	try {
	  $DBH = new PDO(DB_DSN, DB_USER, DB_PASS);  
	}  
	catch(PDOException $e) {  
		echo $e->getMessage();  
	}

  
if (isset($_POST['lock'])) {
		$query = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '1' WHERE table_id = ".$_POST['table_identifier']."";
		$DBH->query($query);
		// Redirect to the home page
		header('Location: ' . $home_url);		
	}

if (isset($_POST['backward'])) {
		$query2 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '0' WHERE table_id = ".$_POST['table_identifier']."";
		$DBH->query($query2);
		// Redirect to the home page
		header('Location: ' . $home_url);			
		}
		
if (isset($_POST['note_password_submit'])) {
		$note_password_1 = trim($_POST['pass_1']);
		$note_password_2 = trim($_POST['pass_2']);
		//regular expression for password
		$regexp = preg_match("/^[0-9]+$/", $note_password_1);
		if ($note_password_1 == $note_password_2 && $regexp) {
			$query3 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '2', note_password = '$note_password_2' WHERE table_id = ".$_POST['table_identifier']."";
			$DBH->query($query3);
			// Redirect to the home page
			header('Location: ' . $home_url);		
			} else {
			// Redirect to the home page
			header('Location: ' . $home_url);
			}			
		}

if (isset($_POST['note_unlock'])) {
		$query4 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '3' WHERE table_id = ".$_POST['table_identifier']."";
		$DBH->query($query4);
		// Redirect to the home page
		header('Location: ' . $home_url);			
		}

if (isset($_POST['backward_to_lock'])) {
		$query5 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '2' WHERE table_id = ".$_POST['table_identifier']."";
		$DBH->query($query5);
		// Redirect to the home page
		header('Location: ' . $home_url);			
		}
		
if (isset($_POST['note_password_submit_validate'])) {
		$password  = $_POST['pass_validate'];
		$query6 = "SELECT table_id, note_password FROM " . $_SESSION['username'] . "_table WHERE table_id = ".$_POST['table_identifier']." AND note_password = '$password'";
		$DBH->query($query6);
	if ($DBH->query($query6)->rowCount()) {
		$query7 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '0', note_password = 'NULL' WHERE table_id = ".$_POST['table_identifier']."";
		$DBH->query($query7);
		// Redirect to the home page
		header('Location: ' . $home_url);		
		}else{
		// Redirect to the home page
		/*include ('error_messages.php');*/
		$error_data == "Wrong password";
		header('Location: ' . $home_url);
		}	
	}	
?>