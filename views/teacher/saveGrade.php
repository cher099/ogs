<?php 

	$firstGrade = $_POST['firstGrade'];
	$secondGrade = $_POST['secondGrade'];
	$semeGrade = $_POST['semeGrade'];
	$gradeRemarks = $_POST['gradeRemarks'];
	$student = $_POST['student'];
	$subject_id = $_POST['subject_id'];
	$section_id = $_POST['section_id'];
	$teacher_id = $_POST['teacher_id'];
	$count = count($gradeRemarks);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ogs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

for( $i = 0; $i < $count; $i++) {
		$sql = "INSERT INTO grades (teacher_id, section_id, student_id, subject_id, first_quarter, second_quarter, semestral_grade, remark) VALUES ('$teacher_id', '$section_id','$student[$i]', '$subject_id', '$firstGrade[$i]', '$secondGrade[$i]', '$semeGrade[$i]', '$gradeRemarks[$i]')";	


		if ($conn->query($sql) === TRUE) {
   			 echo "New record created successfully";
		} else {
   			 echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}



$conn->close();


	
?>