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

     $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ogs";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    $subject_sql = "SELECT * from subjects where id=".$_GET['getSubjectId']."";
    $subject_result = mysqli_query($conn, $subject_sql);
    $teacher_sql = "SELECT * from teachers where id =".$_GET['getTeacherId']."";
    $teacher_result = mysqli_query($conn, $teacher_sql);

    $grade_section_sql = "SELECT s.*,s.name as section_name,l.*  from section as s join levels as l  on s.id  = l.id where s.id = ".$_GET['getSectionId']."";
    $grade_section_result = mysqli_query($conn, $grade_section_sql);

    if(mysqli_num_rows($grade_section_result) > 0) {
      $grade_section_row = mysqli_fetch_assoc($grade_section_result);
    }

    if(mysqli_num_rows($teacher_result) > 0) {
      $teacher_row = mysqli_fetch_assoc($teacher_result);
    }

    if(mysqli_num_rows($subject_result) > 0) {
        $subject_row = mysqli_fetch_assoc($subject_result);
    } else {
        echo "0 results";
    }

    $first_grade = "";
    $second_grade = "";

    if($subject_row['semester'] == "First Semester") {
      $first_grade = "First Quarter";
      $second_grade = "Second Quarter";
    }
    else {

      $first_grade = "Third Quarter";
      $second_grade = "Fourth Quarter";
    }
    
    mysqli_close($conn);
    


    $name = "Ivan Ray";
    require('fpdf182/fpdf.php');
    
    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage('L');

    $pdf->SetFont('Arial', 'B', 14);

    //cell
    $pdf->Cell(277,10,'Semestral Grade',0,1,'C');
    $pdf->Cell(92,5,'',0,1,'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(92,7,'Region: Region XI',0,0,'');
    $pdf->Cell(92,7,'Division: Davao Del Sur',0,0,'');
    $pdf->Cell(92,7,'School ID: 101283-4',0,1,'');
    $pdf->Cell(277.5,5,'',0,1,'');
    $pdf->Cell(183.5,7,'School Name: Gabriel Taborin College of Davao Foundation Inc.',0,0,'');
    $pdf->Cell(138.5,7,'School  Year: '.$subject_row['school_year'].'',0,1,'');
    $pdf->Cell(277.5,5,'',0,1,'');
    $pdf->Cell(183.5,7,'Grade & Section: '.$grade_section_row['name'].' / '.$grade_section_row['section_name'].'',0,0,'');
    $pdf->Cell(138.5,7,'Subject: '.$subject_row['name'].'',0,1,'');
    $pdf->Cell(277.5,5,'',0,1,'');
    $pdf->Cell(183.5,7,'Teacher: '.$teacher_row['first_name'].' '.$teacher_row['last_name'].'',0,0,'');
    $pdf->Cell(138.5,7,'Track: '.$subject_row['track'].'',0,1,'');
    $pdf->Cell(277.5,5,'',0,1,'');
    $pdf->Cell(39,7,'ID #',1,0,'C');
    $pdf->Cell(70,7,'Student Name ',1,0,'C');
    $pdf->Cell(39,7,'Semester',1,0,'C');
    $pdf->Cell(30,7,$first_grade,1,0,'C');
    $pdf->Cell(30,7,$second_grade,1,0,'C');
    $pdf->Cell(39,7,'Semestral Grade',1,0,'C');
    $pdf->Cell(35,7,'Remarks',1,1,'C');



    foreach ($studentGrades as $grades) {
        $pdf->Cell(39,7,$grades['id_number'],1,0,'C');
        $pdf->Cell(70,7,$grades['first_name'].' '.$grades['last_name'],1,0,'C');
        $pdf->Cell(39,7,$grades['semester'],1,0,'C');
        $pdf->Cell(30,7,$grades['first_quarter'],1,0,'C');
        $pdf->Cell(30,7,$grades['second_quarter'],1,0,'C');
        $pdf->Cell(39,7,$grades['semestral_grade'],1,0,'C');
        $pdf->Cell(35,7,$grades['remark'],1,1,'C');
    }



    $pdf->Output();
?>