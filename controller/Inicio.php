<?php 
	
	require "../config/config.php";
	require "../libs/Database.php";
	require "../model/Login.php";
	session_start();

	class Inicio{

		function __construct(){
			
		}

		public static function Signin($user, $pass){
			$login=new Login();
			$login->__SET("user", $user);
			$usuario='';
			$clave='';
			$rol='';
			$nombre='';
			$apellidos='';
			if($login->Signin_Model()){
				// var_dump("Entró");
				foreach ($login->Signin_Model() as $value) {
					$usuario=$value["idUsuario"];
					$clave=$value["Clave"];
					$rol=$value["Rol_idRol"];
					$nombre=$value["Nombre"];
					$apellidos=$value["Apellidos"];
				}

				if ($clave==$pass) {
					$_SESSION["Usuario"]=$usuario;
					$_SESSION["Nombre"]=$nombre;
					$_SESSION["Rol"]=$rol;
					$_SESSION["Apellidos"]=$apellidos;
					if($_SESSION["Rol"]==1 || $_SESSION["Rol"]==4){
						header("location: ../controller/Casos.php");
					}else{
						header("location: ../controller/MisCasos.php");
					}
					
				}else{
					//$_SESSION["msg"]='swal("","Usuario o Contraseña incorrectos","error")';
					header("location: ../view/login.php");
				}
			}else{
				//$_SESSION["msg"]='swal("","Usuario o Contraseña incorrectos","error")';
				header("location: ../view/login.php");
			}
		}
	}


 ?>