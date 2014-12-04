<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    if(!$_SESSION['member_id']) {
	header("Location: login.php");
    } else {
	$id = $_SESSION['member_id'];
	$applicationsQuery = "SELECT * FROM applications WHERE field_id IN "
	    . "(SELECT id FROM fields WHERE member_id = " . $id . ") ORDER BY id DESC;";
	$applicationsResult = mysqli_query($mysqli, $applicationsQuery) or die(mysqli_error($mysqli));
	$display .= '<div class="content">';
	while ($resultrow = mysqli_fetch_array($applicationsResult)) {
	    $display .= '<div class="applicationview">';

	    $fieldQuery = "SELECT * FROM fields WHERE id = " . $resultrow['field_id'] . ";";
	    $fieldResult = mysqli_query($mysqli, $fieldQuery) or die(mysqli_error($mysqli));
	    $fieldrow = mysqli_fetch_array($fieldResult);
	    
	    $cropNameQuery = "SELECT name FROM crops WHERE id = " . $fieldrow['crop'] . ";";
	    $cropNameResult = mysqli_query($mysqli, $cropNameQuery) or die(mysqli_error($mysqli));
	    $cropName = mysqli_fetch_array($cropNameResult)['name'];
	    $cropSubtypeNameQuery = "SELECT name FROM crop_subtypes WHERE id = " . $fieldrow['crop_subtype'] . ";";
	    $cropSubtypeNameResult = mysqli_query($mysqli, $cropSubtypeNameQuery) or die(mysqli_error($mysqli));
	    $cropSubtypeName = mysqli_fetch_array($cropSubtypeNameResult)['name'];
		    
	    $display .= "<h4>" . $fieldrow['name'] . "</h4>";
	    $display .= '<p>' . $cropSubtypeName . " " . $cropName . '</p>';
		    
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
	    $display .= '<p>Status: ';
	    $display .= $resultrow['status'] . '</p>';
	    $display .= '<p>Submission Date: ';
	    $display .= date("M j, Y g:i A", strtotime($resultrow['submit_date'])) . '</p>';
	    $display .= '</div>';
	}
	$display .= '</div>';
    }
    $display .= '</div>';
    
    $_SESSION['display'] = $display;
?>
<?php require('head.php'); ?>
<?php require('header.php'); ?>
<h4>Click <a href="tcpdf/examples/application_pdf.php"> here </a> to generate PDF</h4>
    <?php echo $display;?>
<?php require('footer.php'); ?>