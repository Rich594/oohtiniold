<?php # Script 18.6 - register.php
// This is the registration page for the site.
require('config.inc.php');
$page_title = 'Register';
include('header_user_test.php');



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

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Register</h3>
                    <form action="register.php" method="post">
                       
                    	<div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="User Name" size="30" maxlength="10" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>"> <small>(maximum 10 characters long)</small>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name" size="30" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>">
                        </div>

                         <div class="form-group">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" size="30" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>">
                        </div>

						<div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password1" placeholder="Password" size="30" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>"> <small>(at least 10 characters long)</small>
                        </div>

 						<div class="form-group">
                            <input type="password" class="form-control" name="password2" placeholder="Confirm Password" size="30" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btnSubmit" name="submit" value="Register" />
                        </div>
                        
                    </form>
                </div>
                
            </div>
        </div>



</div>