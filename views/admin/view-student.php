<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">View Student</p>
  </div>
  <div class="card-body">
    <!-- <form method="GET">
        <input type="hidden" name="p" value="principals" />
        <input type="hidden" name="a" value="view-student" />
        <div class="row">
            <div class="col-md-4 ml-auto">
                <div class="input-group mb-3">
                <input type="text" placeholder="Search student's last name" name="query" aria-label="Search student name" aria-describedby="basic-addon2" class="form-control" /> 
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary">
                            <li class="fas fa-search"></li>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
<?php if (count($students) == 0) { ?>
    <div class="col-md-6 m-auto text-center">
        <p class="lead">No students found.</p>
    </div>
<?php } else { ?>
    <div class="col-md-12 table-responsive">
        <table id="view-student-table" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID #</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>School Year</th>
                    <th>Grade Level</th>
                    <th>Section</th>
                    <th>Username</th>
                    <th>Birthdate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $key => $student) { ?>
                <tr>
                    <td><?php echo $student['id_number']; ?></td>
                    <td><?php echo $student['first_name']; ?></td>
                    <td><?php echo $student['middle_name']; ?></td>
                    <td><?php echo $student['last_name']; ?></td>
                    <td><?php echo $student['address']; ?></td>
                    <td><?php echo $student['sex']; ?></td>
                    <td><?php echo $student['school_year']; ?></td>
                    <td><?php echo $student['grade_level']; ?></td>
                    <td><?php echo $student['section_name']; ?></td>
                    <td><?php echo $student['username']; ?></td>
                    <td><?php echo $student['birth_date']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-<?php echo $student['id']; ?>">Edit</button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#delete-modal-<?php echo $student['id']; ?>">Delete</button>
                    </td>
                    <!-- modal for deleting -->
                    <div class="modal" id="delete-modal-<?php echo $student['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-6 m-auto">
                                <a href="index.php?delete_student=<?php echo $student['id']; ?>" class="btn btn-block btn-danger">Do you want to delete?</a>
                                <button data-dismiss="modal" class="btn btn-block btn-secondary">Cancel</button>
                            </div>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal for editing -->
                    <div class="modal" id="edit-modal-<?php echo $student['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Student</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                           <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group row mb-2 ">
                                <div class="col-md-2 text-right mt-1"><small>ID Number</small></div>
                                <div class="col-md-3">
                                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                    <input class="form-control" placeholder="ID Number" type="text" name="id_number" value="<?php echo $student['id_number'] ?>" required readonly />
                                </div>
                                <div class="col-md-2 text-right mt-1"><small>School Year</small></div>
                                <div class="col-md-3">
                             <!--        <input class="form-control" placeholder="School Year" type="text" name="school_year" required /> -->

                                     <select class="form-control" name="school_year" required > 
                                          <?php  
                                              foreach ($school_years as $school_year) {
                                              ?>
                                                  <option <?php echo $student['school_year'] === $school_year['name'] ? 'selected':''; ?> value="<?php echo $school_year['name']; ?>"><?php echo $school_year['name']; ?></option>
                                              <?php
                                              }
                                          ?>
                                      </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2 ">
                                <div class="col-md-2 text-right mt-1"><small>First Name</small></div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="First Name" type="text" name="first_name" value="<?php echo $student['first_name'] ?>" required />
                                </div>
                                <div class="col-md-2 text-right mt-1"><small>Grade Level</small></div>
                                <div class="col-md-3">
                                    <select class="form-control" name="grade_level">
                                        <?php $grades = ['Grade 7', 'Grade 8',  'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12']; 
                                        foreach ($grades as $grade) {
                                        ?>
                                        <option <?php echo $grade == $student['grade_level'] ? 'selected': ''; ?>  value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2 ">
                                <div class="col-md-2 text-right mt-1"><small>Middle Name</small></div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="Middle Name" type="text" value="<?php echo $student['middle_name'] ?>" name="middle_name" required />
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
                                    <input class="form-control" placeholder="Last Name" type="text" value="<?php echo $student['last_name'] ?>" name="last_name" required />
                                </div>
                                <div class="col-md-2 text-right mt-1"><small>Birth Date</small></div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="Birth Date" type="date" value="<?php echo $student['birth_date'] ?>"" name="birth_date" required />
                                </div>
                            </div>
                             <div class="form-group row mb-2 ">
                                <div class="col-md-2 text-right mt-1"><small>Address</small></div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="Address" type="textarea" value="<?php echo $student['address'] ?>" name="address" required />
                                </div>
                                <div class="col-md-2 text-right mt-1"><small>Username</small></div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="Username" type="text" value="<?php echo $student['username'] ?>" name="username" required />
                                </div>
                            </div>
                             <div class="form-group row mb-2 ">
                                <div class="col-md-2 text-right mt-1"><small>Gender</small></div>
                                <div class="col-md-3">
                                    <select class="form-control" name="sex">
                                        <?php $grades = ['Male', 'Female']; 
                                        foreach ($grades as $grade) {
                                        ?>
                                        <option <?php echo $grade == $student['sex'] ? 'selected': ''; ?>  value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 text-right mt-1"><small>Password</small></div>
                                <div class="col-md-3">
                                    <input class="form-control" placeholder="Password" value="<?php echo $student['password'] ?>" type="password" name="password" required />
                                </div>
                            </div>



                            <div class="form-group row mb-2">
                                <div class="col-md-1 text-right mt-1"></div>
                                <div class="col-md-9">
                                    <button name="update-student" type="submit" class="btn btn-primary btn-user btn-block">Update Student</button>
                                </div>
                            </div>
                    </form>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
    </div>
	<!-- end add student-->
    </div>
<?php } ?>
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
<script type="text/javascript">
  window.onload = (e) => {
    $(document).ready(function(){
      $('#view-student-table').DataTable();
    });
  }
</script>