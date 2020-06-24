<?php 
	
	require_once "../controller/MisCasosController.php";
	//session_start();
	if(isset($_SESSION["Usuario"])){
		$titulo='Mis Casos';
		$user=$_SESSION["Usuario"];
		require_once "../view/header.php";
		require_once "../view/misasignados.php";
		require_once "../view/footer.php";

	}else{
		header("location: ../view/login.php");
	}	

		

 ?>