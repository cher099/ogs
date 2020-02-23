<?php 
$page = isset($_GET['p']) ? $_GET['p'] : '' ;

// check if log-in
if (!isset($_SESSION['user']) && $page != 'login') {
	to('index.php?p=login');
}

switch ($page) {
	case 'logout':
		unset($_SESSION['user']);
		to('index.php?p=login');
		break;
	case 'login':
		include 'views/login.php';
		break;
	case 'students':
		$user = $_SESSION['user'];
		$navbar = [
			"title"=> $user['last_name'].", ".$user['first_name'],
			"main"=> url("index.php?p=students&a=view-subjects"),
			"links" => [
				"SUBJECTS" => url("index.php?p=students&a=view-subjects"),
				"CHANGE PASSWORD" => url("index.php?p=students&a=change-password"),
				"LOGOUT" => url("index.php?p=logout")
			]
		];

		include 'views/student.php';
		break;
	case 'teachers':
		$user = $_SESSION['user'];
		$navbar = [
			"title" => $user['last_name'].", ".$user['first_name'],
			"main" => "index.php?p=teachers",
			"links" => [
				"SUBJECTS" => url("index.php?p=teachers&a=view-subjects"),
				"CHANGE PASSWORD" => url("index.php?p=teachers&a=change-password"),
				"LOGOUT" => url("index.php?p=logout")
			]
		];

		include 'views/teacher.php';
		break;
	case 'principals':
		$navbar = [
			"title" => "ADMIN",
			"main" => url("index.php?p=principals&a=add-student"),
			"links" => [
				"ADD-ACCOUNT" => [
					"Add Student" => url("index.php?p=principals&a=add-student"),
					"Add Teacher" => url("index.php?p=principals&a=add-teacher"),
					"Add Admin" => url("index.php?p=principals&a=add-admin")
				],
				"VIEW-ACCOUNT" => [
					"View Student" => url("index.php?p=principals&a=view-student"),
					"View Teacher" => url("index.php?p=principals&a=view-teacher"),
					"View Admin" => url("index.php?p=principals&a=view-admin")
				],
				// "UPDATE-ACCOUNT" => [
				// 	"Update Student" => "#",
				// 	"Update Teacher" => "#",
				// 	"Update admin" => "#"
				// ],
				"ADD-SECTION" => url("index.php?p=principals&a=add-section"),
				"ADD-SCHOOL-YEAR" => url("index.php?p=principals&a=add-school-year"),
				"ADD-SUBJECT-LOAD" => url("index.php?p=principals&a=add-subject"),
				"EDIT-GRADE" => url("index.php?p=principals&a=add-grade"),
				"CHANGE PASSWORD" => url("index.php?p=principals&a=change-password"),
				"LOGOUT" => url("index.php?p=logout"),
			]
		];

		include 'views/principal.php';
			
		break;
	default:
		?>
		<h1 class="display-4 text-center mt-3">Error 404. Page not found.</h1>
		<?php
		break;
}

?>