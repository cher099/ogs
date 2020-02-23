<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">View Teacher</p>
  </div>
  <div class="card-body">
  <!--   <form method="GET">
        <input type="hidden" name="p" value="principals" />
        <input type="hidden" name="a" value="view-teacher" />
        <div class="row">
            <div class="col-md-4 ml-auto">
                <div class="input-group mb-3">
                <input type="text" placeholder="Search teacher's last name" name="query" aria-label="Search teacher's last name" aria-describedby="basic-addon2" class="form-control" /> 
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary">
                            <li class="fas fa-search"></li>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form> -->
<?php if (count($teachers) == 0) { ?>
    <div class="col-md-6 m-auto text-center">
        <p class="lead">No teachers found.</p>
    </div>
<?php } else { ?>
    <div class="col-md-12 table-responsive">
        <table id="view-teacher-table" class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID #</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Section</th>
                    <th>Username</th>
                    <th>Grade Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $key => $teacher) { ?>
                <tr>
                    <td><?php echo $teacher['id']; ?></td>
                    <td><?php echo $teacher['first_name']; ?></td>
                    <td><?php echo $teacher['middle_name']; ?></td>
                    <td><?php echo $teacher['last_name']; ?></td>
                    <td><?php echo $teacher['section_name']; ?></td>
                    <td><?php echo $teacher['username']; ?></td>
                    <td><?php echo $teacher['level_name']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-<?php echo $teacher['id']; ?>">Edit</button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#delete-modal-<?php echo $teacher['id']; ?>">Delete</button>
                    </td>
                    <!-- modal for deleting -->
                    <div class="modal" id="delete-modal-<?php echo $teacher['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-6 m-auto">
                                <a href="index.php?delete_teacher=<?php echo $teacher['id']; ?>" class="btn btn-block btn-danger">Do you want to delete?</a>
                                <button data-dismiss="modal" class="btn btn-block btn-secondary">Cancel</button>
                            </div>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal for editing -->
                    <div class="modal" id="edit-modal-<?php echo $teacher['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Student</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                           <div class="col-md-8 m-auto">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                              <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>Level</small>
                                </div>
                                <div class="col-10">
                                  <select class="form-control" name="level_id">
                                    <option disabled value="">Please choose one...</option>
                                    <?php foreach($levels as $level) { ?>
                                    <option <?php echo $teacher['level_id'] == $level['id'] ? 'selected': ''; ?> value="<?php echo $level['id']; ?>"><?php echo $level['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>First Name</small>
                                </div>
                                <div class="col-10">
                                  <input class="form-control" type="text" value="<?php echo $teacher['first_name']; ?>" name="first_name" placeholder="First Name" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>Middle Name</small>
                                </div>
                                <div class="col-10">
                                  <input class="form-control" type="text" value="<?php echo $teacher['middle_name']; ?>" name="middle_name" placeholder="Middle Name" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>Last Name</small>
                                </div>
                                <div class="col-10">
                                  <input class="form-control" type="text" value="<?php echo $teacher['last_name']; ?>" name="last_name" placeholder="Last Name" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>Advisory</small>
                                </div>
                                <div class="col-10">
                                  <select class="form-control" name="section">
                                   <?php foreach ($sections as $key => $section) { ?>
                                        <option value="<?php echo $section['id']; ?>" <?php echo $teacher['section'] == $section['id'] ? 'selected':''; ?>><?php echo $section['name']; ?></option>
                                   <?php } ?>
                                </select>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>Username</small>
                                </div>
                                <div class="col-10">
                                  <input class="form-control" type="text" value="<?php echo $teacher['username']; ?>" name="username" placeholder="Username" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1">
                                  <small>Password</small>
                                </div>
                                <div class="col-10">
                                  <input class="form-control" type="password" value="<?php echo $teacher['password']; ?>" name="password" placeholder="Password" required />
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-2 text-right pt-1"></div>
                                <div class="col-10">
                                  <button name="update-teacher" type="submit" class="btn btn-primary btn-sm btn-block">Update Teacher</button>
                                </div>
                              </div>
                            </form>
                          </div>
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
      $('#view-teacher-table').DataTable();
    });
  }
</script>