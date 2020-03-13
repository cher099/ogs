<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Your Subjects</p>
  </div>
  <div class="card-body row">
    <div class="col-md-12 table-responsive">
        <div class="form-group row">
          <div class="col-10" style="float: right; margin-bottom: 5px;">
            <select class="form-control col-6" placeholder="School Year" id="school_year" style="display: inline-block; width: 49%;">
              <?php 
                foreach ($school_year as $school_year){ 
              ?>
              <option value="<?php echo $school_year['name']; ?>"><?php echo $school_year['name']; ?></option>
              <?php } ?>
            </select>
            <select class="form-control col-6" placeholder="Semester" id="semester" style="display: inline-block; width: 49%;">
              <?php 
                $semesters = ["First Semester", "Second Semester"];
                foreach ($semesters as $semester){ 
              ?>
              <option value="<?php echo $semester; ?>"><?php echo $semester; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-2" style="float: right; margin: 5px 0; text-align: center;">
            <button class="btn btn-sm btn-primary" type="submit" onclick="SeeGrade()" style="width: 100%;">Filter</button>
          </div>
        </div>
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
        <tbody id="grade-tbody">
        </tbody>
        <tbody id="grade-body-hide">
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
<script type="text/javascript">
    function SeeGrade() {
    var syear = document.getElementById("school_year").value;
    var sem = document.getElementById("semester").value;
    $.ajax({
      url: 'views/student/studentGradeList.php',
      method: 'GET',
      dataType: "json",
      data: {
        semester: sem,
        schoolYear: syear
      },
      success:function(data) {
        console.log(semester);
        console.log(school_year);
        console.log(data);
        $('#grade-tbody').html(
            '<tr>'+ 
            '<td>'+data.result.id+'</td>'+
            '<td>'+data.result.name+'</td>'+
            '<td>'+data.result.semester+'</td>'+
            '<td>'+data.result.first_quarter+'</td>'+
            '<td>'+data.result.second_quarter+'</td>'+
            '<td>'+data.result.semestral_grade+'</td>'+
            '<td>'+data.result.remark+'</td>'+
            '<td>'+data.result.track+'</td>'+
            '<td>'+data.result.school_year+'</td>'+
            '</tr>');
        $('#grade-body-hide').css( 'display', 'none');
      }
    });
  }
</script>