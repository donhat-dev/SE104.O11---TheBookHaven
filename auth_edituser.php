<?php
	session_start();
	if(isset($_SESSION['customer'])){
		header("Location: edit_account.php");
		exit(); 
	}
	else{
		header("Location: login.php");
		exit();
	}
?>