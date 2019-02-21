<?php # Script 18.1 - header.html
// This page begins the HTML header for the site.

// Start output buffering:
ob_start();

// Initialize a session:
session_start();
require_once 'dbconnection.php';
// Check for a $page_title value:
//if (!isset($page_title)) {
//	$page_title = 'User Registration';
//}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Carter+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Averia+Libre" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Boogaloo" rel="stylesheet">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>
 <div class="headergrid">
        <div><a class="ex1" href='index.php?' title='Home Page'><span class="title">oohtini</span></a><br><span class="tagline">Action Figure Collections</span></div>
	
	<?php # Script 18.2 - footer.html
	// This page completes the HTML template.
     
	// Display links based upon the login status:
	if (isset($_SESSION['user_id'])) {
        
            echo '<div></div>
                  <div class="headerLabel"><a class="links link1" href="index.php">ADD A FIGURE</a></div>
                  <div class="headerLabel"><a class="links link2" href="seriesmaster.php">MY COLLECTION</a></div>
                  <div class="headerLabel"><a class="links link3" href="index.php">VARIANTS</a></div>
                  <div class="headerLabel"><a class="links link4" href="index.php">FIGURE PROJECT</a></div>
                  <div class="headerLabel"><a class="links link5" href="index.php">MY PROFILE</a></div>';
            
            if (isset($_SESSION['first_name'])) {
            
                $user = $_SESSION['user_id'];
      
        $result1 = mysqli_query($link, "SELECT masterlist.user,count(*) FROM masterlist WHERE masterlist.user='$user' AND ownorwant = 'own'");
        $row = mysqli_fetch_row($result1);
        $figuresOwned= $row[1];
        
        $result2 = mysqli_query($link, "SELECT masterlist.user,count(*) FROM masterlist WHERE masterlist.user='$user' AND ownorwant = 'want'");
        $row = mysqli_fetch_row($result2);
        $figuresWanted= $row[1];

        echo "<div class='headerLabel1'>USER: {$_SESSION['first_name']}<br> FIGURES OWNED:<span class='headerLabel1color'> $figuresOwned</span><br>FIGURES WANTED:<span class='headerLabel1color'> $figuresWanted</span></div>";
        echo '<div><a href="logout.php" class="button">Log Out</a></div></div>';
}
            
	// Add links if the user is an administrator:
		if ($_SESSION['user_level'] == 1) {
			
            echo '<a href="view_users.php" title="View All Users">View Users</a><br>
		  <a href="#">Some Admin Page</a><br>';
            }
         
            
            } else { //  Not logged in.
                echo    '   <div class="headergrid2">
                           
                            <div class="loginfield">
                                <form action="login.php" method="post">
                                    <input type="email" name="email" placeholder="Email address" size="20" maxlength="60">
                                    <input type="password" name="pass" placeholder="Password" size="20">
                                    <input type="submit" name="submit" value="Login"></div>
                                </form>
                                <div class="loginfield3"></div>
                                    <div class="loginfield1"><a href="forgot_password.php" title="Password Retrieval"></a></div>
                                    <div class="loginfield2"><a href="register.php" title="Register for the Site">Register</a></div>
                                
                            </div>
                        </div>
                    ';
            }

?>

</body>
</html>

<?php // Flush the buffered output.
ob_end_flush();
?>

