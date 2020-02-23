<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Add School Year</p>
  </div>
  <div class="card-body row">
    <div class="col-md-6">
        <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        	<div class="form-group row">
        		<div class="col-4">
        				School Year
        		</div>
        		<div class="col-8">
        			<input class="form-control" placeholder="School Year" type="text" name="school_year" required>
        		</div>
        	</div>
        	<div class="form-group row">
        		<div class="col-4"></div>
        		<div class="col-8">
        				<button class="btn btn-sm btn-primary" type="submit" name="add-school-year">Add School Year</button>
        		</div>
        	</div>
        </form>
    </div>
    <!-- end add section-->
    <div class="col-md-6"> 
        <table id="add-school-year-table" class="table-bordered col-md-12 table-sm m-auto">
            <thead> 
                <tr> 
                    <th>ID #</th>
                    <th>School Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
              <?php  foreach ($school_years as $school_year ) { ?>
                <tr> 
                    <td><?php  echo $school_year['id']; ?></td>
                    <td><?php  echo $school_year['name']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-<?php echo $school_year['id']; ?>">Edit</button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#delete-modal-<?php echo $school_year['id']; ?>">Delete</button>
                    </td>
                    <!-- modal for deleting -->
                    <div class="modal" id="delete-modal-<?php echo $school_year['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-6 m-auto">
                                <a href="index.php?delete_school_year=<?php echo $school_year['id']; ?>" class="btn btn-block btn-danger">Do you want to delete?</a>
                                <button data-dismiss="modal" class="btn btn-block btn-secondary">Cancel</button>
                            </div>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal for editing -->
                    <div class="modal" id="edit-modal-<?php echo $school_year['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit School Year</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                              <div class="col-md-8 m-auto">
                              <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $school_year['id']; ?>">
                                <div class="form-group row">
                                  <div class="col-4">
                                      Section Name
                                  </div>
                                  <div class="col-8">
                                    <input class="form-control" placeholder="School Year" type="text" name="school_year" value="<?php echo $school_year['name'] ?>" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-4"></div>
                                  <div class="col-8">
                                      <button class="btn btn-sm btn-primary" type="submit" name="update-school-year">Update School Year</button>
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
              <?php  } ?>
            </tbody>
        </table>
    </div>  
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
<script type="text/javascript">
  window.onload = (e) => {
    $(document).ready(function(){
      $('#add-school-year-table').DataTable();
    });
  }
</script>