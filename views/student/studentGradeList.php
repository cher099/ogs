<?php
    $data = array();
    
    //database details
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'ogs';
    
    //create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($db->connect_error){
        die("Unable to connect database: " . $db->connect_error);
    }
    
    //get user data from the database
    $currentUser = intval($_SESSION['user']['id']);
    $school_year = strval($_GET['schoolYear']);
    $semester = strval($_GET['semester']);
    $subjectQuery = $db->query("SELECT subjects.id as id, subjects.name as name, subjects.semester as semester, subjects.track as track, subjects.school_year as school_year, grades.student_id as student_id, grades.subject_id as subject_id, grades.first_quarter as first_quarter, grades.second_quarter as second_quarter, grades.semestral_grade as semestral_grade, grades.remark as remark FROM subjects INNER JOIN grades ON grades.subject_id=subjects.id WHERE (subjects.school_year='$school_year') AND (subjects.semester='$semester')");
    
    if($subjectQuery->num_rows > 0){
        $gradeData = $subjectQuery->fetch_assoc();
        $data['status'] = 'ok';
        $data['result'] = $gradeData;
    }else{
        $data['status'] = 'err';
        $data['result'] = '';
    }
    
    //returns data as JSON format
    echo json_encode($data);

?>