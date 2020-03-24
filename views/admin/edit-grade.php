<?php
    $servername = "localhost";
    $username = "root";
    $password = "Mk396sfAUzgU";
    $dbname = "ogs";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM students WHERE id=".$_GET['studentId']."";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "0 results";
    }

    $grade_sql = "SELECT * from grades where id=".$_GET['gradeId']."";
    $grade_result = mysqli_query($conn, $grade_sql);

    if(mysqli_num_rows($grade_result) > 0) {
        $grade_row = mysqli_fetch_assoc($grade_result);
    } else {
        echo "0 results";
    }
    
    mysqli_close($conn);
?>
<div class="card border-secondary mt-3">
  <div class="card-header">
  	<p class="lead m-0">Edit Grade (<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];?>)</p>
  </div>
  <div class="card-body">
  <form>

  <table class="table">
  <tbody>
    <tr>
      <td>First Semester</td>
      <td>
        <input type="hidden" id="gradeId" value="<?php echo $_GET['gradeId'];?>">
        <input type="text" class="form-control" id="firstQuarter" placeholder="Enter First Quarter" name="firstQuarter" value="<?php echo $grade_row['first_quarter'];?>"></td>
      <td>Second Semester</td>
      <td><input type="text" class="form-control" id="secondQuarter" placeholder="Enter Second Quarter" name="secondQuarter" value="<?php echo $grade_row['second_quarter'];?>"></td>
    </tr>
    <tr>
      <td>Semestral Grade</td>
      <td><input type="text" class="form-control" id="semestralGrade" placeholder="" name="semestralGrade" value="<?php echo $grade_row['semestral_grade'];?>" disabled></td>
      <td>Remarks</td>
      <td>
      <input type="text" class="form-control" id="remarks" placeholder="" name="remarks" value="<?php echo $grade_row['remark'];?>" disabled>
      </td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td> <a href="index.php?p=principals&a=add-grade" class="btn btn-danger">Back</a> | <input type="button" class="btn btn-success" id="btn-update" value="Update Grade"></td>
      <td> </td>
    </tr>
  </tbody>
</table>

</form>
  </div>
</div> 
<?php echo js('jquery.min'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $( "#firstQuarter" ).keyup(function() {

      var first_quarter = parseInt($('#firstQuarter').val());
      if(first_quarter > 100) {
        alert('Grade Must Be less Than 100');
      }
      else {
        var second_quarter = parseInt($('#secondQuarter').val());
        var sum = first_quarter + second_quarter;
        var divide = sum/2;
        var fgrade = Math.round(divide);
        var finalGrade = divide.toFixed(0);
        $('#semestralGrade').val(finalGrade);
        if(finalGrade < 75) {
          $('#remarks').val('FAILED')
        }
        else {
          $('#remarks').val('PASSED')
        }
      }

      });

    $( "#secondQuarter" ).keyup(function() {

      var first_quarter = parseInt($('#firstQuarter').val());
      var second_quarter = parseInt($('#secondQuarter').val());
      if(second_quarter > 100) {
        alert('Grade Must Be less Than 100');
      }
      else {
        var sum = first_quarter + second_quarter;
        var divide = sum/2;
        $('#semestralGrade').val(divide);
        if(divide < 75) {
          $('#remarks').val('FAILED')
        }
        else {
          $('#remarks').val('PASSED')
        }
      }

      });

    $('#btn-update').click(function () {
      var id = $('#gradeId').val();
      var first_quarter = $('#firstQuarter').val();
      var second_quarter = $('#secondQuarter').val();
      var semestral_grade = $('#semestralGrade').val();
      var remarks = $('#remarks').val();

      $.ajax({
        url: 'views/admin/updateGrade.php',
        method: 'POST',
        data: {
          id: id,
          first_quarter: first_quarter,
          second_quarter: second_quarter,
          semestral_grade: semestral_grade,
          remarks: remarks,
        },
        success:function(data){
          alert('Grade Updated Successfully');
        }

      });

    }); 

  });
</script> 