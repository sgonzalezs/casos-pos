<?php 
	
	require_once "../controller/HistorialController.php";
	// session_start();
	if(isset($_SESSION["Usuario"])){
		$titulo='HISTORIAL';
		require_once "../view/header.php";
		require_once "../view/historial.php";
		require_once "../view/footer.php";

	}else{
		header("location: ../view/login.php");
	}

 ?>