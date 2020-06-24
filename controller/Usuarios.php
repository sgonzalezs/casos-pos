<?php 
	
	require_once "../controller/UsuariosController.php";
	// session_start();
	if(isset($_SESSION["Usuario"]) && $_SESSION["Rol"]==1){
		$titulo='USUARIOS';
		require_once "../view/header.php";
		require_once "../view/usuarios.php";
		require_once "../view/footer.php";

	}else if(isset($_SESSION["Usuario"]) && $_SESSION["Rol"]!=1){
		header("location: ../controller/MisCasos.php");
	}else{
		header("location: ../view/login.php");
	}


?>