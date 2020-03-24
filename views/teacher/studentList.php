<?php
    $data = array();
    
    //database details
    $dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = 'Mk396sfAUzgU';
    $dbName     = 'ogs';
    
    //create connection and select DB
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($db->connect_error){
        die("Unable to connect database: " . $db->connect_error);
    }
    
    //get user data from the database
    $query = $db->query("SELECT * FROM students WHERE id = {$_GET['id']}");
    $query2 = $db->query("SELECT * From subjects Where id = {$_GET['subjectId']}");
    
    if($query->num_rows > 0){
        $userData = $query->fetch_assoc();
        $subjectData = $query2->fetch_assoc();
        $data['status'] = 'ok';
        $data['result'] = $userData;
        $data['data'] = $subjectData;
    }else{
        $data['status'] = 'err';
        $data['result'] = '';
    }
    
    //returns data as JSON format
    echo json_encode($data);

?>