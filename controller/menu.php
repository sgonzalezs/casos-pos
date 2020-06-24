<?php 
session_start();
if(isset($_SESSION["Usuario"])){

	include "../view/header.php"; 
	include "../view/menu.php";
	include "../view/footer.php"; 
}else{
	header("location: ../view/login.php");
}

 ?>