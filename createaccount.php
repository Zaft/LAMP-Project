<?php
    include("connection.php");
    $mysqli = connectToDB();
    if (filter_input(INPUT_POST, 'username')) {
	$username = filter_input(INPUT_POST, 'username');
	$sql = "SELECT * FROM members WHERE username = '" . $username . "';";
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	if (mysqli_num_rows($result) > 0) {
	    $display = '
	    <p>An account already exists with this email address.</p>
	    <a href="createaccount.php">Try Again</a><br>
	    <a href="userlogin.html">Login Page</a>';
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
	    
	    $display = '
	    <p>Account successfully created.</p>
	    <a href="userlogin.html">Login Page</a>';
	}
    } else {
	$display = '
	<p>Create a new account</p>
	<form action="" method="POST">
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
	    <br>
	    
	    <input type="submit" value="Submit">
	</form>';
    }
?>

<html>
    <head>
	<link rel="stylesheet" type="text/css" href="style.css">
        <title>Create New Account</title>
    </head>
    <body>
	<?php echo $display;?>
    </body>
</html>
