<?php

 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

$servername = "localhost";
$username = "root";
$password = "***";
$dbname = "NativeVsHybrid";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);


if(isset($obj['execution'])){ 
		if($obj['platform'] == "HYBRID") $sql = 'INSERT INTO hybrid (task, execution, os_version) VALUES ("'.$obj['task'].'","'.$obj['execution'].'","'.$obj['os_version'].'")';
		else if($obj['platform'] == "NATIVE") $sql = 'INSERT INTO native (task, execution, os_version) VALUES ("'.$obj['task'].'","'.$obj['execution'].'","'.$obj['os_version'].'")';
	}
else $sql = 'INSERT INTO user_pool (name, pwd) VALUES ("'.$obj['name'].'","'.$obj['pwd'].'")';

$result = $conn->query($sql);

echo $json;

$conn->close();
?>