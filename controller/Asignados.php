<?php 
	
	// session_start();
	require_once "../controller/AsignadosController.php";
	if(isset($_SESSION["Usuario"]) && $_SESSION["Rol"]==1 || $_SESSION["Rol"]==4){
		$titulo='ASIGNADOS';
		require_once "../view/header.php";
		require_once "../view/asignados.php";
		require_once "../view/footer.php";
	
	}else if(isset($_SESSION["Usuario"]) && $_SESSION["Rol"]!=1){
		header("location: ../controller/MisCasos.php");
	}else{
		header("location: ../view/login.php");
	}
		

 ?>