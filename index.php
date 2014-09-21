<?php
  // Start the session
  require_once('startsession.php');
  
  /*// Show the navigation menu
  require_once('main_menu.php');*/
?> 
<!doctype html>
<html>
<title>WebNotes</title>
<head>
<meta charset = "utf-8">
<link rel="stylesheet" href="css/bootstrap.css">
<link href = "css/style.css" rel = "stylesheet">
<link href = "css/lock_note.css" rel = "stylesheet">
<link href = "css/animation_style.css" rel = "stylesheet">
<!--<link href = "css/rotation.css" rel = "stylesheet">-->
<script src="scripts/jquery-1.6.2.min.js"></script>
<script src = "scripts/password_validation.js"></script>
<script src = "scripts/onkeyup_test.js"></script>
<script src = "scripts/main_animation.js"></script>
<style>
@font-face {	 
	font-family: IntriqueScript;
	src: local(IntriqueScript),
	url(fonts/IntriqueScript.ttf);
}
</style>
</head>
<body>
<header>
<?php
// Start the session
session_start();
// Clear the error message
$error_msg = "";
// If the user isn't logged in, try to log them in
if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
		// Connect to the database
		require_once('connect_vars.php');
		try {
		  $DBH = new PDO(DB_DSN, DB_USER, DB_PASS);
		  $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		  
		}  
		catch(PDOException $e) {  
			echo $e->getMessage();  
		}
		// Grab the user-entered log-in data
		$user_username = strip_tags(trim($_POST['username']));
		$user_password = strip_tags(trim($_POST['password']));

		if (!empty($user_username) && !empty($user_password)) {
			// Look up the username and password in the database
			$query = "SELECT user_id, username FROM webnotes_user WHERE username = :user_username AND password = SHA(:user_password)";
			$statement = $DBH->prepare($query);
			$statement->execute(array(
				':user_username' => $user_username,
				':user_password' => $user_password
				));
			if ($statement->rowCount() == 1) {
				  // The log-in is OK so set the user ID and username session vars
				  //Get the array of current user`s column	
				  $row = $statement->fetch(PDO::FETCH_ASSOC);
				  //Set the user ID and username session vars (and cookies)
				  $_SESSION['user_id'] = $row['user_id'];
				  $_SESSION['username'] = $row['username'];
			} else if ($user_username != $row['username'] || $user_password != $row['password']) {
			  // The username/password are incorrect so set an error message
			  $error_msg = 'Sorry, you must enter a valid username and password to log in.';
			} else {
			// The username/password weren't entered so set an error message
			  $error_msg = 'Sorry, you must enter your username and password to log in.';
		}
	  }
    }
}  
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
?>
	<form method = "post" id = "login" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="text" name="username"  placeholder = "username" value = "<?php if (!empty($user_username)) echo $user_username; ?>"/>
		<input type="password" name="password" placeholder = "password"/>
		<input type="submit" id = "log_in_button" value="Log In" name="submit" />
		<a href = "PDO_signup.php">Sign Up</a>
	</form> 
	<div id = "create_note">		
		<p id = "Create">Log in to create notes</p>
	</div>
	</header>
	<div id "hero_img_wrapper">
		<div id = "hero_img">
		</div>
	</div>
	<h1 class = "hero_logo">Create your own notes</h1>
	<!--Animation-->
	<div id = "first_wrapper">
		<div id = "center_wrapper">
			<div id = "second_wrapper_1">
					<div class = "notes" id = "note_left">
						<h3 class = "note_description">Save information</h3>
					</div>
			</div >
			<div id = "second_wrapper_2">
					<div class = "notes" id = "note_center">
						<h3 class = "note_description">Protect your most important data</h3>					
					</div>
			</div>		
			<div id = "second_wrapper_3">			
					<div class = "notes" id = "note_right">
						<h3 class = "note_description">Create as many notes as you like</h3>					
					</div>
			</div>
		</div>		
	</div>
	<footer>
		<p class = "created">Created by <a href = "https://www.facebook.com/vadim.blacksmith" target="_blank">Vadim Kovalenko</a></p>
	</footer>	
<?php
	}
	else {
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
	//Connect to the database again
	require_once('connect_vars.php');
	try {
	  $DBH = new PDO(DB_DSN, DB_USER, DB_PASS);
	  $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	  
	}  
	catch(PDOException $e) {  
		echo $e->getMessage();  
	}
	// Retrieve the score data from MySQL
	$query = $DBH->query("SELECT * FROM " . $_SESSION['username'] . "_table ORDER BY table_id DESC");
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
		if ($row['note_status'] == 0){?>
			<div class = "note_wrapper">
				<div class = "thumbtack_wrapper" id = "thumb_<?php echo $row['table_id']  ?>" style = "background-image: url(images/thumbtack_<?php echo $row['thumbs'] ?>.png)">
				</div>
				<div class = "user_note" id = "note_<?php echo $row['table_id']  ?>" style ="background-color:<?php echo $row['color'] ?>">
					<div class = "button_wrapper">
						<form method = "post" class = "delete_form" action ="PDO_delete_note.php?table_identifier=<?php echo $row['table_id'] ?>">
							<input type  = "hidden" name = "table_identifier" value = <?php echo $row['table_id'] ?>>		
							<input type = "submit" name = "delete" class = "delete_note" value = "" style = "background-color: <?php echo $row['color'] ?>" onclick = "return confirm('Delete this note?');">
						</form>		
						<form method = "post" class = "lock_form" action ="PDO_protect_note.php?table_identifier=<?php echo $row['table_id'] ?>">
							<input type  = "hidden" name = "table_identifier" value ='<?php  echo $row['table_id']  ?>'>
							<input type = "submit" name = "lock" class = "lock_note" value = "" style = "background-color: <?php echo $row['color'] ?>">
						</form>
					</div>
					<div class = "text_wrapper">			
						<p class  = "note_text"><?php echo nl2br($row['text']) ?></p>
					</div>
					<div class = "date_wrapper">
						<p class = "note_date"><?php echo $row['date'] ?></p>
					</div>		
				</div>
			</div>
	<?php } elseif ($row['note_status'] == 1){?>
				<div class = "lock_wrapper">
				<div class = "empty_space">
				</div>
				<div class = "note_locked_1">
						<div class = "backward_button_wrapper">
							<form method = "post" class = "backward_form" action ="PDO_protect_note.php?table_identifier='<?php echo $row['table_id']  ?>'">
								<input type  = "hidden" name = "table_identifier" value ='<?php echo $row['table_id']  ?>'>
								<input type = "submit" name = "backward" class = "backward_note" value = "">
							</form>
						</div>
							<p class = "protect_title">PROTECT YOUR NOTE</p>				
						<form method = "post" class = "note_pass_form" action ="PDO_protect_note.php?table_identifier="'<?php echo $row['table_id']  ?>'>
							<p>(type 4 numbers)</p>
							<input type  = "hidden" name = "table_identifier" value ='<?php echo $row['table_id']  ?>'>
							<input type = "password" name = "pass_1" placeholder = "type password" class = "note_pass" id =  "pass1" maxlength = "4">
							<br>
							<input type = "password" name = "pass_2" placeholder = "retype password" class = "note_pass" id =  "pass2" maxlength = "4" onkeyup="checkPass(); return false;">
							<br>						
							<input type = "submit" name = "note_password_submit" value = "OK" class = "note_pass_button">
						</form>				
				</div>
				</div>
	<?php } elseif ($row['note_status'] == 2){?>
			<div class = "lock_wrapper">
			<div class = "empty_space">
			</div>			
			<div class = "note_locked_2">
				<form method = "post" class = "big_lock" action ="PDO_protect_note.php?table_identifier="'<?php echo $row['table_id']  ?>'>
					<input type  = "hidden" name = "table_identifier" value ='<?php echo $row['table_id']  ?>'>
					<input type =  "submit" name = "note_unlock" value = "" class = "note_unlock">
				</form>
			</div>
			</div>
	<?php } elseif ($row['note_status'] == 3){?>
			<div class = "lock_wrapper">
			<div class = "empty_space">
			</div>			
			<div class = "note_locked_3">
				<div class = "backward_button_wrapper">
					<form method = "post" class = "backward_form" action ="PDO_protect_note.php?table_identifier="'<?php  echo $row['table_id']  ?>'>
						<input type  = "hidden" name = "table_identifier" value ='<?php echo $row['table_id']  ?>'>
						<input type = "submit" name = "backward_to_lock" class = "backward_note" value = "">
				</div>
				<?php include ('PDO_protect_note.php');?>
				<div class = 'error_data'><?php $error_data ?></div>
				
				</form>	
				<form method = "post" class = "password_validation" action ="PDO_protect_note.php?table_identifier='<?php echo $row['table_id']  ?>'">
						<input type  = "hidden" name = "table_identifier" value ='<?php echo $row['table_id']  ?>'>
						<input type = "password" name = "pass_validate" placeholder = "type password" class = "note_pass" id =  "pass1">
						<input type = "submit" name = "note_password_submit_validate" value = "OK" class = "note_pass_button">
				</form>
			</div>
			</div>
	<?php }
	}
  }
?>	
</body>
		<script>
			$(document).ready(function(){
				$("#create_note").click(function() {
					$("#add_data").slideToggle("slow");
				});
			});
		</script>
		<script>
			/*var data = document.getElementById('note_text');
			var add_data = document.getElementById('add_data');
			
			function check_data() {
				if (data.innerHTML == "") {
					data.innerHTML = "Please, enter a data before creating a note";
					add_data.style.display = "block";
				}else{
					//data.style.display = "none";
				}
			}*/
		</script>
		<script src = "scripts/color_select.js"></script>
		<script src = "scripts/color_select.js"></script>
		<script src = "scripts/brakes.js"></script>			
</html>