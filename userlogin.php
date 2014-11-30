<?php

include("do_upload.php");

//check for required fields from the form
if ((!filter_input(INPUT_POST, 'username'))
        || (!filter_input(INPUT_POST, 'password'))) {
//if ((!isset($_POST["username"])) || (!isset($_POST["password"]))) {
	header("Location: userlogin.html");
	exit;
}

//connect to server and select database
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "testDB");

//create and issue the query
$targetname = filter_input(INPUT_POST, 'username');
$targetpasswd = filter_input(INPUT_POST, 'password');
$sql = "SELECT firstname, lastname FROM members WHERE email = '".$targetname.
        "' AND password = PASSWORD('".$targetpasswd."')";

$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

//get the number of rows in the result set; should be 1 if a match
if (mysqli_num_rows($result) == 1) {

	//if authorized, get the values of f_name l_name
	while ($info = mysqli_fetch_array($result)) {
		$f_name = stripslashes($info['f_name']);
		$l_name = stripslashes($info['l_name']);
	}

	//set authorization cookie
	setcookie("auth", "1", time()+60*30, "/", "", 0);

	//create display string
	$display_block = "
	<h3> Welcome ".$firstname." ".$lastname."!</h3>
	<p>Please make sure to add fields to your farm before submitting an application:</p>
        <a link href='Application.html'>Start Application</a> </br>
        <a link href='Addfield.html'>Add Field</a>";
        
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

