<?php 

	// session_start();
	require_once "../controller/CasosController.php";
	if(isset($_SESSION["Usuario"]) && $_SESSION["Rol"]==1 || $_SESSION["Rol"]==4){
		$titulo='CASOS';
		require_once "../view/header.php";
		require_once "../view/casos.php";
		require_once "../view/footer.php";

	}else if(isset($_SESSION["Usuario"]) && $_SESSION["Rol"]!=1 || $_SESSION["Rol"]!=4){
		header("location: ../controller/MisCasos.php");
	}else{

		header("location: ../view/login.php");
	}


?>