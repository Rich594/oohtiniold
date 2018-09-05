<?php # Script 18.6 - register.php
// This is the registration page for the site.
require('config.inc.php');
$page_title = 'Register';
include('header_user.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	// Need the database connection:
	require(MYSQL);
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	// Assume invalid values:
	$fn = $ln = $e = $p = FALSE;
	// Check for a first name:
	if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string($link, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}
	// Check for a last name:
	if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string($link, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}
	// Check for an email address:
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string($link, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}
	// Check for a password and match against the confirmed password:
	if (strlen($trimmed['password1']) >= 10) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = password_hash($trimmed['password1'], PASSWORD_DEFAULT);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	if ($fn && $ln && $e && $p) { // If everything's OK...
		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query($link, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($link));
		if (mysqli_num_rows($r) == 0) { // Available.
			// Create the activation code:
			$a = md5(uniqid(rand(), true));
			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', '$p', '$fn', '$ln', '$a', NOW() )";
			$r = mysqli_query($link, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($link));
			if (mysqli_affected_rows($link) == 1) { // If it ran OK.
				// Send the email:
				$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@sitename.com');
				// Finish the page:
				echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
				include('includes/footer.html'); // Include the HTML footer.
				exit(); // Stop the page.
			} else { // If it did not run OK.
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
		} else { // The email address is not available.
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
	} else { // If one of the data tests failed.
		echo '<p class="error">Please try again.</p>';
	}
	mysqli_close($link);
} // End of the main Submit conditional.
?>





<div class="bodygrid">

    <div><?php include 'mainleft.php'?></div>


<form action="register.php" method="post">
	
    <table class="register">
        <th class="registerHeader">Register</th>
	<tr>
            <td>First Name:</td> 
            <td><input type="text" name="first_name" size="30" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>"></td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td><input type="text" name="last_name" size="30" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>"></td>
        </tr>
        <tr>
            <td>Email Address:</td> 
            <td><input type="email" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>"></td>
        </tr>
        <tr>
            <td>Password:</td>  
            <td><input type="password" name="password1" size="30" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>"> <small>(at least 10 characters long)</small></td> 
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="password2" size="30" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>"></td>
	</tr>
        <tr>
            <td><input type="submit" name="submit" value="Register"></td>
        </tr>
    </table>
</form>


<div><?php include 'mainright.php'?></div>
</div>