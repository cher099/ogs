<div class="col-md-6 m-auto">
    <div class="card border-secondary mt-3">
  <div class="card-header">
    <p class="lead m-0">Change Password</p>
  </div>
  <div class="card-body">
    <div class="col-md-12">
        <form class="col-md-12" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group row">
                <div class="col-4">
                        Current Password
                </div>
                <div class="col-8">
                    <input class="form-control" placeholder="Current Password" type="password" name="current_password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                        New Password
                </div>
                <div class="col-8">
                    <input class="form-control" placeholder="New Password" type="password" name="new_password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                        Confirm Password
                </div>
                <div class="col-8">
                    <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4"></div>
                <div class="col-8">
                        <button class="btn btn-sm btn-primary" type="submit" name="reset-password">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
    <!-- end add student-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
</div>