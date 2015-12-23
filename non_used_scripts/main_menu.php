<?php
  if (isset($_SESSION['username'])) {
  		echo '<a id = "logout" href="logout.php">(Log Out)</a>';
		echo '<p id = "greetings">Hello, '. $_SESSION['username'] . '</p>'; 	
		echo '<div id = "create_note">';
			echo '<p id = "Create">Create new note</p>';
		echo '</div>';
		echo '<div id = "add_data">';
				echo '<form method = "post" action>';
					echo '<textarea name = "note_text" placeholder = "Your text" id = "note_text"></textarea>';
						echo '<div id = "color_set">';
							echo '<span id = "text_color">Type the note color	&nbsp  &nbsp </span>';
							echo '<input type = "color" name = "note_color"/>';
						echo '</div>';
					 echo '<input type="submit" value="Add note" name="submit_note" id = "submit_note"/>';
				echo '</form>';
		echo '</div>';
  }
  else {
		echo '<form method = "post" id = "login" action = "index.php">';
		echo '<input type="text" name="username"  placeholder = "username"/>';
		echo '<input type="password" name="password" placeholder = "password"/>';
		echo '<input type="submit" value="Log In" name="submit" />';
		echo '<a href = "signup.php">Sign Up</a>';
		echo '</form>';  
   		echo '<div id = "create_note">';		
		echo '<p id = "Create">Log in to create notes</p>';
		echo '</div>';
  		require_once('login.php');	
  }
?>