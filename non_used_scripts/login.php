<?php
  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
	  $dbc = mysqli_connect('localhost', 'root', '', 'webnotes_db');
      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT user_id, username FROM webnotes_user WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          //setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          //setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
		  //$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
		  //header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
?>
	<form method = "post" id = "login" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" name="username"  placeholder = "username" value = "<?php if (!empty($user_username)) echo $user_username; ?>"/>
		<input type="password" name="password" placeholder = "password"/>
		<input type="submit" value="Log In" name="submit" />
		<a href = "PDO_signup.php">Sign Up</a>
	</form> 
	<div id = "create_note">		
		<p id = "Create">Log in to create notes</p>
	</div>
<?php
	}
	else {
	//require_once('add_note.php');
?>
	<a id = "logout" href="logout.php">(Log Out)</a>
	<p id = "greetings">Hello, <?php echo $_SESSION['username'] ?> </p>	
	<div id = "create_note">
		<p id = "Create">Create new note</p>
	</div>
	<div id = "add_data">
			<form method = "post" action = "PDO_add_note.php">
				<textarea name = "note_text" placeholder = "Your text" id = "note_text" onkeyup="brakes();" maxlength = "50"></textarea>
					<p id = "attention_msg"> </p>
					<div id = "color_set">
						<span id = "text_color">Type the note color	&nbsp  &nbsp </span>
								<select id="note_color" name = "color" onchange="colorSet();">
									<option value="#f8b39b" id = "orange" name = "#f8b39b"></option> <!-- #F8B39B -->
									<option value="#ed9d97" id = "red"></option> <!-- #ED9D97 -->
									<option value="#fbf6a7" id = "yellow"></option> <!-- #FBF6A7 -->
									<option value="#badbab" id = "green"></option> <!-- #BADBAB -->
									<option value="#a0c3ff" id = "blue"></option> <!-- #A0C3FF -->
									<option value="#c5a5cf" id = "purple"></option> <!-- #C5A5CF -->
									<option value="#ffb6c1" id = "pink"></option> <!-- #FFB6C1 -->
								</select>
					</div>
				<input type="submit" value="Add note" name="submit_note" id = "submit_note" onClick = "check_data();" onClick = "getTags();"/>
			</form>
	</div>
	<?php
	//Connect to the database
	$dbc = mysqli_connect('localhost', 'root', '', 'webnotes_db');
	// Retrieve the score data from MySQL
	$query2 = "SELECT * FROM " . $_SESSION['username'] . "_table ORDER BY table_id DESC";
	$data2 = mysqli_query($dbc, $query2);
	$i = 0;	
	while ($row = mysqli_fetch_array($data2)) {
		if ($row['note_status'] == 0){
		echo '<div class = "note_wrapper">';
			echo '<div class = "thumbtack_wrapper" id = "thumb_'. $row['table_id'] . '" style = "background-image: url(images/thumbtack_'.$row['thumbs'].'.png)">';
			echo '</div>';
			echo '<div class = "user_note" id = "note_'. $row['table_id'] . '" style ="background-color:' . $row['color'] . '">';
				echo '<div class = "button_wrapper">';
					echo '<form method = "post" class = "delete_form" action ="PDO_delete_note.php?table_identifier="'. $row['table_id'].'">';
						echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';		
						echo '<input type = "submit" name = "delete" class = "delete_note" value = "" style = "background-color:' . $row['color'] . '" onclick="return confirm(\'Delete this note?\');">';
					echo '</form>';			
					echo '<form method = "post" class = "lock_form" action ="PDO_protect_note.php?table_identifier="'. $row['table_id'].'">';
						echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';
						echo '<input type = "submit" name = "lock" class = "lock_note" value = "" style = "background-color:' . $row['color'] . '">';
					echo '</form>';	
				echo '</div>';
				echo '<div class = "text_wrapper">';			
					echo '<p class  = "note_text">' . nl2br($row['text']) .'</p>';
				echo '</div>';	
				echo '<div class = "date_wrapper">';
					echo '<p class = "note_date">' . $row['date'] . '</p>';
				echo' </div>';		
			echo '</div>';
		echo '</div>';	
			}
			elseif ($row['note_status'] == 1){
				echo '<div class = "note_locked_1">';
						echo '<div class = "backward_button_wrapper">';
							echo '<form method = "post" class = "backward_form" action ="PDO_protect_note.php?table_identifier="'. $row['table_id'].'">';
								echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';
								echo '<input type = "submit" name = "backward" class = "backward_note" value = "">';
							echo '</form>';
						echo '</div>';
							echo'<p class = "protect_title">PROTECT YOUR NOTE</p>';					
						echo '<form method = "post" class = "note_pass_form" action ="PDO_protect_note.php?table_identifier="'. $row['table_id'].'>';
							echo'<p>(type 4 numbers)</p>';
							echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';
							echo '<input type = "password" name = "pass_1" placeholder = "type password" class = "note_pass" id =  "pass1">';
							echo '<br>';
							echo '<input type = "password" name = "pass_2" placeholder = "retype password" class = "note_pass" id =  "pass2" onkeyup="checkPass(); return false;">';
							echo '<br>';						
							echo '<input type = "submit" name = "note_password_submit" value = "OK" class = "note_pass_button">';
						echo '</form>';					
				echo '</div>';	
		}
		elseif ($row['note_status'] == 2){		
			echo '<div class = "note_locked_2">';
				echo '<form method = "post" class = "big_lock" action ="PDO_protect_note.php?table_identifier="'. $row['table_id'].'>';
					echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';
					echo '<input type =  "submit" name = "note_unlock" value = "" class = "note_unlock">';
				echo '</form>';
			echo '</div>';
		}
		elseif ($row['note_status'] == 3){
			echo '<div class = "note_locked_3">';
				echo '<div class = "backward_button_wrapper">';
					echo '<form method = "post" class = "backward_form" action ="PDO_protect_note.php?table_identifier="'. $row['table_id'].'>';
						echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';
						echo '<input type = "submit" name = "backward_to_lock" class = "backward_note" value = "">';
				echo '</div>';
				/////////////////
				include ('PDO_protect_note.php');
				echo "<div class = 'error_data'>" . $error_data . "</div>";
				/////////////////
				echo '</form>';	
				echo '<form method = "post" class = "password_validation" action ="PDO_protect_note.php?table_identifier="'. $row['table_id'].'>';
						echo '<input type  = "hidden" name = "table_identifier" value ='. $row['table_id'] . '>';
						echo '<input type = "password" name = "pass_validate" placeholder = "type password" class = "note_pass" id =  "pass1">';
						echo '<input type = "submit" name = "note_password_submit_validate" value = "OK" class = "note_pass_button">';
				echo '</form>';
			echo '</div>';
		}
	}	
	$i++;
	mysqli_close($dbc);
	?>
	<script src = "scripts/color_select.js"></script>
	<script src = "scripts/brakes.js"></script>
<?php
}		
?>		