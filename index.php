<?php 

include 'views/inc/header.php'; 

$rqst = $_SERVER['REQUEST_METHOD'];
$page = (isset($_GET['p']))? $_GET['p'] : null;


//routes
include 'sys/actions.php';
include 'sys/routes.php';

include 'views/inc/footer.php'; 

?>
