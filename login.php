<?php # Script 18.8 - login.php
// This is the login page for the site.
require('config.inc.php');
$page_title = 'Login';
include('header_user_test.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require(MYSQL);
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string($link, $_POST['email']);
	} else {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = trim($_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}
	if ($e && $p) { // If everything's OK.
		// Query the database:
		$q = "SELECT user_id, first_name, user_level, pass FROM users WHERE email='$e' AND active IS NULL";
		$r = mysqli_query($link, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($link));
		if (@mysqli_num_rows($r) == 1) { // A match was made.
			// Fetch the values:
			list($user_id, $first_name, $user_level, $pass) = mysqli_fetch_array($r, MYSQLI_NUM);
			mysqli_free_result($r);
			// Check the password:
			if (password_verify($p, $pass)) {
				// Store the info in the session:
				$_SESSION['user_id'] = $user_id;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['user_level'] = $user_level;
				mysqli_close($link);
				// Redirect the user:
				$url = BASE_URL . 'index.php'; // Define the URL.
				ob_end_clean(); // Delete the buffer.
				header("Location: $url");
				exit(); // Quit the script.
			} else {
				echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
			}
		} else { // No match was made.
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
		}
	} else { // If everything wasn't OK.
		echo '<p class="error">Please try again.</p>';
	}
	mysqli_close($link);
} // End of SUBMIT conditional.
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pass" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" name="submit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>



