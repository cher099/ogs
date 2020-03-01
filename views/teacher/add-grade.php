<?php 
	$subject_id = $subject['id'];
	$section_id = $_SESSION['user']['section'];
	$teacher_id = $_SESSION['user']['id'];

	$servername = "localhost";
	$username = "root";
	$password = "Mk396sfAUzgU";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=ogs", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $conn->prepare("SELECT * from students");
		$getGrade = $conn->prepare("Select g.*, s.*, si.* from grades as g join students s on g.student_id = s.id join subjects as si on g.subject_id = si.id Where g.subject_id = $subject_id");
		$stmt->execute();
		$getGrade->execute();

		$students = $stmt->fetchAll();
		$studentGrades = $getGrade->fetchAll();

		}
	catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();
		}
	
?>
<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Add Grade for <?php echo $subject['name']; ?></p>
  </div>
  <div class="card-body row">
    <div class="col-md-12 table-responsive">
	<div class="row">
	            <div class="col-md-6 m-auto">
	                <div class="input-group mb-3">
	                <select name="" id="student_list" class="form-control">
						<?php foreach($students as $student){?>
							<option value="<?php echo $student['id']?>"><?php echo $student['first_name']." ".$student['middle_name']." ".$student['last_name']?></option>
						<?php }?>
					</select>
	                    <div class="input-group-append">
	                        <button type="submit" class="btn btn-outline-primary" onclick="AddGrade()">
	                            <li class="fas fa-plus"></li>
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
      <table id="add-grade-table" class="table-bordered table-sm">
        <thead>
          <tr>
            <th>ID #</th>
            <th>Student Name</th>
            <th>Semester</th>
            <th>School Year</th>
            <th>First/Third Quarter</th>
            <th>Second/Fourth Quarter</th>
            <th>Semestral Grade</th>
            <th>Remarks</th>
          </tr>
        </thead>
        <tbody id="grade-tbody">
        </tbody>
        <tbody>
        	<div>
        		<?php foreach($studentGrades as $stud){?>
        			<tr>
        			  <td><?php echo $stud['id_number']?></td>
        			  <td><?php echo $stud['first_name'].' '.$stud['middle_name'].' '.$stud['last_name']?></td>
        			  <td><?php echo $stud['semester']?></td>
        			  <td><?php echo $stud['school_year']?></td>
        			  <td><?php echo $stud['first_quarter']?></td>
        			  <td><?php echo $stud['second_quarter']?></td>
        			  <td><?php echo $stud['semestral_grade']?></td>
        			  <td><?php echo $stud['remark']?></td>
        			</tr>
        		<?php }?>
        	</div>
        </tbody>
      </table>
      <button class="btn btn-primary" onClick="generateGrades()">Generate All Grades</button>
      <button onClick="submitGrades()" class="btn btn-primary btn-warning mt-1">Submit Grades</button>
      <hr>
     <div class="col-md-12">
     	 <form onSubmit="submitQuery(event)" id="form1">
	        <input type="hidden" name="p" value="teachers" />
	        <input type="hidden" name="a" value="add-grade" />
	        <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subject['id']; ?>" />
	        <input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>" />
	        <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $teacher_id; ?>" />
	        
	    </form>
	    <hr>
	   <div class="col-md-6 m-auto">
	   	 <ul id="student-list" class="list-group mb-5">
        </ul>
	   </div>
     </div>
    </div>
    <!-- end add section-->
  </div>
</div><!-- end .card.border-secondary.mt-3 -->
<script type="text/javascript">

	function AddGrade() {

		var input = document.getElementById("student_list").value;
		var subjectIdQuery = document.getElementById('subject_id').value;
		$.ajax({
			url: 'views/teacher/studentList.php',
			method: 'GET',
			dataType: "json",
			data: {
				id: input,
				subjectId: subjectIdQuery
			},
			success:function(data) {
				console.log(data);
				$('#grade-tbody').append('<tr><td>'+data.result.id_number+'<input type=hidden name="studentId[]" value="'+data.result.id+'"></td><td>'+data.result.first_name+' '+data.result.middle_name+' '+data.result.last_name+' '+'</td><td>'+data.data.semester+'</td><td>'+data.data.school_year+'</td><td><input type="text" name="first[]" class="form-control"></td><td><input type="text" id="second[]" name="second[]" class="form-control"></td><td><input type="text" name="semGrade[]" class="form-control" disabled></td><td><input type="text" name="remarks[]" class="form-control" disabled></td></tr>');
			}
		});
	}

	function generateGrades() {
		var first = document.getElementsByName('first[]');
		var second = document.getElementsByName('second[]');
		var semGrade = document.getElementsByName('semGrade[]');
		var remarks = document.getElementsByName('remarks[]');
		
			for (var i = 0; i<first.length; i++){

				if(first[i].value!= '' && second[i].value != ''){
						var inp = (parseInt(first[i].value)+parseInt(second[i].value))/2;

						if (inp <75) {
							remarks[i].value = "FAILED";
						}
						else{
							remarks[i].value = "PASSED";
						}
						semGrade[i].value = inp;
				}
			}
	}
	function submitQuery(event) {
		event.preventDefault();
		var q = $('#q').val();

		$.ajax({
			url: `<?php echo url("sys/api.php?a=search-student&q=") ?>${q}`,
			method: "GET",
			success: (data) => {
				console.log((data));
				data = JSON.parse(data);
				var list = '';

				data.forEach(e => {
					list += `
					<li class="list-group-item d-flex justify-content-between align-items-center">${e.last_name}, ${e.first_name} ${e.middle_name}
				        <button onClick="addStudent(${e.id})" class="btn btn-primary btn-sm" type="button">Add Student</button>
					</li>
					`;
				});

				$('#student-list').html(list);
			}
		})
		
	}

	function renderData(){
		$.ajax({
			url: "<?php echo url("sys/api.php?a=show-grade&subject_id=$subject_id&section_id=$section_id&teacher_id=$teacher_id"); ?>",
			method: "GET",
			success: (data) => {
				console.log((data));
				data = JSON.parse(data);

				var list = '';

				data.forEach(e => {
					list += `
						<tr>
							<td>${e.student_id}</td>
							<td>${e.last_name}, ${e.first_name} ${e.middle_name}</td>
							<td>${e.semester}</td>
							<td>${e.school_year}</td>
							<td>
								<input type="text" value="${e.first_quarter  == null ? '' : e.first_quarter}" placeholder="First Quarter" class="form-control" id="first_quarter-${e.id}" ${isNaN(parseFloat(e.first_quarter)) ? '' : 'readonly' } />
							</td>
							<td>
								<input type="text" value="${e.second_quarter == null ? '' : e.second_quarter }" placeholder="Second Quarter" class="form-control" id="second_quarter-${e.id}" ${isNaN(parseFloat(e.second_quarter))? '' : 'readonly' } />
							</td>
							<td>
								<input type="text" value="${e.semestral_grade == null ? '' : e.semestral_grade }" placeholder="Semestral Grade" class="form-control" id="semestral_grade-${e.id}" readonly />
							</td>
							<td>
								<input type="text" value="${e.remark == null ? '' : e.remark }" placeholder="Remark" class="form-control" id="remark-${e.id}" readonly  />
							</td>
						</tr>
					`;
				});
				window.__grade_table_storage = {
					grade: data	
				};

				$('#grade-tbody').html(list);
				$(document).ready(function(){
					$('#add-grade-table').DataTable();
				});
			}
		})
	}

	function addStudent(student_id){

		$.ajax({
			url: `<?php echo url("sys/api.php?a=add-grade-table"); ?>&teacher_id=${$('#teacher_id').val()}&subject_id=${$('#subject_id').val()}&section_id=${$('#section_id').val()}&student_id=${student_id}`,
			method: "GET",
			success: (data) => {
				console.log(data);
				data = JSON.parse(data);
				if (data.code == 1){
					$('#student-list').html('');
				} else {
					alert("Error : " . data.message);
				}
				window.renderData();
			}

		});
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
			});
		}
	}

	function submitGrades(){
		if(confirm("Save All Data")){
			var ins = document.getElementsByName('first[]');
			var inp = document.getElementsByName('second[]');
			var semGrade = document.getElementsByName('semGrade[]');
			var remarks = document.getElementsByName('remarks[]');
			var studentId = document.getElementsByName('studentId[]');
			var subject_id = document.getElementById('subject_id').value;
			var section_id = document.getElementById('section_id').value;
			var teacher_id = document.getElementById('teacher_id').value;
			var firstGrade = [];
			var secondGrade = [];
			var semeGrade = [];
			var gradeRemarks = [];
			var student = [];

			if (remarks[0].value == ''){
				alert('Please Generate All Grades');
			} else {

			for (var i = 0; i<ins.length; i++){
				var first = ins[i];
				firstGrade.push(first.value);
				var second = inp[i];
				secondGrade.push(second.value);
				var third = semGrade[i];
				semeGrade.push(third.value);
				var four = remarks[i];
				gradeRemarks.push(four.value);
				var five = studentId[i];
				student.push(five.value);
			}

			$.ajax({
				url: 'views/teacher/saveGrade.php',
				method: 'POST',
				dataType: "json",
				data: {
					firstGrade: firstGrade,
					secondGrade: secondGrade,
					semeGrade: semeGrade,
					gradeRemarks: gradeRemarks,
					student: student,
					subject_id: subject_id,
					section_id: section_id,
					teacher_id: teacher_id
				},
				success:function(data){

				}

			});
		}
	}
		// if (confirm("Are you sure?")){

		// 	var grades = window.__grade_table_storage.grade;

		// 	if (grades.length == 0){
		// 		alert("There are no student in the subject.");
		// 		return;
		// 	}

		// 	// fetch data
		// 	grades.map( grade => {
		// 		var first_quarter =$(`#first_quarter-${grade.id}`).val();
		// 		var second_quarter = $(`#second_quarter-${grade.id}`).val();

		// 		var g1 = parseFloat(first_quarter), g2 = parseFloat(second_quarter);


		// 		var semestral_grade =( (g1 + g2) / 2 ).toFixed(0);

		// 		var remark;

		// 		if (!isNaN(g1) && !isNaN(g2) && !isNaN(semestral_grade)){
		// 			if (semestral_grade > 1 && semestral_grade < 75) remark = "FAILED";
		// 			else if (semestral_grade <= 100 && semestral_grade > 74) remark = "PASSED";
		// 			else remark = null;
		// 		} else {
		// 			first_quarter = null;
		// 			second_quarter = null;
		// 			semestral_grade = null;
		// 			remark = null;
		// 		}

		// 		//console.log("GRADE : ", {first_quarter,second_quarter,semestral_grade,remark});

		// 		grade.first_quarter = first_quarter;
		// 		grade.second_quarter = second_quarter;
		// 		grade.semestral_grade = semestral_grade;
		// 		grade.remark = remark;

		// 		return grade;
		// 	});
		// 	console.log("GRADES", grades);

		// 	$.ajax({
		// 		url: `<?php echo url("sys/api.php?a=save-student-grade"); ?>`,
		// 		method: 'POST',
		// 		data: { data: JSON.stringify(grades) },
		// 		success: (data) => {
		// 			console.log(data);
		// 			window.renderData();
		// 		}

		// 	});
		// }
	}

	window.onload = (e) => {
		window.renderData();
	}


</script>