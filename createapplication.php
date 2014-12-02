<?php
    include("connection.php");
    $mysqli = connectToDB();

    if (filter_input(INPUT_POST, 'submit')) {
	$display .= filter_input(INPUT_POST, 'fertilizer') . "<br>";
	$display .= filter_input(INPUT_POST, 'pesticide') . "<br>";
	$insertApplicationSQL = "INSERT INTO applications VALUES(null, null,"
		. filter_input(INPUT_POST, 'pesticide') . ","
		. filter_input(INPUT_POST, 'fertilizer') . ");";
	//mysqli_query($mysqli, $insertApplicationSQL) or die(mysqli_error($mysqli));
    } else {
	$display = '
	<form method="post" action="">
	    <label class="createapplication" for="fertilizer">Fertilizer:</label>
	    <select name="fertilizer">';
	$fertilizersQuery = "SELECT * FROM fertilizers;";
	$fertilizersResult = mysqli_query($mysqli, $fertilizersQuery) or die(mysqli_error($mysqli));
	while ($resultrow = mysqli_fetch_array($fertilizersResult)) {
	    $display .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
	}
	$display .= '
	    </select>
	    <br>
	    <label class="createapplication" for="pesticide">Pesticide:</label>
	    <select name="pesticide">';
	$pesticidesQuery = "SELECT * FROM pesticides;";
	$pesticidesResult = mysqli_query($mysqli, $pesticidesQuery) or die(mysqli_error($mysqli));
	while ($resultrow = mysqli_fetch_array($pesticidesResult)) {
	    $display .= '<option value="' . $resultrow['id'] . '">' . $resultrow['name'] . '</option>';
	}
	$display .= '
	    </select>
	    <br>
	    <input type="submit" name="submit" value="Apply"/>
	</form>';
    }
?>
<html>
    <head>
	<link rel="stylesheet" type="text/css" href="style.css">
        <title>Create an Application</title>
    </head>
    <body>
	<?php echo $display;?>
    </body>
</html>

