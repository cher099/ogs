<div class="card border-secondary mt-3">
  <div class="card-header">
    <p class="lead m-0">Add Teacher</p>
  </div>
  <div class="card-body">
      <div class="col-md-8 mr-auto">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>Level</small>
            </div>
            <div class="col-10">
              <select class="form-control" name="level_id">
                <option disabled value="">Please choose one...</option>
                <?php foreach($levels as $level) { ?>
                <option value="<?php echo $level['id']; ?>"><?php echo $level['name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>First Name</small>
            </div>
            <div class="col-10">
              <input class="form-control" type="text" name="first_name" placeholder="First Name" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>Middle Name</small>
            </div>
            <div class="col-10">
              <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>Last Name</small>
            </div>
            <div class="col-10">
              <input class="form-control" type="text" name="last_name" placeholder="Last Name" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>Advisory</small>
            </div>
            <div class="col-10">
             <select class="form-control" name="section">
                 <?php foreach ($sections as $key => $section) { ?>
                      <option value="<?php echo $section['id']; ?>"><?php echo $section['name']; ?></option>
                 <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>Username</small>
            </div>
            <div class="col-10">
              <input class="form-control" type="text" name="username" placeholder="Username" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1">
              <small>Password</small>
            </div>
            <div class="col-10">
              <input class="form-control" type="password" name="password" placeholder="Password" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-2 text-right pt-1"></div>
            <div class="col-10">
              <button name="add-teacher" type="submit" class="btn btn-primary btn-sm btn-block">Submit</button>
            </div>
          </div>
        </form>
      </div>
  <!-- end add student-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->