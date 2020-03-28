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

<?php  include 'views/inc/navbar.php'; ?>
	<div class="col-md-12">
		<?php 
		 	include 'views/inc/errorMessage.php';
			$action = isset($_GET['a']) ? $_GET['a'] : '';
			switch ($action) {
				case 'view-subjects':
					//$school_year = DB::select("SELECT * FROM school_year");
					//$subjects = DB::select("SELECT grades.*, subjects.name, subjects.track, subjects.school_year, subjects.semester FROM grades LEFT JOIN subjects ON grades.subject_id=subjects.id WHERE grades.student_id={$_SESSION['user']['id']}");
					include 'views/student/view-subjects.php';
					break;
				case 'change-password':
					include 'views/student/change-password.php';
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