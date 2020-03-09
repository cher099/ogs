<?php
ob_start(); // Enabled Output Buffering before session_start() to delay sending http headers.
session_start();
$GLOBALS['BASE_URL'] = "http://localhost/ogs/";

$EV = [
	"css" => "assets/css/",
	"js" => "assets/js/"
];

function css($name) {
	$link = $GLOBALS['EV']['css'] . $name . ".css";
	return "<link rel=\"stylesheet\" type=\"text/css\" href=\"$link\">";
}

function js($name) {
	$link = $GLOBALS['EV']['js'] . $name . ".js";
	return "<script type=\"text/javascript\" src=\"$link\"></script>";
}

function img($name) {
	return "assets/imgs/$name";
}

function dd(...$var){
	var_dump($var);
	die();
}

function url($uri){
	return "{$GLOBALS['BASE_URL']}$uri";
}


class DB {

	public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'ogs');

		if ($db->connect_error){
			die("Error : " . $db->connect_error);
		}

		return $db;
	}

	public static function select($sql){
		$conn = DB::connect();

		$result = $conn->query($sql);

		$rows = [];

		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc())
				$rows[] = $row;
		}

		return $rows;
	}

	public static function exec($sql) {
		$conn = DB::connect();

		return ($conn->query($sql));
	}
}

function to($url){
	header("Location: {$GLOBALS['BASE_URL']}$url");
	die();
}
function now(){
	return date("n/d/Y");
}
function json($data){
	echo json_encode($data);
}
?>