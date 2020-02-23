<?php 
	$subject_id = $subject['id'];
	$section_id = $_SESSION['user']['section'];
	$teacher_id = $_SESSION['user']['id'];
	
?>
<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Add Grade for <?php echo $subject['name']; ?></p>
  </div>
  <div class="card-body row">
    <div class="col-md-12 table-responsive">
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
      </table>
      <button onClick="submitGrades()" class="btn btn-primary btn-warning mt-1">Submit Grades</button>
      <hr>
     <div class="col-md-12">
     	 <form onSubmit="submitQuery(event)" id="form1">
	        <input type="hidden" name="p" value="teachers" />
	        <input type="hidden" name="a" value="add-grade" />
	        <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subject['id']; ?>" />
	        <input type="hidden" name="section_id" id="section_id" value="<?php echo $section_id; ?>" />
	        <input type="hidden" name="teacher_id" id="teacher_id" value="<?php echo $teacher_id; ?>" />
	        <div class="row">
	            <div class="col-md-6 m-auto">
	                <div class="input-group mb-3">
	                <input id="q" type="text" placeholder="Search student's last name" name="query" aria-label="Search teacher's last name" aria-describedby="basic-addon2" class="form-control" /> 
	                    <div class="input-group-append">
	                        <button type="submit" class="btn btn-outline-primary">
	                            <li class="fas fa-search"></li>
	                        </button>
	                    </div>
	                </div>
	            </div>
	        </div>
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
		if (confirm("Are you sure?")){

			var grades = window.__grade_table_storage.grade;

			if (grades.length == 0){
				alert("There are no student in the subject.");
				return;
			}

			// fetch data
			grades.map( grade => {
				var first_quarter =$(`#first_quarter-${grade.id}`).val();
				var second_quarter = $(`#second_quarter-${grade.id}`).val();

				var g1 = parseFloat(first_quarter), g2 = parseFloat(second_quarter);


				var semestral_grade =( (g1 + g2) / 2 ).toFixed(0);

				var remark;

				if (!isNaN(g1) && !isNaN(g2) && !isNaN(semestral_grade)){
					if (semestral_grade > 1 && semestral_grade < 75) remark = "FAILED";
					else if (semestral_grade <= 100 && semestral_grade > 74) remark = "PASSED";
					else remark = null;
				} else {
					first_quarter = null;
					second_quarter = null;
					semestral_grade = null;
					remark = null;
				}

				//console.log("GRADE : ", {first_quarter,second_quarter,semestral_grade,remark});

				grade.first_quarter = first_quarter;
				grade.second_quarter = second_quarter;
				grade.semestral_grade = semestral_grade;
				grade.remark = remark;

				return grade;
			});
			console.log("GRADES", grades);

			$.ajax({
				url: `<?php echo url("sys/api.php?a=save-student-grade"); ?>`,
				method: 'POST',
				data: { data: JSON.stringify(grades) },
				success: (data) => {
					console.log(data);
					window.renderData();
				}

			});
		}
	}

	window.onload = (e) => {
		window.renderData();
	}


</script>