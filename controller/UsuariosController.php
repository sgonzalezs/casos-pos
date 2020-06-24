<?php 
	
		require "../config/config.php";
		require "../libs/Database.php";
		require "../model/Persona.php";
		session_start();
		$persona= new Persona();
		$titulo='USUARIOS';
		$list=$persona->Rol();
		$optionRol='';
		foreach($list as $value){
			$optionRol.="<option value=".$value["idRol"].">".$value["Nombre"]."</option>";
		}

		$persona->__SET("iduser", $_SESSION["Usuario"]);
		$listUsers=$persona->ListUsers();
		$tableUsers='';
		$delUser='';
		$usersCh='';
		foreach ($listUsers as $valUsers) {

			if($_SESSION["Usuario"]==="admin"){
				$delUser="<a href='#' title='Eliminar Usuario' onclick='ChangeState(`".$valUsers["idUsuario"]."`,`".$valUsers["Rol"]."`)'>".
				"<i class='fa fa-trash iconUserDelete' aria-hidden='true'></i></a>";
			}

			$usersCh="<a href='#' title='Editar Clientes' onclick='changeUsers(`".$valUsers["idUsuario"]."`,`".$valUsers["Rol"]."`)'>".
			"<i class='fa fa-eye' aria-hidden='true'></i></a>";
			

			$tableUsers.="<tr>";
			// $tableUsers.="<td>".$valUsers["idUsuario"]."</td>";
			$tableUsers.="<td>".$valUsers["Nombre"]."</td>";
			$tableUsers.="<td>".$valUsers["Apellidos"]."</td>";
			$tableUsers.="<td>".$valUsers["Correo"]."</td>";
			$tableUsers.="<td>".$valUsers["Rol"]."</td>";
			$tableUsers.="<td>".$delUser.$usersCh."</td>";
			$tableUsers.="</tr>";
		}

		switch (isset($_GET["op"])) {
			case 'save':
				$persona->__SET("iduser", $_POST["iduser"]);
				$persona->__SET("nombre", $_POST["name"]);
				$persona->__SET("apellidos", $_POST["last_name"]);
				$persona->__SET("correo", $_POST["email"]);
				$persona->__SET("clave", $_POST["pass"]);
				$persona->__SET("rol", $_POST["rol"]);
				$persona->SaveUser();
			break;
		}

		if(isset($_GET["updt"])==1){
			$persona->__SET("state", $_POST["estado"]);
			$persona->__SET("iduser", $_POST["usuario"]);
			$persona->ChangeState_model();
		}

		if(isset($_GET["changeA"])==1){
			$persona->__SET("iduser", $_GET["id"]);
			echo json_encode($persona->listChangeAssesor());
		}

		if(isset($_GET["changeTec"])==1){
			$persona->__SET("iduser", $_GET["id"]);
			echo json_encode($persona->listChangeTec());
		}

		if(isset($_GET["changeUser"])==1){
			$persona->__SET("iduser", $_POST["newUser"]);
			$persona->__SET("id_olduser", $_POST["id"]);
			$persona->ChangeUserAssigned();
			
			if(isset($_GET["bol_rol"])==1){
				$persona->ChangeUserCases();
			}
		}

 ?>