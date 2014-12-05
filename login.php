 <?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    if ((filter_input(INPUT_POST, 'username')) && (filter_input(INPUT_POST, 'password'))) {
	$username = filter_input(INPUT_POST, 'username');
	$password = filter_input(INPUT_POST, 'password');
	$loginQuery = "SELECT * FROM members WHERE username = '".$username.
		"' AND password = PASSWORD('".$password."')";

	$loginResult = mysqli_query($mysqli, $loginQuery) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($loginResult) == 1) {
	    $memberRecord = mysqli_fetch_array($loginResult);
		
	    $_SESSION['member_id'] = $memberRecord['id'];
	    header("Location: home.php");
	}
    } else {
	$display = '
	    <div class="content">
	    <div class="contentblock">
		<form method="post" action="">
		    <p><strong>Username:</strong><br/>
		    <input type="text" name="username"/></p>
		    <p><strong>Password:</strong><br/>
		    <input type="password" name="password"/></p>
		    <p><input type="submit" name="submit" value="Log In"/></p>
		</form>
	    </div>
	    
	    <div class="contentblock">
		<h3> Don\'t have an account? </h3>
		<p>Click <a href="createaccount.php">here</a> to create an account </p>
	    </div>
	    </div>';
    }
?>
<?php require('head.php'); ?>
<?php require('header.php'); ?>
    <?php echo $display;?>
<?php require('footer.php'); ?>