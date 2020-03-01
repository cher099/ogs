<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Add Subject</p>
  </div>
  <div class="card-body row">
    <div class="col-md-12">
        <form class="col-md-6 m-auto" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="form-group row">
            <div class="col-4">
                Level
            </div>
            <div class="col-8">
              <select class="form-control" name="level_id">
                <?php  foreach ($levels as $key => $level) { ?>
                    <option value="<?php echo $level['id']; ?>"><?php  echo $level['name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
                Subject
            </div>
            <div class="col-8">
              <input class="form-control" placeholder="Subject" type="text" name="subject" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
                Semester
            </div>
            <div class="col-8">
              <select class="form-control" placeholder="Semester" name="semester" required>
                <?php 
                $semesters = ["First Semester", "Second Semester"];
                foreach ($semesters as $semester){ 
              ?>
                <option value="<?php echo $semester; ?>"><?php echo $semester; ?></option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
                Track
            </div>
            <div class="col-8">
              <select class="form-control" placeholder="Track" name="track" required>
                <?php 
                $tracks = ["Core Subjects (All Tracks)", "Academic Track (Except Immersion)", "Work Immersion / Culminating Activity for (Academic Work)", "TVL/Sports/Arts and Design Track"];

                foreach ($tracks as $track){ 
              ?>
                <option value="<?php echo $track; ?>"><?php echo $track; ?></option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-4">
                School Year
            </div>
            <div class="col-8">
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
        	<div class="form-group row">
        		<div class="col-4"></div>
        		<div class="col-8">
        				<button class="btn btn-sm btn-primary" type="submit" name="add-subject">Add Subject</button>
        		</div>
        	</div>
        </form>
    </div>
    <!-- end add section-->
    <div class="col-md-12"> 
        <table id="add-subject-load-table" class="table-bordered table-sm col-md-12">
            <thead> 
                <tr> 
                    <th>ID #</th>
                    <th>Subject Name</th>
                    <th>Level</th>
                    <th>Semester</th>
                    <th>Track</th>
                    <th>School Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
              <?php  foreach ($subjects as $key => $subject ) { ?>
                <tr> 
                    <td><?php  echo $subject['id']; ?></td>
                    <td><?php  echo $subject['name']; ?></td>
                    <td><?php  echo $subject['level_name']; ?></td>
                    <td><?php  echo $subject['semester']; ?></td>
                    <td><?php  echo $subject['track']; ?></td>
                    <td><?php  echo $subject['school_year']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-<?php echo $subject['id']; ?>">Edit</button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#delete-modal-<?php echo $subject['id']; ?>">Delete</button>
                    </td>
                    <!-- modal for deleting -->
                    <div class="modal" id="delete-modal-<?php echo $subject['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-6 m-auto">
                                <a href="index.php?delete_subject=<?php echo $subject['id']; ?>" class="btn btn-block btn-danger">Do you want to delete?</a>
                                <button data-dismiss="modal" class="btn btn-block btn-secondary">Cancel</button>
                            </div>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal for editing -->
                    <div class="modal" id="edit-modal-<?php echo $subject['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Subject</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                              <div class="col-md-8 m-auto">
                                      <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $subject['id']; ?>">
                                        <div class="form-group row">
                                          <div class="col-4">
                                              Level
                                          </div>
                                          <div class="col-8">
                                            <select class="form-control" name="level_id">
                                              <?php  foreach ($levels as $key => $level) { ?>
                                                  <option <?php echo $level === $subject['level_id']? 'selected': ''; ?> value="<?php echo $level['id']; ?>"><?php  echo $level['name']; ?></option>
                                              <?php } ?>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-4">
                                              Subject Name
                                          </div>
                                          <div class="col-8">
                                            <input class="form-control" placeholder="Subject Name" type="text" name="subject" value="<?php echo $subject['name']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-4">
                                              Semester
                                          </div>
                                          <div class="col-8">
                                            <input class="form-control" placeholder="Semester" type="text" name="semester" value="<?php echo $subject['semester']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-4">
                                              Track
                                          </div>
                                          <div class="col-8">
                                            <input class="form-control" placeholder="Track" type="text" name="track" value="<?php echo $subject['track']; ?>" required>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-4">
                                              School Year
                                          </div>
                                          <div class="col-8">
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
                                        <div class="form-group row">
                                          <div class="col-4"></div>
                                          <div class="col-8">
                                              <button class="btn btn-sm btn-primary" type="submit" name="update-subject">Update Subject</button>
                                          </div>
                                        </div>
                                      </form>

                              </div><!-- end of col-md-8 -->
                              <hr>
                              <div class="col-md-12">
                                  <h5 class="modal-title text-center mb-2">Add Teachers for the Subject</h5>
                                  <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="form-group row">
                                      <div class="col-2 mt-1">Teacher Name</div>
                                      <input type="hidden" name="subject_id" value="<?php echo $subject['id']; ?>">
                                      <div class="col-8">
                                        <select class="form-control" name="teacher_id">
                                          <?php foreach ($teachers as $key => $teacher): ?>
                                            <option value="<?php echo $teacher['id']; ?>"><?php echo $teacher['last_name'].", ".$teacher['first_name']." ".$teacher['middle_name']; ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                      <div class="col-2 mt-1">
                                        <button name="add-subject-teacher" class="btn btn-primary btn-sm btn-block">Add</button>
                                      </div>
                                    </div>
                                  </form>
                                  <hr>
                                  <div class="col-md-12">
                                    <ul class="list-group mb-5">
                                    <?php
                                    $teachers1 = DB::select("SELECT teachers.first_name, teachers.last_name, teachers.middle_name, subject_teachers.teacher_id, subject_teachers.id as subject_teacher_id FROM subject_teachers LEFT JOIN teachers ON subject_teachers.teacher_id=teachers.id WHERE subject_teachers.subject_id={$subject['id']}");

                                      foreach ($teachers1 as $key => $teacher) {
                                    ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center"><?php echo $teacher['last_name'].", ".$teacher['first_name']." ".$teacher['middle_name']; ?>
                                          <div class="btn-group">
                                              <a href="index.php?delete_subject_teacher=<?php echo $teacher['subject_teacher_id']; ?>" class="btn btn-danger btn-sm" type="button"><i class="fas fa-window-close"></i></a>
                                          </div>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                  </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </tr>
              <?php  } ?>
            </tbody>
        </table>
    </div>  
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
<script type="text/javascript">
  window.onload = (e) => {
    $(document).ready(function(){
      $('#add-subject-load-table').DataTable();
    });
  }
</script>