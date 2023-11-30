<?php 
include 'config/connect.php';
include 'config/funtion.php';

$data = $_POST['data'];

//create a log file
$myFile = "log.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, $data);


?>