<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    if(!$_SESSION['member_id']) {
	header("Location: login.php");
    } else {
	if (filter_input(INPUT_POST, 'submit')) {
	    $display .= filter_input(INPUT_POST, 'fertilizer') . "<br>";
	    $display .= filter_input(INPUT_POST, 'pesticide') . "<br>";
	    $insertApplicationSQL = "INSERT INTO applications VALUES(null,"
		    . filter_input(INPUT_POST, 'field') . ","
		    . filter_input(INPUT_POST, 'pesticide') . ","
		    . filter_input(INPUT_POST, 'fertilizer') . ","
		    . "'pending',"
		    . "now());";
	    mysqli_query($mysqli, $insertApplicationSQL) or die(mysqli_error($mysqli));
	    header("Location: viewapplications.php");
	} else {
	    $id = $_SESSION['member_id'];
	    $display = '
	    <div class="content">
	    <div class="contentblock">
	       <h3> Create a New Application </h3>
		<form method="post" action="">
		    <fieldset>
		    <legend>Application Details</legend>
		    <p>Select one of your fields. If the field you want is not in the list, create it <a href="addfield.php">here</a>.</p>
		    <label class="createapplication" for="field">Field:</label>
		    <select name="field">';
	    $fieldsQuery = "SELECT * FROM fields WHERE member_id = " . $id . ";";
	    $fieldsResult = mysqli_query($mysqli, $fieldsQuery) or die(mysqli_error($mysqli));
	    while ($resultrow = mysqli_fetch_array($fieldsResult)) {
		$display .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
	    }

	    $display .= '
		</select><br>
		<p>Select the fertilizer and pesticide you used on this field.</p>
		<label class="createapplication" for="fertilizer">Fertilizer:</label>
		<select name="fertilizer">';
	    $fertilizersQuery = "SELECT * FROM fertilizers;";
	    $fertilizersResult = mysqli_query($mysqli, $fertilizersQuery) or die(mysqli_error($mysqli));
	    while ($resultrow = mysqli_fetch_array($fertilizersResult)) {
		$display .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
	    }

	    $display .= '
		</select><br>
		<label class="createapplication" for="pesticide">Pesticide:</label>
		<select name="pesticide" onchange="loadPesticides(this.value)">';
	    $pesticidesQuery = "SELECT * FROM pesticides;";
	    $pesticidesResult = mysqli_query($mysqli, $pesticidesQuery) or die(mysqli_error($mysqli));
	    while ($resultrow = mysqli_fetch_array($pesticidesResult)) {
		$display .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
	    }
	    $display .= '
		</select><br>
		</fieldset>
		<input type="submit" name="submit" value="Submit"/>
	    </form>
	    </div>
	    </div>';
	}
    }
?>
<?php require('head.php'); ?>
<script>
    function loadPesticides(value) {
//	var xmlhttp = new XMLHttpRequest();
//	xmlhttp.onreadystatechange = function() {
//	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//		document.getElementById("test").innerHTML = xmlhttp.responseText;
//	    }
//	}
//	xmlhttp.open("GET", "loadpesticides.php?brand=" + value, true);
//	xmlhttp.send();
    }
</script>
<?php require('header.php'); ?>
    <?php echo $display;?>
<?php require('footer.php'); ?>

