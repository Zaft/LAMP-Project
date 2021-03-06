<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    if (filter_input(INPUT_POST, 'username')) {
	$username = filter_input(INPUT_POST, 'username');
	$sql = "SELECT * FROM members WHERE username = '" . $username . "';";
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	$display .= '
	    <div class=content>
	    <div class=contentBlock>';
	if (mysqli_num_rows($result) > 0) {
	    $display .= '
	    <p>An account already exists with this email address.</p>
	    <a href="createaccount.php">Try Again</a><br>
	    <a href="login.php">Login Page</a>';
	} else {
	    $insertMemberSQL = "INSERT INTO members VALUES("
		    . "null,"
		    . "'" . filter_input(INPUT_POST, 'username') . "',"
		    . "'" . filter_input(INPUT_POST, 'firstname') . "',"
		    . "'" . filter_input(INPUT_POST, 'lastname') . "',"
		    . "'" . filter_input(INPUT_POST, 'email') . "',"
		    . "password('".filter_input(INPUT_POST, 'password')."')"
		    . ");";
	    mysqli_query($mysqli, $insertMemberSQL) or die(mysqli_error($mysqli));
	    
	    $idQuery = "SELECT * FROM members WHERE username = '" . filter_input(INPUT_POST, 'username') . "';";
	    $idResult = mysqli_query($mysqli, $idQuery) or die(mysqli_error($mysqli));
	    $idRow = mysqli_fetch_array($idResult);
	    $_SESSION['member_id'] = $idRow['id'];  
	    $display .= '
	    <p>Account successfully created.</p>
	    <a href="home.php">Get Started</a>';
	}
	$display .= '
	    </div>
	    </div>';
    } else {
	$display = '
        <div class=content>
        <div class=contentBlock>
	    <h3>Create a New Account</h3>
	    <form method="post" action="">
		<fieldset>
		<legend>Account Details</legend>
		<label class="applyaccount" for="username">Username:</label>
		<input id="username" type="text" name="username">
		<br>

		<label class="applyaccount" for="firstname">First Name:</label>
		<input id="firstname" type="text" name="firstname">
		<br>

		<label class="applyaccount" for="lastname">Last Name:</label>
		<input id="lastname" type="text" name="lastname">
		<br>

		<label class="applyaccount" for="email">Email:</label>
		<input id="email" type="text" name="email">
		<br>

		<label class="applyaccount" for="password">Password:</label>
		<input id="password" type="password" name="password">
		</fieldset>

		<input type="submit" value="Submit">
	    </form>
        </div>
        </div>';
        
    }
?>
<?php require('head.php'); ?>
<?php require('header.php'); ?>
    <?php echo $display;?>
<?php require('footer.php'); ?>
