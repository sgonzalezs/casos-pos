<?php 
	
	require_once "../config/config.php";
	require_once "../libs/Database.php";
	require_once "../model/Historial.php";
	require_once "../model/Casos.php";
	require_once "../model/MisCasos.php";

	session_start();
	$historial=new Historial();

	$tableHistory='';
	foreach ($historial->ListHistory_model() as $valhistory) {
		$tableHistory.="<tr>";
		$tableHistory.="<td>".$valhistory["Nit"]." - ".$valhistory["Cliente"]."</td>";
		// $tableHistory.="<td>".$valhistory["Cliente"]."</td>";
		$tableHistory.="<td>".$valhistory["Asunto"]."</td>";
		$tableHistory.="<td>".$valhistory["Asesor"]." ".$valhistory["Last_Asesor"]."</td>";
		$tableHistory.="<td>".$valhistory["Asignado"]." ".$valhistory["Apellidos"]."</td>";
		$tableHistory.="<td>".$valhistory["Fecha_fin"]."</td>";
		$tableHistory.="<td>".
		"<a href='#' data-toggle='modal' data-target='#ShowMoreAssign'  onclick='ShowMoreAssigned(".$valhistory["idAsignados"].")' title='Ver Más'>".
		"<i class='fa fa-eye' aria-hidden='true'></i></a>".
		"<a href='#' data-toggle='modal' data-target='#ModalNotaFinMyAsg'  onclick='ShowMoreCaseEndAsg(".$valhistory["idAsignados"].")' title='Ver Solucion del Caso'>".
		"<i class='fa fa-check-square' aria-hidden='true'></i></a>";
		$tableHistory.="</tr>";
	}

	$casos=new Casos();
	$optionEnvH='';
	foreach ($casos->ListEnviroment() as $value) {
		$optionEnvH.="<option value='".$value["idEntorno"]."'>".$value["Nombre"]."</option>";
	}

	$listAc='';
	if($_SESSION["Rol"]==3){
		$listAc="<option value='".$_SESSION["Usuario"]."'>".$_SESSION["Nombre"]."</option>";
	}else{
		foreach ($casos->ListAC_model() as $ac) {
			$listAc.="<option value='".$ac["idUsuario"]."'>".$ac["Nombre"]."</option>";
		}
	}

	$miscasos=new MisCasos();
	$clients='';
	foreach ($miscasos->ListClients_model() as $valClnt) {
		$clients.="<option>".$valClnt["Nit"]."</option>";
	}

	if(isset($_GET["id"])==true){
		$historial->__SET("idAssgn", $_GET["id"]);
		$desc=$historial->ShowMoreSolution_model();
		echo json_encode($desc);
	}

	if(isset($_GET['graphics'])){
		$historial->__SET("role", $_GET["role"]);
		echo json_encode($historial->getGraphics());
	}

	if(isset($_GET['pie_themes'])){
		echo json_encode($historial->pieTheme());
	}

 ?>
