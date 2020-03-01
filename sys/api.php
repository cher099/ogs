<?php 
include 'sys/helpers.php';


$a = isset($_GET['a']) ? $_GET['a'] : null;

switch ($a) {
	case 'test':
		echo json_encode(['test' => 'Working!']);
		break;
	case 'show-grade':
		$teacher_id = $_GET['teacher_id'];
		$section_id = $_GET['section_id'];
		$subject_id = $_GET['subject_id'];
		// json(['teacher_id' => $teacher_id, 'section_id' => $section_id, 'subject_id' => $subject_id]);

		$data = DB::select("select grades.*, students.first_name, students.last_name, students.middle_name, subjects.semester, subjects.school_year from students left join grades on students.id=grades.student_id left join subjects on grades.subject_id=subjects.id WHERE grades.teacher_id=$teacher_id and grades.section_id=$section_id and grades.subject_id=$subject_id");

		json($data);
		break;
	case 'filter-subject-student':
		$teacher_id = $_GET['teacher_id'];
		$section_id = $_GET['section_id'];
		$subject_id = $_GET['subject_id'];
		$semester = $_POST['semester'];
		// json(['teacher_id' => $teacher_id, 'section_id' => $section_id, 'subject_id' => $subject_id]);

		$data = DB::select("select grades.*, students.first_name, students.last_name, students.middle_name, subjects.semester, subjects.school_year from students left join grades on students.id=grades.student_id left join subjects on grades.subject_id=subjects.id WHERE grades.teacher_id=$teacher_id and grades.section_id=$section_id and grades.subject_id=$subject_id");

		json($data);
		break;
	case 'search-student':
		$query = $_GET['q'];

		$students = DB::select("SELECT * FROM students WHERE students.last_name like '%$query%'");

		json($students);
		break;
	case 'add-grade-table':
		$teacher_id = $_GET['teacher_id'];
		$section_id = $_GET['section_id'];
		$subject_id = $_GET['subject_id'];
		$student_id = $_GET['student_id'];
		// json(['teacher_id' => $teacher_id, 'section_id' => $section_id, 'subject_id' => $subject_id, 'student_id' => $student_id]);

		$rs = DB::exec("INSERT INTO grades(id,teacher_id,subject_id,section_id,student_id) VALUES('',$teacher_id,$subject_id,$section_id,$student_id)");

		$status = [];

		if ($rs) {
			$status["message"] = "Student was uccessfully added.";
			$status["code"] = 1;
		} else  {
			$status["message"] = "Error in adding a student.";
			$status["code"] = 0;
		}

		json($status);
		break;
	case 'remove-student-grade':
		$grade_id = $_GET['grade_id'];

		$rs = DB::exec("DELETE FROM grades WHERE grades.id=$grade_id");

		if ($rs) {
			$status["message"] = "Student was successfully removed.";
			$status["code"] = 1;
		} else  {
			$status["message"] = "Error in removing a student.";
			$status["code"] = 0;
		}
		
		json($status);
		break;

	case 'save-student-grade':

		$grades = json_decode($_POST['data']);

		$status = [];

		foreach ($grades as $grade) {

			$rs = DB::exec("UPDATE grades SET first_quarter='{$grade->first_quarter}',second_quarter='{$grade->second_quarter}',semestral_grade='{$grade->semestral_grade}',remark='{$grade->remark}' WHERE grades.id={$grade->id}");

			if (!$rs) {
				$status["{$grade->id}"] = "ERROR"; 
			} 
		}

		json($status);


		break;
	case 'principal-show-grade':

		$teacher_id = $_GET['teacher_id'];
		$section_id = $_GET['section_id'];
		$subject_id = $_GET['subject_id'];

		// json(['teacher_id' => $teacher_id, 'section_id' => $section_id, 'subject_id' => $subject_id]);
		$data = DB::select("SELECT grades.*, students.first_name, students.last_name, students.middle_name FROM students LEFT JOIN grades on students.id=grades.student_id WHERE grades.teacher_id='$teacher_id' AND grades.section_id='$section_id' AND grades.subject_id='$subject_id'");

		json($data);
		

		break;
	default:
		# code...
		break;
}

?>