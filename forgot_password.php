<?php # Script 18.10 - forgot_password.php
// This page allows a user to reset their password, if forgotten.
require('config.inc.php');
$page_title = 'Forgot Your Password';
include('header_user.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require(MYSQL);
	// Assume nothing:
	$uid = FALSE;
	// Validate the email address...
	if (!empty($_POST['email'])) {
		// Check for the existence of that email address...
		$q = 'SELECT user_id FROM users WHERE email="'.  mysqli_real_escape_string($dbc, $_POST['email']) . '"';
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
		if (mysqli_num_rows($r) == 1) { // Retrieve the user ID:
			list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
		} else { // No database match made.
			echo '<p class="error">The submitted email address does not match those on file!</p>';
		}
	} else { // No email!
		echo '<p class="error">You forgot to enter your email address!</p>';
	} // End of empty($_POST['email']) IF.
	if ($uid) { // If everything's OK.
		// Create a new, random password:
		$p = substr(md5(uniqid(rand(), true)), 3, 15);
		$ph = password_hash($p);
		// Update the database:
		$q = "UPDATE users SET pass='$ph' WHERE user_id=$uid LIMIT 1";
		$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			// Send an email:
			$body = "Your password to log into <whatever site> has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
			mail($_POST['email'], 'Your temporary password.', $body, 'From: admin@sitename.com');
			// Print a message and wrap up:
			echo '<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
			mysqli_close($dbc);
			include('includes/footer.html');
			exit(); // Stop the script.
		} else { // If it did not run OK.
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
		}
	} else { // Failed the validation test.
		echo '<p class="error">Please try again.</p>';
	}
	mysqli_close($dbc);
} // End of the main Submit conditional.
?>

<div class="bodygrid">

    <div><?php include 'mainleft.php'?></div>
    
 
        <form action="forgot_password.php" method="post">
            <table class="register">
                <th class="registerHeader">Reset Your Password</th>
                <tr>
                    <td>Email Address:</td> 
                    <td><input type="email" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"> <small>(enter your email address below and your password will be reset)</small> </td>
                </tr>

                <tr>
                    <td><input type="submit" name="submit" value="Reset My Password"></td>
                </tr>
            </table>
        </form>
    
    
    <div><?php include 'mainright.php'?></div>
</div>