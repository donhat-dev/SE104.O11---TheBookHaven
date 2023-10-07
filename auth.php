<?php
	session_start();
	if(isset($_SESSION['customer'])){
		header("Location: checkout.php");
		exit(); 
	}
	else{
		header("Location: login.php");
		exit();
	}
?>