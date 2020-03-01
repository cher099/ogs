<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Your Subjects</p>
  </div>
  <div class="card-body row">
    <div class="col-md-12 table-responsive">
      <form class="col-md-6" style="float: right;">
        <div class="form-group row">
          <div class="col-10" style="float: right; margin-bottom: 5px;">
            <select class="form-control col-6" placeholder="Semester" name="semester" style="display: inline-block; width: auto;">
              <?php 
                foreach ($subjects as $subject){ 
              ?>
              <option value="<?php echo $subject['school_year']; ?>"><?php echo $subject['school_year']; ?></option>
              <?php } ?>
            </select>
            <select class="form-control col-6" placeholder="Semester" name="semester" style="display: inline-block; width: auto;">
              <?php 
                $semesters = ["First Semester", "Second Semester"];
                foreach ($semesters as $semester){ 
              ?>
              <option value="<?php echo $semester; ?>"><?php echo $semester; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-2" style="float: right; margin-bottom: 5px; text-align: center;">
            <button class="btn btn-sm btn-primary" type="submit">Filter</button>
          </div>
        </div>
      </form>
      <table class="table-bordered table-sm col-md-12">
        <thead class="text-center">
          <tr>
            <th>ID #</th>
            <th>Subject Name</th>
            <th>Semester</th>
            <th>First Quarter</th>
            <th>Second Quarter</th>
            <th>Semestral Grade</th>
            <th>Remarks</th>
            <th>Track</th>
            <th>School Year</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subjects as $subjects): ?>
            <tr>
              <td><?php echo $subjects['id']; ?></td>
              <td><?php echo $subjects['name']; ?></td>
              <td><?php echo $subjects['semester']; ?></td>
              <td><?php echo $subjects['first_quarter']; ?></td>
              <td><?php echo $subjects['second_quarter']; ?></td>
              <td><?php echo $subjects['semestral_grade']; ?></td>
              <td><?php echo $subjects['remark']; ?></td>
              <td><?php echo $subjects['track']; ?></td>
              <td><?php echo $subjects['school_year']; ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <!-- end add section-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->