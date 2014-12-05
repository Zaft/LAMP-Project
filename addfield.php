<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    if(!$_SESSION['member_id']) {
	header("Location: login.php");
    } else {
	if ((filter_input(INPUT_POST, 'fieldname'))) {	
	    $member_id = $_SESSION['member_id'];
	    $fieldname = filter_input(INPUT_POST, 'fieldname');
	    $crop = filter_input(INPUT_POST, 'crop');
	    $crop_subtype = filter_input(INPUT_POST, 'crop_subtype');
	    $area = filter_input(INPUT_POST, 'fieldarea');

	    $sql = "INSERT into fields values('null','"
		.$member_id."','".$fieldname."','".$crop."','".$crop_subtype."','".$area."');";

	    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	    header("Location: home.php");
	} else {
	    $displayBlock = '
	    <div class="content">
	    <div class="contentblock">
		<h3> Create a New Field </h3>
		<form method="POST" action="">
		    <fieldset>
		    <legend>Field Details</legend>
		    <p>Provide a name to identify your field.</p>
		    <label class="addfield" for="fertilizer">Field Name:</label>
		    <input type ="text" name="fieldname">
		    </br>
		    <label class="addfield" for="fieldarea">Field Area (acres):</label>
		    <input type ="text" name="fieldarea">
		    </br>
		    <p>Select a Crop for this field.</p>
		    <label class="addfield" for="crop">Type of crop: </label>
		    <select name="crop" onchange="loadCropSubtypes(this.value)">
	    </div>
	    </div>';
	    $cropsQuery = "SELECT * FROM crops;";
	    $cropsResult = mysqli_query($mysqli, $cropsQuery) or die(mysqli_error($mysqli));
	    while ($resultrow = mysqli_fetch_array($cropsResult)) {
		$displayBlock .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
	    }
	    $displayBlock .= '
		</select><br>
		<label class="addfield" for="crop_subtype">Variety of crop: </label>
		<select name="crop_subtype"></select><br>
		</fieldset>
		<input type="submit" name="submit" value="Submit"/>
		</form>';
	}
    }
?>
<?php require('head.php'); ?>
<script>
    window.onload = function() { loadCropSubtypes(1); }
    function loadCropSubtypes(value) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var subtypes = JSON.parse(xmlhttp.responseText);
		var str = "";
		for (var i = 0; i < subtypes.length; i++) {
		    str += '<option value="' + subtypes[i].id + '">' + subtypes[i].name + '</option>';
		}
		document.getElementsByName("crop_subtype")[0].innerHTML = str;
	    }
	}
	xmlhttp.open("GET", "loadcropsubtypes.php?crop=" + value, true);
	xmlhttp.send();
    }
</script>
<?php require('header.php'); ?>
    <?php echo $displayBlock ?>
<?php require('footer.php'); ?>
