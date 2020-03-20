<?php

	$servername = "localhost";
	$username = "root";
	$password = "";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=ogs", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * from students");
    if(isset($_GET['getTeacherId'])==false){
		$getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id");
    }
    if(isset($_GET['getSubjectId'])) {
    $subjectId = $_GET['getSubjectId'];
		$getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.subject_id =".$subjectId."");
    }
    if(isset($_GET['getTeacherId'])){
      $teacher_id = $_GET['getTeacherId'];
		$getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.teacher_id = ".$teacher_id."");
    }
    if(isset($_GET['getSectionId'])) {
      $section_id = $_GET['getSectionId'];
		  $getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.section_id = ".$section_id."");
    }
    if(isset($_GET['getTeacherId']) && isset($_GET['getSubjectId'])) {
      $teacher_id = $_GET['getTeacherId'];
      $subject_id = $_GET['getSubjectId'];
		  $getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.teacher_id = ".$teacher_id." and g.subject_id = ".$subject_id."");
     }
     if(isset($_GET['getTeacherId']) && isset($_GET['getSectionId'])) {
      $teacher_id = $_GET['getTeacherId'];
      $section_id = $_GET['getSectionId'];
		  $getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.teacher_id = ".$teacher_id." and g.section_id = ".$section_id."");
     }
     if(isset($_GET['getSubjectId']) && isset($_GET['getSectionId'])){
      $subject_id = $_GET['getSubjectId'];
      $section_id = $_GET['getSectionId'];
		  $getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.subject_id = ".$subject_id." and g.section_id = ".$section_id."");
     }
     if(isset($_GET['getSubjectId']) && isset($_GET['getSectionId']) && isset($_GET['getTeacherId'])){
      $subject_id = $_GET['getSubjectId'];
      $section_id = $_GET['getSectionId'];
      $teacher_id = $_GET['getTeacherId'];
		  $getGrade = $conn->prepare("Select g.*,g.id as grade_id, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id where g.subject_id = ".$subject_id." and g.section_id = ".$section_id." and g.teacher_id=".$teacher_id."");
     }
    $getGradeLevel = $conn->prepare("Select * from levels");

    $getGradeLevel->execute();
		$stmt->execute();
		$getGrade->execute();

		$students = $stmt->fetchAll();
    $studentGrades = $getGrade->fetchAll();
    $fetchGradeLevel = $getGradeLevel->fetchAll();


		}
	catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();
		}
	
?>
<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Edit Grade</p>
  </div>
  <div class="card-body row">
    <div class="col-md-12 row">
      <div class="col-md-1">
       <p class="lead mt-1">Subject :</p>
      </div>
      <div class="col-md-2">
        <select id="subject_id" class="form-control">
          <option value="0"></option>
        <?php $sub = !empty($_GET['getSubjectId']) ? $_GET['getSubjectId']: '';?>
          <?php foreach ($subjects as $subject): ?>
             <option value="<?php echo $subject['id']; ?>" <?php echo $sub == $subject['id'] ? 'selected' : '';?> ><?php echo" {$subject['name']} - {$subject['track']}"; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-md-1">
       <p class="lead mt-1">Teacher :</p>
      </div>
      <div class="col-md-3">
        <select id="teacher_id" class="form-control">
        <option value="0"></option>
        <?php $teach = !empty($_GET['getTeacherId']) ? $_GET['getTeacherId']: '';?>
          <?php foreach ($teachers as $teacher): ?>
             <option value="<?php echo $teacher['id']; ?>" <?php echo $teach == $teacher['id'] ? 'selected' : '';?> ><?php echo" {$teacher['last_name']}, {$teacher['first_name']} {$teacher['middle_name']}"; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-md-1">
       <p class="lead mt-1">Section :</p>
      </div>
      <div class="col-md-2">
        <select id="section_id" class="form-control">
        <option value="0"></option>
        <?php $sec = !empty($_GET['getSectionId']) ? $_GET['getSectionId']: '';?>
          <?php foreach ($sections as $section): ?>
             <option value="<?php echo $section['id']; ?>" <?php echo $sec == $section['id'] ? 'selected' : '';?> ><?php echo" {$section['name']}"; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <!-- <div class="col-md-1">
       <p class="lead mt-1">Grade Level :</p>
      </div>
      <div class="col-md-2">
        <select id="level_id" class="form-control">
        <option value="0"></option>
          <?php foreach ($fetchGradeLevel as $gradeLevel){ ?>
             <option value="<?php echo $gradeLevel['id']; ?>"><?php echo $gradeLevel['name']?></option>
          <?php } ?>
        </select>
      </div> -->
      <div class="col-md-1">
       <button id="search-btn" class="btn btn-outline-primary ">Search</button>
      </div>
    </div><!-- end of search fields -->
    <div class="col-md-12 table-responsive">
      <table class="table table-bordered table-sm col-md-12">
        <thead>
           <tr>
            <th>ID #</th>
            <th>Student Name</th>
            <th>Semester</th>
            <th>First Quarter</th>
            <th>Second Quarter</th>
            <th>Semestral Grade</th>
            <th>Remarks</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="grade-tbody"></tbody>
        <tbody>
        	<div>
        		<?php foreach($studentGrades as $stud){?>
        			<tr>
        			  <td><?php echo $stud['id_number']?></td>
        			  <td><?php echo $stud['first_name'].' '.$stud['middle_name'].' '.$stud['last_name']?></td>
                <td><?php echo $stud['semester']?></td>
        			  <td><?php echo $stud['first_quarter']?></td>
        			  <td><?php echo $stud['second_quarter']?></td>
                <td><?php echo $stud['semestral_grade']?></td>
        			  <td><?php echo $stud['remark']?></td>
                <td><a href="index.php?p=principals&a=edit-grade&studentId=<?php echo $stud['student_id'];?>&gradeId=<?php echo $stud['grade_id']?>" class="btn btn-primary">EDIT</a> | <input type="button" class="btn btn-danger" id="deleteGrade" onclick="deleteGrade(<?php echo $stud['grade_id']?>)" value="DELETE"> </td>
        			</tr>
        		<?php }?>
        	</div>
        </tbody>
      </table>
      <div id="submit-panel">
        <button onClick="submitGrades()" class="btn btn-primary btn-warning mt-1">Update Grades</button>
      </div>
    </div>
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
<script type="text/javascript">
function deleteGrade(id) {
  var r = confirm('Are You Sure You Want to Delete?');
  var id = id;
  if(r == true) {
    $.ajax({
        url: 'views/admin/deleteGrade.php',
        method: 'POST',
        data: {
          id: id
        },
        success:function(data){
          alert('Grade Deleted Successfully');
          location.reload();
        }

      });
  } else {

  }
}

  function renderData() {
    teacher_id = $('#teacher_id').val();
    subject_id = $('#subject_id').val();
    section_id = $('#section_id').val();

    $.ajax({
      url: `<?php echo url("sys/api.php?a=principal-show-grade") ?>&teacher_id=${teacher_id}&subject_id=${subject_id}&section_id=${section_id}`,
      method: "GET",
      success: (data) => {
        console.log(data);
        data = JSON.parse(data);

        var list = '';

        data.forEach(e => {
          list += `
            <tr>
              <td>${e.student_id}</td>
              <td>${e.last_name}, ${e.first_name} ${e.middle_name}</td>
              <td>
                <input type="text" value="${e.first_quarter  == null ? '' : e.first_quarter}" placeholder="First Quarter" class="form-control" id="first_quarter-${e.id}" />
              </td>
              <td>
                <input type="text" value="${e.second_quarter == null ? '' : e.second_quarter }" placeholder="Second Quarter" class="form-control" id="second_quarter-${e.id}" />
              </td>
              <td>
                <input type="text" value="${e.semestral_grade == null ? '' : e.semestral_grade }" placeholder="Semestral Grade" class="form-control" id="semestral_grade-${e.id}" />
              </td>
              <td>
                <input type="text" value="${e.remark == null ? '' : e.remark }" placeholder="Semestral Grade" class="form-control" id="remark-${e.id}"  />
              </td>
              <td>
                <button class="btn btn-sm btn-danger" onClick="removeStudentGrade(${e.id})">Remove</button>
              </td>
            </tr>
          `;
        });
        window.__grade_table_storage = {
          grade: data 
        };

        $('#grade-tbody').html(list);
    
        window.checkGradesContent();
      }
    });
  }

  document.getElementById('search-btn').onclick = (e) => {
    teacher_id = $('#teacher_id').val();
    subject_id = $('#subject_id').val();
    section_id = $('#section_id').val();
    // level_id = $('#level_id').val();
    var currentLocation = window.location;
    if(teacher_id != 0 ) {
      window.location.href="index.php?p=principals&a=add-grade&getTeacherId="+teacher_id;
    }
    if(subject_id != 0) {
      window.location.href="index.php?p=principals&a=add-grade&getSubjectId="+subject_id;

    }
    if(section_id != 0) {
      window.location.href="index.php?p=principals&a=add-grade&getSectionId="+section_id;
    }
    if(teacher_id != 0 && subject_id != 0) {
      window.location.href="index.php?p=principals&a=add-grade&getTeacherId="+teacher_id+"&getSubjectId="+subject_id;
    }
    if(teacher_id != 0 && section_id != 0) {
      window.location.href="index.php?p=principals&a=add-grade&getTeacherId="+teacher_id+"&getSectionId="+section_id;
    }
    if(subject_id != 0 && section_id != 0) {
      window.location.href="index.php?p=principals&a=add-grade&getSubjectId="+subject_id+"&getSectionId="+section_id;
    }
    if(subject_id != 0 && section_id != 0 && teacher_id != 0) {
      window.location.href="index.php?p=principals&a=add-grade&getSubjectId="+subject_id+"&getSectionId="+section_id+"&getTeacherId="+teacher_id;
    }
    if(teacher_id == 0 && subject_id == 0 && section_id == 0){
      window.location.href="index.php?p=principals&a=add-grade";

    }

    window.renderData();
  }


function removeStudentGrade(id){
    if (confirm("Do you to remove?")){
      $.ajax({
        url: `<?php echo url("sys/api.php?a=remove-student-grade"); ?>&grade_id=${id}`,
        method: 'GET',
        success: (data) => {
          console.log(data);

          window.renderData();

          if (data.code == 0) {
            alert("ERROR : " . JSON.parse(data).message);
          }
        }
      })
    }
  window.checkGradesContent();
}

window.onload = () => {
  window.__grade_table_storage = {
          grade: []
  };
  window.checkGradesContent();
}
function checkGradesContent(){
  if (window.__grade_table_storage.grade.length == 0){
    $('#submit-panel').hide();
  } else $('#submit-panel').show();
}

  function submitGrades(){
    if (confirm("Are you sure?")){

      var grades = window.__grade_table_storage.grade;

      if (grades.length == 0){
        alert("There are no student in the subject.");
        return;
      }

      // fetch data
      grades.map( grade => {
        var first_quarter = $(`#first_quarter-${grade.id}`).val();
        var second_quarter = $(`#second_quarter-${grade.id}`).val();
        var semestral_grade = $(`#semestral_grade-${grade.id}`).val();
        var remark = $(`#remark-${grade.id}`).val();

        //console.log("GRADE : ", {first_quarter,second_quarter,semestral_grade,remark});

        grade.first_quarter = first_quarter == null || first_quarter == 'null' ? null : first_quarter;
        grade.second_quarter = second_quarter == null || second_quarter == 'null' ? null : second_quarter;
        grade.semestral_grade = semestral_grade == null || semestral_grade == 'null' ? null : semestral_grade;
        grade.remark = remark == null || remark == 'null' ? null : remark;

        return grade;
      });

      $.ajax({
        url: `<?php echo url("sys/api.php?a=save-student-grade"); ?>`,
        method: 'POST',
        data: { 
          data: JSON.stringify(grades) 
        },
        success: (data) => {
          console.log(data);
          window.renderData();
        }

      })
    }
  }
</script>