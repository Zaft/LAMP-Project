<?php

function connectToDB() {
	//global $mysqli;

	$mysqli = mysqli_connect("localhost", "organicDBuser", "letmein", "organic");

	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	return $mysqli;
}

