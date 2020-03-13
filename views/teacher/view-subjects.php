<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Your Subjects</p>
  </div>
  <div class="card-body row">
    <div class="col-md-12">
      <table id="table-view-subjects" class="table-bordered table-sm col-md-10 m-auto">
        <thead>
          <tr>
            <th>ID #</th>
            <th>Subject Name</th>
            <th>Semester</th>
            <th>Track</th>
            <th>School Year</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subjects as $key => $subject): ?>
          <tr>
            <td><?php echo $subject['id']; ?></td>
            <td><?php echo $subject['name']; ?></td>
            <td><?php echo $subject['semester']; ?></td>
            <td><?php echo $subject['track']; ?></td>
            <td><?php echo $subject['school_year']; ?></td>
            <td>
              <a class="btn btn-success btn-sm" href="<?php echo url("index.php?p=teachers&a=add-grade&subject_id={$subject['id']}&semester={$subject['semester']}") ?>">Add Grade</a>
            </td>
          </tr>
          <?php endforeach ?>
          
        </tbody>
      </table>
    </div>
    <!-- end add section-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->

<script type="text/javascript">
  window.onload = (e) => {
    $(document).ready(function(){
      $('#table-view-subjects').DataTable();
    });
  }
</script>