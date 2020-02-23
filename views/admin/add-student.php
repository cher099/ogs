<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Add Student</p>
  </div>
  <div class="card-body">
      <div class="col-md-12">
        
    		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    				<div class="form-group row mb-2 ">
    					<div class="col-md-2 text-right mt-1"><small>ID Number</small></div>
	    				<div class="col-md-3">
	    					<input class="form-control" placeholder="ID Number" type="text" name="id_number" required />
	    				</div>
                        <div class="col-md-2 text-right mt-1"><small>School Year</small></div>
                        <div class="col-md-3">
                     <!--        <input class="form-control" placeholder="School Year" type="text" name="school_year" required /> -->

                            <select class="form-control" name="school_year" required > 
                                <?php  
                                    foreach ($school_years as $school_year) {
                                    ?>
                                        <option value="<?php echo $school_year['name']; ?>"><?php echo $school_year['name']; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
    				</div>
                    <div class="form-group row mb-2 ">
                        <div class="col-md-2 text-right mt-1"><small>First Name</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="First Name" type="text" name="first_name" required />
                        </div>
                        <div class="col-md-2 text-right mt-1"><small>Grade Level</small></div>
                        <div class="col-md-3">
                            <select class="form-control" name="grade_level">
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="Grade 11">Grade 11</option>
                                <option value="Grade 12">Grade 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-2 ">
                        <div class="col-md-2 text-right mt-1"><small>Middle Name</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="Middle Name" type="text" name="middle_name" required />
                        </div>
                        <div class="col-md-2 text-right mt-1"><small>Section</small></div>
                        <div class="col-md-3">
                            <select class="form-control" name="section">
                               <?php foreach ($sections as $key => $section) { ?>
                                    <option value="<?php echo $section['id']; ?>"><?php echo $section['name']; ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row mb-2 ">
                        <div class="col-md-2 text-right mt-1"><small>Last Name</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="Last Name" type="text" name="last_name" required />
                        </div>
                        <div class="col-md-2 text-right mt-1"><small>Birth Date</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="Birth Date" type="date" name="birth_date" required />
                        </div>
                    </div>
                     <div class="form-group row mb-2 ">
                        <div class="col-md-2 text-right mt-1"><small>Address</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="Address" type="textarea" name="address" required />
                        </div>
                        <div class="col-md-2 text-right mt-1"><small>Username</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="Username" type="text" name="username">
                        </div>
                    </div>
                     <div class="form-group row mb-2 ">
                        <div class="col-md-2 text-right mt-1"><small>Gender</small></div>
                        <div class="col-md-3">
                            <select class="form-control" name="sex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-2 text-right mt-1"><small>Password</small></div>
                        <div class="col-md-3">
                            <input class="form-control" placeholder="Password" type="password" name="password" required />
                        </div>
                    </div>



    				<div class="form-group row mb-2">
    					<div class="col-md-1 text-right mt-1"></div>
	    				<div class="col-md-9">
	    					<button name="add-student" type="submit" class="btn btn-primary btn-user btn-block">Save Student</button>
	    				</div>
    				</div>
    		</form>
    	</div>
	<!-- end add student-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->