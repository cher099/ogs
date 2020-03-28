<?php

  $servername = "localhost";
  $username = "root";
  $password = "Mk396sfAUzgU";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=ogs", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $user=$_SESSION['user']['id'];
    if(isset($_GET['getSchoolYear']) == false){
      $getGrade = $conn->prepare("select grades.*, subjects.name, subjects.track, subjects.school_year, subjects.semester from grades inner join subjects on grades.subject_id=subjects.id where grades.student_id=".$user."");
      $firstGrade = "First Quarter";
      $secondGrade = "Second Quarter";
    } elseif(isset($_GET['getSemester']) && isset($_GET['getSchoolYear'])) {
      $school_year = urldecode($_GET['getSchoolYear']);
      $semester = urldecode($_GET['getSemester']);
      $getGrade = $conn->prepare("select grades.*, subjects.name, subjects.semester, subjects.track, subjects.school_year from grades inner join subjects on grades.subject_id=subjects.id where grades.student_id=".$user." and subjects.semester='{$semester}' and subjects.school_year='{$school_year}'");
      if($semester == "First Semester") {
      $firstGrade = "First Quarter";
      $secondGrade = "Second Quarter";
      }
      else {
        $firstGrade = "Third Quarter";
        $secondGrade = "Fourth Quarter";
      }
    }
    $getSchoolYear = $conn->prepare("select * from school_year");
    $getGrade->execute();
    $getSchoolYear->execute();
    $studentGrades = $getGrade->fetchAll();
    $fetchSchoolYear = $getSchoolYear->fetchAll();
  }catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

?>
<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Your Subjects</p>
  </div>
  <div class="card-body row">
    <div class="col-md-12 table-responsive">
        <div class="form-group row">
          <div class="col-10" style="float: right; margin-bottom: 5px;">
            <div style="display: inline-block; width: 49%;">
              <label class="lead mt-1 col-4">School Year :</label>
              <select class="form-control col-8" placeholder="School Year" id="school_year" style="display: inline-block; width: 60%;">
                <?php 
                  foreach ($fetchSchoolYear as $school_year){ 
                ?>
                <option value="<?php echo $school_year['name']; ?>"><?php echo $school_year['name']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div style="display: inline-block; width: 49%;">
              <label class="lead mt-1 col-4">Semester :</label>
              <select class="form-control col-8" placeholder="Semester" id="semester" style="display: inline-block; width: 60%;">
                <?php 
                  $semesters = ["First Semester", "Second Semester"];
                  foreach ($semesters as $semester){ 
                ?>
                <option value="<?php echo $semester; ?>"><?php echo $semester; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-2" style="float: right; margin: 5px 0; text-align: center;">
            <button class="btn btn-sm btn-primary" type="submit" id="filter-btn" style="width: 100%;">Filter</button>
          </div>
        </div>
      <table class="table-bordered table-sm col-md-12">
        <thead class="text-center">
          <tr>
            <th>ID #</th>
            <th>Subject Name</th>
            <th>Semester</th>
            <th><?php echo $firstGrade;?></th>
            <th><?php echo $secondGrade;?></th>
            <th>Semestral Grade</th>
            <th>Remarks</th>
            <th>Track</th>
            <th>School Year</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($studentGrades as $stud){?>
            <tr>
              <td><?php echo $stud['id']?></td>
              <td><?php echo $stud['name']?></td>
              <td><?php echo $stud['semester']?></td>
              <td style="text-align: center;"><?php echo $stud['first_quarter']?></td>
              <td style="text-align: center;"><?php echo $stud['second_quarter']?></td>
              <td style="text-align: center;"><?php echo $stud['semestral_grade']?></td>
              <td><?php echo $stud['remark']?></td>
              <td><?php echo $stud['track']?></td>
              <td><?php echo $stud['school_year']?></td>
            </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <!-- end add section-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
<script type="text/javascript">
  document.getElementById('filter-btn').onclick = (e) => {
    school_year = $('#school_year').val();
    semester = $('#semester').val();
    var currentLocation = window.location;
    if(school_year != 0 && semester != 0) {
      window.location.href="index.php?p=students&a=view-subjects&getSemester="+semester+"&getSchoolYear="+school_year;
    }
    if(school_year == 0 && semester == 0){
      window.location.href="index.php?p=students&a=view-subjects";
    }
    window.renderData();
  }
</script>