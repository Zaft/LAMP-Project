<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
if ((filter_input(INPUT_POST, 'fieldname'))) {	
    $fieldname = filter_input(INPUT_POST, 'fieldname');
    $crop = filter_input(INPUT_POST, 'cropOption');
    $member_id = $_SESSION['member_id'];
    $area = filter_input(INPUT_POST, 'fieldarea');
    
    $sql = "INSERT into fields values('','".$member_id."','".$fieldname."','".$crop."','".$area."');";
    
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    header("Location: userlogin.html");
    
} else {
    $displayBlock = '
       <h3> Provide Field Details Below </h3>
       <fieldset>
       <legend>Add Field</legend>
       <form method="POST" action="">
           <p>Provide a name to identify your field</p>
	    Field Name:
	    <input type ="text" name="fieldname">
	    </br>
	    Field Area (acres):
	    <input type ="text" name="fieldarea">
	    </br>
	    <p>Select a Crop for this field:</p>
	    <select name="cropOption">';
    $cropsQuery = "SELECT * FROM crops;";
    $cropsResult = mysqli_query($mysqli, $cropsQuery) or die(mysqli_error($mysqli));
    while ($resultrow = mysqli_fetch_array($cropsResult)) {
	$displayBlock .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
    }
    $displayBlock .= '
	</select><br>
	<input type="submit" name="submit" value="Submit"/>
	</form>
	</fieldset>';
}
?>
<?php require('header.php'); ?>
    <?php echo $displayBlock ?>
<?php require('footer.php'); ?>
