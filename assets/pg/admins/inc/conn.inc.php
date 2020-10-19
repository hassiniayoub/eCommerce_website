<?php

$host_name = "http://localhost/ecomweb/";

$absolute_link = $host_name . "assets/pg/";

$filename = __DIR__ . "/server.inc.ecomweb";

$server_file = fopen($filename, "r");

$server_data = fread($server_file, filesize($filename));

$filter_data = explode(",", $server_data);

$server = $filter_data[0];
$user_serv = $filter_data[1];
$pass_serv = $filter_data[2];
$dbname = $filter_data[3];

// echo $server;
// echo $user_serv;
// echo $pass_serv;
// echo $dbname;

$conn = new mysqli($server, $user_serv, $pass_serv, $dbname);

fclose($server_file);

$conn->query("SET NAMES utf8");
$conn->query("SET CHARACTER SET utf8");

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}
// else {
// 	echo "Conection good!";
// }

error_reporting(0);

?>
