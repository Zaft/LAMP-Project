<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    if(!$_SESSION['member_id']) {
	header("Location: login.php");
    } else {
	$id = $_SESSION['member_id'];
	$sql = "SELECT * FROM members WHERE id = " . $id . ";";
	$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	
	$memberRecord = mysqli_fetch_array($result);
	$firstname = $memberRecord['firstname'];
	$lastname = $memberRecord['lastname'];
	
	$display = '
	<div class="content">
	<div class="contentblock">
	    <h3> Welcome '.$firstname.' '.$lastname.'!</h3>
	    <p>Please make sure to add fields to your farm before submitting an application:</p>
	    <a link href="addfield.php">Add Field</a></br>
	    <a link href="createapplication.php">Start Application</a></br>
	    <a link href="viewapplications.php">View Existing Applications</a>
	</div>
	</div>';
    }
?>
<?php require('head.php'); ?>
<?php require('header.php'); ?>
    <?php echo $display; ?>
<?php require('footer.php'); ?>

