<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    $id = $_SESSION['member_id'];
    $applicationsQuery = "SELECT * FROM applications WHERE field_id IN "
	. "(SELECT id FROM fields WHERE member_id = " . $id . ");";
    $applicationsResult = mysqli_query($mysqli, $applicationsQuery) or die(mysqli_error($mysqli));
    while ($resultrow = mysqli_fetch_array($applicationsResult)) {
	$display .= '<div class="applicationview">';
	
	$fieldQuery = "SELECT * FROM fields WHERE id = " . $resultrow['field_id'] . ";";
	$fieldResult = mysqli_query($mysqli, $fieldQuery) or die(mysqli_error($mysqli));
	$fieldrow = mysqli_fetch_array($fieldResult);
	$display .= "<h4>" . $fieldrow['name'] . "</h4>";
	
	$display .= '<p>Pesticide</p>';
	$pesticideQuery = "SELECT * FROM pesticides WHERE id = " . $resultrow['pesticide'] . ";";
	$pesticideResult = mysqli_query($mysqli, $pesticideQuery) or die(mysqli_error($mysqli));
	while($pesticiderow = mysqli_fetch_array($pesticideResult)) {
	    $display .= "<li>" . $pesticiderow['name'] . "</li>";
	}
	
	$display .= "<p>Fertilizer</p>";
	$fertilizerQuery = "SELECT * FROM fertilizers WHERE id = " . $resultrow['fertilizer'] . ";";
	$fertilizerResult = mysqli_query($mysqli, $fertilizerQuery) or die(mysqli_error($mysqli));
	while($fertilizerrow = mysqli_fetch_array($fertilizerResult)) {
	    $display .= "<li>" . $fertilizerrow['name'] . "</li>";
	}
	$display .= '<p>Submission Date</p>';
	$display .= '<p>' . $resultrow['submit_date'] . '</p>';
	$display .= '</div>';
    }
?>
<?php require('header.php'); ?>
    <?php echo $display;?>
<?php require('footer.php'); ?>