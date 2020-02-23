	<?php echo css('new'); ?>
	<?php echo css('sb-admin-2'); ?>
</head>
<body class="bg">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-md-6 col-lg-4">

        <div class="card o-hidden border-0 shadow-lg my-5 " style="opacity: 0.9;">
          <div class="card-header text-center transparent">
          	<p style="margin-bottom: 0;"><b>GTCD K-12 Online Grading System</b></p>
          </div>
          <div class="card-body p-0 transparent" style="background-image: url(assets/imgs/logo.jpg);margin-top: 10px;height: 335px;">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
              	<?php include 'views/inc/errorMessage.php'; ?>
                <div class="px-4 py-3" style="padding: 2em 1.5em 4em 1.5em !important">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control" placeholder="Username" required/>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control"  placeholder="Password" required/>
                    </div>
                    <div class="form-group">
                      <select class="form-control" name="type">
                        <option value="0" selected>Student</option>
                        <option value="1">Teacher</option>
                        <option value="2">Principal</option>
                      </select>
                    </div>
                    <button name="login" type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
	<?php echo js('jquery-3.4.1') ?>
	<script type="text/javascript">
		$.ajax({
			url: 'sys/api.php?a=test',
			method: 'POST',
			success: (data) => {
				console.log(data);
			}
		});
	</script>
</body>