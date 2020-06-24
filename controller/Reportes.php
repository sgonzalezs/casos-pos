<?php 
	
	// session_start();
	require_once "../controller/HistorialController.php";
	if(isset($_SESSION["Usuario"])){
		$titulo='Reportes';
		$user=$_SESSION["Usuario"];
		require_once "../view/header.php";
		require_once "../view/reportes.php";
		require_once "../view/footer.php";

	}else{
		header("location: ../view/login.php");
	}	

 ?>