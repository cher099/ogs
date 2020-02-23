	<?php echo css('sb-admin-2'); ?>
	<?php echo css('font-awesome/all'); ?>
	<?php echo css('datatables.min'); ?>
	<style>
		<?php if (!isset($_GET['a'])) { ?>
			#content {
				background-image: url("<?php echo img('img-3.jpg'); ?>");
				/*height: 100%; 
			   Set a specific height */
			  height: 90px;

			  /* Create the parallax scrolling effect */
			  background-attachment: fixed;
			  background-position: center;
			  background-repeat: no-repeat;
			  background-size: cover;
			}

			@import url('https://fonts.googleapis.com/css?family=Roboto:300');

			div.an-body {
			  text-align:center;
			  /*background-color:#83dfb3;*/
			  background:linear-gradient(141deg, #ccc 25%, #eee 40%, #ddd 55%);
			  color:#247c33;
			  font-family:'Roboto';
			  font-weight:300;
			  font-size:32px;
			  padding-top:5vh;
			  height:15vh;
			  overflow:hidden;
			  -webkit-backface-visibility: hidden;
			  -webkit-perspective: 1000;
			  -webkit-transform: translate3d(0,0,0);
			  font-weight:bold;
			}

			div.an-div {
			  display:inline-block;
			  overflow:hidden;
			  white-space:nowrap;
			}

			div.an-div:first-of-type {    /* For increasing performance 
			                       ID/Class should've been used. 
			                       For a small demo 
			                       it's okaish for now */
			  animation: showup 7s infinite;
			}

			div.an-div:last-of-type {
			  width:0px;
			  animation: reveal 7s infinite;
			}

			div.an-div:last-of-type span {
			  margin-left:-355px;
			  animation: slidein 7s infinite;
			}

			@keyframes showup {
			    0% {opacity:0;}
			    20% {opacity:1;}
			    80% {opacity:1;}
			    100% {opacity:0;}
			}

			@keyframes slidein {
			    0% { margin-left:-800px; }
			    20% { margin-left:-800px; }
			    35% { margin-left:0px; }
			    100% { margin-left:0px; }
			}

			@keyframes reveal {
			    0% {opacity:0;width:0px;}
			    20% {opacity:1;width:0px;}
			    30% {width:355px;}
			    80% {opacity:1;}
			    100% {opacity:0;width:355px;}
			}


			p.an-p {
			  font-size:12px;
			  color:#999;
			  margin-top:200px;
			}
		<?php } ?>
	</style>
</head>
<body id="page-top"> 

<?php include 'views/inc/navbar.php'; ?>
	<div class="col-md-12">
		<?php 
		 	include 'views/inc/errorMessage.php';
			$action = isset($_GET['a']) ? $_GET['a'] : '';

			switch ($action) {
				case 'add-student':

					$school_years = DB::select("SELECT * FROM school_year");
					$sections = DB::select("SELECT * FROM section");
					include 'views/admin/add-student.php';
					break;
				case 'add-teacher':

					$sections = DB::select("SELECT * FROM section");
					$levels = DB::select("SELECT * from levels");
					include 'views/admin/add-teacher.php';
					break;
				case 'add-admin':
					include 'views/admin/add-admin.php';
					break;
				case 'change-password':
					include 'views/admin/change-password.php';
					break;
				case 'view-student':
					$sql = "SELECT students.*, section.name as section_name FROM students left join section on students.section= section.id";
					if (isset($_GET['query'])) {
						$query = $_GET['query'];
						$sql .= " WHERE students.last_name like '%$query%'";
					}
					$school_years = DB::select("SELECT * FROM school_year");
					$sections = DB::select("SELECT * FROM section");
					$students = DB::select($sql);
					include 'views/admin/view-student.php';
					break;
				case 'view-teacher':

					$sql = "select teachers.*, section.name as section_name, levels.name as level_name, levels.id as level_id from teachers left join levels on teachers.level_id=levels.id left join section on teachers.section=section.id";
					if (isset($_GET['query'])) {
						$query = $_GET['query'];
						$sql .= " WHERE teachers.last_name like '%$query%'";
					}
					$sections = DB::select("SELECT * FROM section");
					$teachers = DB::select($sql);
					$levels = DB::select("SELECT * FROM levels");
					include 'views/admin/view-teacher.php';
					break;
				case 'view-admin':

					$sql = "SELECT * FROM principals";
					if (isset($_GET['query'])) {
						$query = $_GET['query'];
						$sql .= " WHERE principals.last_name like '%$query%'";
					}
					$admins = DB::select($sql);
					include 'views/admin/view-admin.php';
					break;
				case 'add-section':

					$levels = DB::select("SELECT * FROM levels");
					$sections = DB::select("SELECT section.*, levels.name as level_name FROM section left join levels on section.level_id=levels.id");
					include 'views/admin/add-section.php';
					break;
				case 'add-subject':

					$levels = DB::select("SELECT * FROM levels");
					$teachers = DB::select("SELECT * FROM teachers");
					$school_years = DB::select("SELECT * FROM school_year");
					$subjects = DB::select("SELECT subjects.*, levels.name as level_name FROM subjects left join levels on subjects.level_id=levels.id");
					include 'views/admin/add-subject.php';
					break;
				case 'add-grade':

					$subjects = DB::select("SELECT * FROM subjects");
					$teachers = DB::select("SELECT * FROM teachers");
					$sections = DB::select("SELECT * FROM section");
					include 'views/admin/add-grade.php';
					break;
				case 'add-school-year':

					$school_years = DB::select("SELECT * FROM school_year");
					include 'views/admin/add-schoolyear.php';
					break;
				default:
					include 'views/admin/main.php';
					break;
			}
		?>

	</div>
<?php include 'views/inc/footer.php'; ?>

	<!-- Footer -->
	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
		  <div class="copyright text-center my-auto">
		    <span>Copyright Online Grading System &copy;</span>
		  </div>
		</div>
	</footer>
	<!-- End of Footer -->
	
	<?php echo js('jquery.min'); ?>
	<?php echo js('bootstrap.bundle.min'); ?>
	<?php echo js('jquery.easing.min'); ?>
	<?php echo js('sb-admin-2.min'); ?>
	<?php echo js('vue'); ?>
	<?php echo js('jquery.dataTables.min'); ?>
	<?php echo js('datatables.min'); ?>
	<?php echo js('dataTables.bootstrap4.min'); ?>
</body>