<?php
    session_start();
    include("connection.php");
    $mysqli = connectToDB();
    
    $sql = "SELECT * FROM crop_subtypes WHERE crop_id = " . $_REQUEST['crop'] . ";";
    $queryResult = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
    $result = array();
    while ($row = mysqli_fetch_array($queryResult)) {
	array_push($result, array('id'=>$row['id'], 'name'=>$row['name']));
    }
    echo json_encode($result);

