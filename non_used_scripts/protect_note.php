<?php
  session_start();
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
  // Connect to the database
  $dbc = mysqli_connect('localhost', 'root', '', 'webnotes_db');
  
if (isset($_POST['lock'])) {
		$query = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '1' WHERE table_id = ".$_POST['table_identifier']."";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		// Redirect to the home page
		header('Location: ' . $home_url);		
	}

if (isset($_POST['backward'])) {
		$query2 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '0' WHERE table_id = ".$_POST['table_identifier']."";
		mysqli_query($dbc, $query2);
		mysqli_close($dbc);
		// Redirect to the home page
		header('Location: ' . $home_url);			
		}
		
if (isset($_POST['note_password_submit'])) {
		$note_password_1 = trim($_POST['pass_1']);
		$note_password_2 = trim($_POST['pass_2']);
		if ($note_password_1 == $note_password_2) {
			$query3 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '2', note_password = '$note_password_2' WHERE table_id = ".$_POST['table_identifier']."";
			mysqli_query($dbc, $query3);
			mysqli_close($dbc);
		// Redirect to the home page
		header('Location: ' . $home_url);		
			}	
		}

if (isset($_POST['note_unlock'])) {
		$query4 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '3' WHERE table_id = ".$_POST['table_identifier']."";
		mysqli_query($dbc, $query4);
		mysqli_close($dbc);
		// Redirect to the home page
		header('Location: ' . $home_url);			
		}

if (isset($_POST['backward_to_lock'])) {
		$query5 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '2' WHERE table_id = ".$_POST['table_identifier']."";
		mysqli_query($dbc, $query5);
		mysqli_close($dbc);
		// Redirect to the home page
		header('Location: ' . $home_url);			
		}
		
if (isset($_POST['note_password_submit_validate'])) {
		$password  = $_POST['pass_validate'];
		$query6 = "SELECT table_id, note_password FROM " . $_SESSION['username'] . "_table WHERE table_id = ".$_POST['table_identifier']." AND note_password = '$password'";
		$data = mysqli_query($dbc, $query6);
	if (mysqli_num_rows($data)) {
		$query7 = "UPDATE " . $_SESSION['username'] ."_table SET note_status  = '0', note_password = 'NULL' WHERE table_id = ".$_POST['table_identifier']."";
		mysqli_query($dbc, $query7);
		mysqli_close($dbc);
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