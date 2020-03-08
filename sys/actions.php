<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$type = $_POST['type'];

		$table = (['students','teachers','principals'])[$type];

		$data = DB::select("select * from $table where $table.username='$username'")[0];
		
		if (count($data) > 0){
			if ($data['password'] == $password){
				$data['type'] = $table;
				$_SESSION['user'] = $data;
				if ($type === '2') {
					to("index.php?p=principals&a=add-student");
				} else {
				to("index.php?p=" . $table . "&a=view-subjects");
				}
			} else {
				$_SESSION['error'] = 'Invalid password, try again!';
				to('index.php?p=login');
			}
		} else {
			$_SESSION['error'] = "User doesn't exist!";
			to('index.php?p=login');
		}
	} elseif (isset($_POST['update-student'])){
		$id = $_POST['id'];
		$id_number = $_POST['id_number'];
		$school_year = $_POST['school_year'];
		$first_name = $_POST['first_name'];
		$grade_level = $_POST['grade_level'];
		$middle_name = $_POST['middle_name'];
		$address = $_POST['address'];
		$section = $_POST['section'];
		$last_name = $_POST['last_name'];
		$birth_date = $_POST['birth_date'];
		$sex = $_POST['sex'];
		$username = $_POST['username'];
		$password = $_POST['password'];
	    $query = "UPDATE students SET first_name='$first_name',last_name='$last_name',middle_name='$middle_name',address='$address',school_year='$school_year',grade_level='$grade_level',section='$section',username='$username',password='$password',birth_date='$birth_date',sex='$sex' WHERE students.id=$id";

		$rs = DB::exec($query);
		
		if ($rs) {
			$_SESSION['success'] = 'Student was updated successfully';
			to("index.php?p=principals&a=view-student");
		} else {
			$_SESSION['error'] = 'Error in updating a student';
			to('index.php?p=principals&a=view-student');
		}
	} elseif (isset($_POST['add-student'])){
		$id_number = $_POST['id_number'];
		$school_year = $_POST['school_year'];
		$first_name = $_POST['first_name'];
		$grade_level = $_POST['grade_level'];
		$middle_name = $_POST['middle_name'];
		$address = $_POST['address'];
		$section = $_POST['section'];
		$last_name = $_POST['last_name'];
		$birth_date = $_POST['birth_date'];
		$sex = $_POST['sex'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$rs = DB::exec("INSERT INTO `students` (`id`, `id_number`, `first_name`, `last_name`, `middle_name`, `address`, `sex`, `school_year`, `grade_level`, `section`, `username`, `password`, `birth_date`, `date_enrolled`) VALUES (NULL, '$id_number', '$first_name', '$last_name', '$middle_name', '$address', '$sex', '$school_year', '$grade_level', '$section', '$username', '$password', '$birth_date', '".now()."')");

		/* ADD STUDENT DATA TO GRADES
		$student = DB::select("SELECT students.* FROM students WHERE students.id_number='$id_number'")[0];
		$subjects = DB::select("SELECT subject_id from subject_teachers where teacher_id={$teacher['id']}");
		foreach ($subjects as $subject) {
		    $section_id = $teacher['section'];
		    $student_id = $student['id'];
		    $teacher_id = $teacher['id'];
		    $subject_id = $subject['subject_id'];
		    $rs = DB::exec("INSERT INTO `grades` (`id`, `teacher_id`, `subject_id`, `section_id`, `student_id`) VALUES (NULL, '$teacher_id', '$subject_id', '$section_id', '$student_id')");
		} */
		if ($rs) {
			$_SESSION['success'] = 'Student was added successfully';
			to("index.php?p=principals&a=view-student");
		} else {
			$_SESSION['error'] = 'Error in adding a student';
			to("index.php?p=principals&a=add-student");
		}
	} elseif (isset($_POST['update-section'])){
		$level_id = $_POST['level_id'];
		$section =  $_POST['section'];
		$id = $_POST['id'];

		$rs = DB::exec("UPDATE section SET name='$section',level_id='$level_id' WHERE id=$id");

		if ($rs) {
			$_SESSION['success'] = 'Section was updated successfully';
			to('index.php?p=principals&a=add-section');
		} else {
			$_SESSION['error'] = 'Error in updating a section';
			to('index.php?p=principals&a=add-section');
		}
	} elseif (isset($_POST['add-section'])) { 
		$level_id = $_POST['level_id'];
		$section = $_POST['section'];
		
		$rs = DB::exec("INSERT INTO `section` VALUES (NULL, '$section', '$level_id')");
		if ($rs) {
			$_SESSION['success'] = 'Section was added successfully';
			to('index.php?p=principals&a=add-section');
		} else { 
			echo $_SESSION['error'] = 'Error in adding a section';
			to('index.php?p=principals&a=add-section');
		}
	} elseif (isset($_POST['add-subject-teacher'])){ 
		$subject_id =  $_POST['subject_id'];
		$teacher_id =  $_POST['teacher_id'];

		$rs = DB::exec("INSERT INTO `subject_teachers` VALUES (NULL, '$subject_id', '$teacher_id')");
		if ($rs) {
			$_SESSION['success'] = 'Subject teacher was added successfully';
			to('index.php?p=principals&a=add-subject');
		} else {
			$_SESSION['error'] = 'Error in adding a subject teacher';
			to('index.php?p=principals&a=add-subject');
		}
	} elseif (isset($_POST['update-subject'])) {
		$id =  $_POST['id'];
		$level_id =  $_POST['level_id'];
		$name =  $_POST['subject'];
		$semester =  $_POST['semester'];
		$track =  $_POST['track'];
		$school_year =  $_POST['school_year'];
		$rs = DB::exec("UPDATE subjects SET level_id='$level_id',name='$name',semester='$semester',track='$track',school_year='$school_year' WHERE subjects.id=$id");
		if ($rs) { 
			$_SESSION['success'] = 'Subject was updated successfully';
			to('index.php?p=principals&a=add-subject');
		} else { 
			$_SESSION['error'] = 'Error in updating a subject';
			to('index.php?p=principals&a=add-subject');
		}
	} elseif (isset($_POST['add-subject'])){
		$level_id =  $_POST['level_id'];
		$name =  $_POST['subject'];
		$semester =  $_POST['semester'];
		$track =  $_POST['track'];
		$school_year =  $_POST['school_year'];

		$rs = DB::exec("INSERT INTO `subjects` VALUES (NULL, '$level_id', '$name', '$semester', '$track', '$school_year')");
		if ($rs) {
			$_SESSION['success'] = 'Subject was added successfully';
			to('index.php?p=principals&a=add-subject');
		} else { 
			$_SESSION['error'] = 'Error in adding a subject';
			to('index.php?p=principals&a=add-subject');
		}
	} elseif (isset($_POST['add-teacher'])){
		$first_name =  $_POST['first_name'];
		$middle_name =  $_POST['middle_name'];
		$last_name =  $_POST['last_name'];
		$section=  $_POST['section'];
		$username =  $_POST['username'];
		$password =  $_POST['password'];
		$level_id = $_POST['level_id'];
		$rs = DB::exec("INSERT INTO `teachers` VALUES (NULL, '$level_id', '$first_name', '$middle_name', '$last_name',  '$section', '$username', '$password')");
		if ($rs) {
			$_SESSION['success'] = 'Teacher was added successfully';
			to("index.php?p=principals&a=view-teacher");
		} else {
			$_SESSION['error'] = 'Error in adding a teacher';
			to("index.php?p=principals&a=add-teacher");
		}
	} elseif (isset($_POST['update-teacher'])){
		$id = $_POST['id'];
		$first_name =  $_POST['first_name'];
		$middle_name =  $_POST['middle_name'];
		$last_name =  $_POST['last_name'];
		$section=  $_POST['section'];
		$username =  $_POST['username'];
		$password =  $_POST['password'];
		$level_id = $_POST['level_id'];
		$rs = DB::exec("UPDATE teachers SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',section='$section',username='$username',password='$password',level_id='$level_id' WHERE teachers.id=$id");
		if ($rs) {
			$_SESSION['success'] = 'Teacher was updated successfully';
			to("index.php?p=principals&a=view-teacher");
		} else {
			$_SESSION['error'] = 'Error in updating a teacher';
			to('index.php?p=principals&a=view-teacher');
		}
	} elseif (isset($_POST['update-admin'])){
		$id = $_POST['id'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$rs = DB::exec("UPDATE principals SET first_name='$first_name',last_name='$last_name',middle_name='$middle_name',username='$username',password='$password' WHERE principals.id=$id");
		if ($rs) {
			$_SESSION['success'] = 'An admin was updated successfully';
			to('index.php?p=principals&a=view-admin');
		} else {
			$_SESSION['error'] = 'Error in updating an admin';
			to('index.php?p=principals&a=view-admin');
		}
	} elseif (isset($_POST['add-school-year'])){
		$name = $_POST['school_year'];

		$rs = DB::exec("INSERT INTO `school_year` VALUES (NULL, '$name')");
		if ($rs) {
			$_SESSION['success'] = 'A school year was added successfully';
			to('index.php?p=principals&a=add-school-year');
		} else {
			$_SESSION['error'] = 'Error in adding a school year';
			to('index.php?p=principals&a=add-school-year');
		}
	} elseif (isset($_POST['update-school-year'])){
		$id = $_POST['id'];
		$name = $_POST['school_year'];

		$rs = DB::exec("UPDATE school_year SET name='$name' WHERE school_year.id=$id");
		if ($rs) {
			$_SESSION['success'] = 'A school year was updated successfully';
			to('index.php?p=principals&a=add-school-year');
		} else { 
			$_SESSION['error'] = 'Error in updating a school year';
			to('index.php?p=principals&a=add-school-year');
		}
	} elseif (isset($_POST['add-admin'])){
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$rs = DB::exec("INSERT INTO `principals` VALUES (NULL, '$first_name', '$middle_name', '$last_name', '$username', '$password')");
		if ($rs) { 
			$_SESSION['success'] = 'An admin was added successfully';
			to("index.php?p=principals&a=view-admin");
		} else {
			$_SESSION['error'] = 'Error in adding an admin';
			to("index.php?p=principals&a=add-admin");
		}
	} elseif (isset($_POST['reset-password'])){
		$current_password = $_POST['current_password'];
		$new_password = $_POST['new_password'];
		$confirm_password = $_POST['confirm_password'];

		$logged_id = $_SESSION['user']['id'];
		$table = $_SESSION['user']['type'];

		$temp = DB::select("SELECT * FROM $table WHERE $table.id=$logged_id")[0];

		if ($confirm_password === $new_password){
			if ($current_password === $temp['password']){
				$rs = DB::exec("UPDATE $table SET password='$new_password' WHERE $table.id=$logged_id");
				if ($rs) {
					$_SESSION['success'] = 'Password was updated successfully';
					to('index.php?p='.$table.'&a=change-password'); //1:Changed from principals, a static value, therefore calling admin pages only, $table will get the data from database as a user type.
				}
			} else {
				$_SESSION['error'] = 'Temporary password does not match.';
		 		to('index.php?p='.$table.'&a=change-password'); //Refer to 1:
			}
		} else {
			$_SESSION['error'] = 'Password does not match.';
		 	to('index.php?p='.$table.'&a=change-password'); //Refer to 1:
		}
	}
} else {
	if (isset($_GET['delete_student']) && $_SESSION['user']['type'] === 'principals') {
		$students = DB::select("SELECT * FROM students WHERE id={$_GET['delete_student']}");
		if (count($students) == 0){
			$_SESSION['error'] = 'ID is not valid.';
			to('index.php?p=principals&a=view-student');
		}
		$students = $students[0];
		$sql = "DELETE FROM students WHERE students.id={$_GET['delete_student']}";
		$rs = DB::exec($sql);
		if ($rs) { 
			$_SESSION['success'] = 'Student was deleted successfully';
			to('index.php?p=principals&a=view-student');
		} else { 
			$_SESSION['error'] = 'Error in deleting a student';
			to('index.php?p=principals&a=view-student');
		}
	} elseif (isset($_GET['delete_teacher']) && $_SESSION['user']['type'] === 'principals'){
		$sql = "DELETE FROM teachers WHERE teachers.id={$_GET['delete_teacher']}";
		$rs = DB::exec($sql);
		if ($rs) { 
			$_SESSION['success'] = 'Teacher was deleted successfully';
			to('index.php?p=principals&a=view-teacher');
		} else { 
			$_SESSION['error'] = 'Error in deleting a teacher';
			to('index.php?p=principals&a=view-teacher');
		}
	} elseif (isset($_GET['delete_admin']) && $_SESSION['user']['type'] === 'principals'){
		$sql = "DELETE FROM principals WHERE principals.id={$_GET['delete_admin']}";
		$rs = DB::exec($sql);
		if ($rs) {
			$_SESSION['success'] = 'Admin was deleted successfully';
			to('index.php?p=principals&a=view-admin');
		} else { 
			$_SESSION['error'] = 'Error in deleting an admin';
			to('index.php?p=principals&a=view-admin');
		}
	} elseif (isset($_GET['delete_section']) && $_SESSION['user']['type'] === 'principals'){
		$sql = "DELETE FROM section WHERE section.id={$_GET['delete_section']}";
		$rs = DB::exec($sql);
		if ($rs) { 
			$_SESSION['success'] = 'Section was deleted successfully';
			to('index.php?p=principals&a=add-section');
		} else { 
			$_SESSION['error'] = 'Error in deleting an section';
			to('index.php?p=principals&a=add-section');
		}
	} elseif (isset($_GET['delete_subject']) && $_SESSION['user']['type'] === 'principals'){
		$sql = "DELETE FROM subjects WHERE subjects.id={$_GET['delete_subject']}";
		$rs = DB::exec($sql);
		if ($rs) {
			$_SESSION['success'] = 'Subject was deleted successfully';
			to('index.php?p=principals&a=add-subject');
		} else {
			$_SESSION['error'] = 'Error in deleting an subject';
			to('index.php?p=principals&a=add-subject');
		}
	} elseif (isset($_GET['delete_subject_teacher']) && $_SESSION['user']['type'] === 'principals'){
		$sql = "DELETE FROM subject_teachers WHERE subject_teachers.id={$_GET['delete_subject_teacher']}";
		$rs = DB::exec($sql);
		if ($rs) { 
			$_SESSION['success'] = 'Subject teacher was deleted successfully';
			to('index.php?p=principals&a=add-subject');
		} else { 
			$_SESSION['error'] = 'Error in deleting an subject teacher';
			to('index.php?p=principals&a=add-subject');
		}
	} elseif (isset($_GET['delete_school_year']) && $_SESSION['user']['type'] === 'principals'){
		$sql = "DELETE FROM school_year WHERE school_year.id={$_GET['delete_school_year']}";
		$rs = DB::exec($sql);
		if ($rs) { 
			$_SESSION['success'] = 'School year was deleted successfully';
			to('index.php?p=principals&a=add-school-year');
		} else { 
			$_SESSION['error'] = 'Error in deleting a school year';
			to('index.php?p=principals&a=add-school-year');
		}
	}
	
}


?>