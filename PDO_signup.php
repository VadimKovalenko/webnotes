<?php

  // Connect to the database
  require_once('connect_vars.php');
	try {
	  $DBH = new PDO(DB_DSN, DB_USER, DB_PASS);  
	}  
	catch(PDOException $e) {  
		echo $e->getMessage();  
	}

  if (isset($_POST['submit'])){
	//Grab the profile data from the POST
    $username = strip_tags(trim($_POST['username']));
    $firstname = strip_tags(trim($_POST['firstname']));
    $lastname = strip_tags(trim($_POST['lastname']));	
    $password1 = strip_tags(trim($_POST['password1']));
    $password2 = strip_tags(trim($_POST['password2']));
    $email = strip_tags(trim($_POST['email']));
	
	//regular expression for password
	$regexp = preg_match("/^[a-zA-Z0-9]+$/", $password1);
		
		if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($password1) && !empty($password2) && ($password1 == $password2) && $regexp) {
		//Make sure someone isn`t already registered using this
		$statement1 = $DBH->query("SELECT * FROM webnotes_user WHERE username = '$username' OR email = '$email'");
		if ($statement1->rowCount() == 0) {
			//The username is unique, so insert the data into the database
			$query = "INSERT INTO webnotes_user (username, first_name, last_name, password, email) VALUES (:username, :firstname, :lastname, SHA(:password1), :email)";
			$statement2 = $DBH->prepare($query);
			//Execute the INSERT query
			$statement2->execute(array(
				':username' => $username,
				':firstname' => $firstname,
				':lastname' => $lastname,
				':password1' => $password1,
				':email' => $email	
			));
			//Create empty table for user notes
			$statement1 = $DBH->query("CREATE TABLE ". $username . "_table(table_id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(table_id), color CHAR(7),text VARCHAR(200),date DATE, note_status CHAR(1), note_password DEC(4), thumbs DEC(1))");
			//Confirm success with the user
			echo '<p>Your account has been successfully created.</p>';
			echo 'Return to <a href = index.php>main page</a>';
			exit();
		}
		else{
			// An account already exists for this username, so display an error message
			echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
			$username = "";
			$email = "";
		}
	} else if (!$regexp) {
		echo '<p>You typed wrong symbols in your password!</p>';
		}
	else{
		echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
	}
 }
?>
<style>
@font-face {	 
	font-family: IntriqueScript;
	src: local(IntriqueScript),
	url(fonts/IntriqueScript.ttf);
}
</style>
<link rel = "stylesheet" href = "css/signup_style.css "/>
	<body>
	  <p class = "enter_your_data">Enter your data to create webnotes.</p>
	  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <legend>Registration Info</legend>
		  <label for="username">Username:</label>
		  <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" />
		  <label for="firstname">First name:</label>
		  <input type="text" id="firstname" name="firstname" value="<?php if (!empty($firstname)) echo $firstname; ?>"/>
		  <label for="lastname">Last name:</label>
		  <input type="text" id="lastname" name="lastname" value="<?php if (!empty($lastname)) echo $lastname; ?>" />
		  <label for="email">Email:</label>
		  <input type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>"/>  	  
		  <label for="password1">Password: (A-z,0-9)</label>
		  <input type="password" id="pass1" name="password1" maxlength = "18" onkeyup="checkPass(); return false;"/>
		  <label for="password2">Password (retype):</label>
		  <input type="password" id="pass2" name="password2" maxlength = "18" onkeyup="checkPass(); return false;"/>
		<input type="submit" value="Sign Up" name="submit" />
	  </form>
	</body>
<script src = "scripts/password_validation.js"></script>	