<?php

	$id = $_POST['id'];
	$first_quarter = $_POST['first_quarter'];
	$second_quarter = $_POST['second_quarter'];
	$semestral_grade = $_POST['semestral_grade'];
	$remarks = $_POST['remarks'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ogs";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "UPDATE grades SET remark='".$remarks."',first_quarter=".$first_quarter.",second_quarter=".$second_quarter.",semestral_grade=".$semestral_grade." WHERE id=".$id."";

	if (mysqli_query($conn, $sql)) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . mysqli_error($conn);
	}

	mysqli_close($conn);


?>