<?php
if ((!filter_input(INPUT_POST, 'username'))
        || (!filter_input(INPUT_POST, 'password'))) {
	header("Location: userlogin.html");
	exit;
}

$mysqli = mysqli_connect("localhost", "organicDBuser", "letmein", "organic");

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$sql = "SELECT firstname, lastname FROM members WHERE username = '".$username.
        "' AND password = PASSWORD('".$password."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($result) == 1) {
	while ($info = mysqli_fetch_array($result)) {
		$f_name = stripslashes($info['firstname']);
		$l_name = stripslashes($info['lastname']);
	}

	//set authorization cookie
	setcookie("auth", "1", time()+60*30, "/", "", 0);

	//create display string
	$display_block = "
	<h3> Welcome ".$firstname." ".$lastname."!</h3>
	<p>Please make sure to add fields to your farm before submitting an application:</p>
        <a link href='addfield.php'>Add Field</a></br>
        <a link href='createapplication.php'>Start Application</a>";
        
} else {
	//redirect back to login form if not authorized
	header("Location: userlogin.html");
	exit;
}
?>
<html>
    <head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="styles.css"></style>
    </head>
    <body>
	<?php echo "$display_block"; ?>
    </body>
</html>

