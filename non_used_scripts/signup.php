<?php

  // Connect to the database
  $dbc = mysqli_connect('localhost', 'root', '', 'webnotes_db');

  if (isset($_POST['submit'])){
	//Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));	
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $email = trim($_POST['email']);	
		
		if(!empty($username) && !empty($firstname) && !empty($lastname) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
		//Make sure someone isn`t already registered using this
		$query = "SELECT * FROM webnotes_user WHERE username = '$username' OR email = '$email'";
		$data = mysqli_query($dbc, $query);
		if (mysqli_num_rows($data) == 0) {
			// The username is unique, so insert the data into the database
			$query = "INSERT INTO webnotes_user (username, first_name, last_name, password, email) VALUES ('$username', '$firstname', '$lastname', SHA('$password1'), '$email')";
			mysqli_query($dbc, $query);
			
			//Confirm success with the user
			echo '<p>Your account has been successfully created.</p>';
			mysqli_close($dbc);
			echo 'Return to <a href = index.php>main page</a>';
			exit();
		}
		else{
			// An account already exists for this username, so display an error message
			echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
			$username = "";
			$email = "";
		}
	}
	else{
		echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
	}
 }
  
  mysqli_close($dbc);
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
		  <label for="password1">Password:</label>
		  <input type="password" id="password1" name="password1" />
		  <label for="password2">Password (retype):</label>
		  <input type="password" id="password2" name="password2" />
		<input type="submit" value="Sign Up" name="submit" />
	  </form>
	</body>