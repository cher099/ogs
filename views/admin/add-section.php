<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Add Section</p>
  </div>
  <div class="card-body row">
    <div class="col-md-6">
        <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        	<div class="form-group row">
        		<div class="col-4">
        				Section Name
        		</div>
        		<div class="col-8">
        			<input class="form-control" placeholder="Section Name" type="text" name="section" required>
        		</div>
        	</div>
          <div class="form-group row">
            <div class="col-4">
                Grade Level
            </div>
            <div class="col-8">
              <select class="form-control" name="level_id">
                <?php  foreach ($levels as $key => $level) { ?>
                    <option value="<?php echo $level['id']; ?>"><?php echo $level['name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        	<div class="form-group row">
        		<div class="col-4"></div>
        		<div class="col-8">
        				<button class="btn btn-sm btn-primary" type="submit" name="add-section">Add Section</button>
        		</div>
        	</div>
        </form>
    </div>
    <!-- end add section-->
    <div class="col-md-6"> 
        <table id="add-section-table" class="table-bordered table-sm m-auto col-md-12">
            <thead> 
                <tr> 
                    <th>ID #</th>
                    <th>Section</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
              <?php  foreach ($sections as $key => $section ) { ?>
                <tr> 
                    <td><?php  echo $section['id']; ?></td>
                    <td><?php  echo $section['name']; ?></td>
                    <td><?php  echo $section['level_name']; ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-modal-<?php echo $section['id']; ?>">Edit</button>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#delete-modal-<?php echo $section['id']; ?>">Delete</button>
                    </td>
                    <!-- modal for deleting -->
                    <div class="modal" id="delete-modal-<?php echo $section['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Delete Confirmation</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                            <div class="col-md-6 m-auto">
                                <a href="index.php?delete_section=<?php echo $section['id']; ?>" class="btn btn-block btn-danger">Do you want to delete?</a>
                                <button data-dismiss="modal" class="btn btn-block btn-secondary">Cancel</button>
                            </div>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- modal for editing -->
                    <div class="modal" id="edit-modal-<?php echo $section['id']; ?>">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Section</h5>
                            <button class="close" data-dismiss="modal">×</button>
                          </div>
                          <div class="modal-body">
                              <div class="col-md-8 m-auto">
                              <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <input type="hidden" name="id" value="<?php echo $section['id']; ?>">
                                <div class="form-group row">
                                  <div class="col-4">
                                      Section Name
                                  </div>
                                  <div class="col-8">
                                    <input class="form-control" placeholder="Section Name" type="text" name="section" value="<?php echo $section['name'] ?>" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-4">
                                      Grade Level
                                  </div>
                                  <div class="col-8">
                                    <select class="form-control" name="level_id">
                                      <?php  foreach ($levels as $key => $level) { ?>
                                          <option <?php echo $section['level_id'] === $level['id']? 'selected':''; ?> value="<?php echo $level['id']; ?>"><?php  echo $level['name']; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-4"></div>
                                  <div class="col-8">
                                      <button class="btn btn-sm btn-primary" type="submit" name="update-section">Update Section</button>
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
      $('#add-section-table').DataTable();
    });
  }
</script>