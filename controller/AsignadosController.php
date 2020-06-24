<?php 
	
	require_once "../config/config.php";
	require_once "../libs/Database.php";
	require_once "../model/Asignados.php";
	session_start();
	$titulo="ASIGNADOS";
	$asignados=new Asignados();

	$tblAsignados='';
	$distinctState='';
	$txtState='';
	foreach ($asignados->ListCasesAssigneds_model() as $value) {

		if($value["Estado"]==0){
			$txtState='<button type="button" class="btn btn-warning">Pendiente</button>';
			$distinctState="";
		}

		if($value["Estado"]==2){
			$txtState='<button type="button" class="btn btn-primary">Reasignación</button>';
			$distinctState="";
		}

		if($_SESSION["Rol"]==1 && $value["Estado"]==0){
			$distinctState="<a href='#' onclick='updateAsessor(`".$value["Nit"]."`,`".$value["Cliente"]."`,`".$value["Asesor"].
			"`,`".$value["Last_Asesor"]."`,`".$value["codAsesor"]."`)' title='Cambiar Ejecutivo'>
			<i class='fa fa-user' aria-hidden='true' style='color: white; background: #434343; border-radius: 5px;'></i></a>";
		}

		if($_SESSION["Rol"]==1 && $value["Estado"]==2){
			$distinctState="<a href='' data-toggle='modal' data-target='#modalReAssign' title='Reasignar Caso' ".
			"onclick='AssingAgain(".$value["idAsignados"].",`".$value["Asesor"]." ".$value["Last_Asesor"]."`,`".$value["codAsesor"]."`)'><i class='fa fa-exchange' aria-hidden='true' style='color: white; background: #434343; border-radius: 5px;'></i></a>";
		}

		$tblAsignados.="<tr>";
		$tblAsignados.="<td>".$value["Casos_idCaso"]."</td>";
		$tblAsignados.="<td>".$value["Nit"]." ".$value["Cliente"]."</td>";
		$tblAsignados.="<td>".$value["Asunto"]."</td>";
		$tblAsignados.="<td>".$value["Asesor"]." ".$value["Last_Asesor"]."</td>";
		$tblAsignados.="<td>".$value["Asignado"]." ".$value["Apellidos"]."</td>";
		$tblAsignados.="<td>".$value["Servicio"]."</td>";
		$tblAsignados.="<td>".$txtState."</td>";
		$tblAsignados.="<td>".
					"<a href='#' data-toggle='modal' data-target='#ShowMoreAssign'  onclick='ShowMoreAssigned(".$value["idAsignados"].")' title='Ver Más'>".
						"<i class='fa fa-eye' aria-hidden='true'></i></a>".$distinctState."</td>";
		$tblAsignados.="</tr>";
	}


	$slcServreAssign='';
	foreach ($asignados->ListServiceReAssign_model() as $valServ) {
		$slcServreAssign.="<option value='".$valServ["idServicio"]."' class='".$valServ["Tipo"]."'>".utf8_encode($valServ["Nombre"])."</option>";
	}

	// $slcTecAssign='';
	// foreach ($asignados->ListTecReAssign_model() as $valTec) {
	// 	$slcTecAssign.="<option value='".$valTec["idUsuario"]."'>".utf8_encode($valTec["Nombre"]." ".$valTec["Apellidos"])."</option>";
	// }

	if (isset($_GET["notf"])==1) {
		$numAssigned=$asignados->AssignedCount_model();
		echo $numAssigned;	
	}

	if(isset($_GET["info"])){
		$asignados->__SET("idAssgn", $_GET["info"]);
		$moreinfo=$asignados->ShowMore_model();
		echo json_encode($moreinfo);
	}

	if (isset($_GET["noteView"])==1 && isset($_GET["codAsgn"])) {
		$asignados->__SET("idAssgn", $_GET["codAsgn"]);
		$note=$asignados->NoteAssigned_model();
		echo json_encode($note);
	}

	if (isset($_GET["noteRA"])==1 && isset($_GET["idAdsgNote"])) {
		$asignados->__SET("idAssgn", $_GET["idAdsgNote"]);
		$note=$asignados->NoteREAssigned_model();
		echo json_encode($note);
	}

	if(isset($_GET["id"])==true){
		$asignados->__SET("idAssgn", $_GET["id"]);
		$desc=$asignados->ShowMoreSolution_model();
		echo json_encode($desc);
	}

	if(isset($_GET["valAssg"])){
		$asignados->__SET("idAssgn", $_GET["valAssg"]);
		echo json_encode($asignados->ListTecReAssign_model());
	}

	if(isset($_GET["newAssgn"])==1){
		$asignados->__SET("user", $_POST["newAssigned"]);
		$asignados->__SET("service", $_POST["serviceRA"]);
		$asignados->__SET("idAssgn", $_POST["id"]);
		$asignados->ReAssign_model();
	}

	if(isset($_GET["validateAssesor"])==1){
		$asignados->__SET("user", $_GET["idAssesor"]);
		echo json_encode($asignados->ListAssesor_model());
	}

	if (isset($_GET["UpdateAss"])==1) {
		$asignados->__SET("user", $_POST["user"]);
		$asignados->__SET("client", $_POST["nit"]);
		$asignados->updateAssesor_model();
	}

 ?>