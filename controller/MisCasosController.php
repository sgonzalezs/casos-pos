<?php 
	
	require_once "../config/config.php";
	require_once "../libs/Database.php";
	require_once "../model/MisCasos.php";
	require_once "../model/Casos.php";
	session_start();
	$user=$_SESSION["Usuario"];
	$miscasos=new MisCasos();
	$miscasos->__SET("iduser", $user);

	//Instancia de Casos
	$casos= new Casos();

	//Listando en php
	$listMyCases='';
	$listedMyCases='';
	foreach ($miscasos->ListCasesPersonal_model() as $value) {
		$listMyCases.="<tr>";
		$listMyCases.="<td>".$value["Casos_idCaso"]."</td>";
		$listMyCases.="<td>".$value["Nit"]."</td>";
		$listMyCases.="<td>".$value["Cliente"]."</td>";
		$listMyCases.="<td>".$value["Asunto"]."</td>";
		$listMyCases.="<td>".$value["Asesor"]." ".$value["Last_Asesor"]."</td>";
		$listMyCases.="<td>".$value["Asignado"]." ".$value["Apellidos"]."</td>";
		$listMyCases.="<td>".
					"<a href='#' data-toggle='modal' data-target='#ShowMoreMyCase'  onclick='ShowMoreMyCases(".$value["idAsignados"].")' title='Ver Más'>".
						"<i class='fa fa-eye' aria-hidden='true'></i></a>".
					"<a href='#' title='Pendiente'>".
						"<i class='fa fa-exchange' aria-hidden='true' style='color: white; background: #FFD700; border-radius: 15px;'></i></a>".
						"<a href='#' data-toggle='modal' data-target='#' title='Terminar Caso' onclick='EndCase(".$value["idAsignados"].")'>".
						"<i class='fa fa-check-circle' aria-hidden='true' style='color: white; background:#36D928; '></i></a>".
						"</td>";
		$listMyCases.="</tr>";

		$listedMyCases.="<tr><td>".$value["Casos_idCaso"]."</td><td>".$value["Nit"]."</td><td>".$value["Cliente"]."</td><td>".$value["Asunto"]."</td>".
		"<td>".$value["Asesor"]."</td><td>".$value["Servicio"]."</td>".
			"<td><a href='#' data-toggle='modal' data-target='#ShowMoreMyCase'  onclick='ShowMoreMyCases(".$value["idAsignados"].")' title='Ver Más'>".
			"<i class='fa fa-eye' aria-hidden='true'></i></a>".
			"<a href='#' title='Solicitar reasignación' onclick='ReassignCase(".$value["idAsignados"].")'>".
			"<i class='fa fa-exchange' aria-hidden='true' style='color: white; background: #434343; border-radius: 5px;'></i></a>".
			"<a href='#' data-toggle='modal' data-target='#' title='Terminar Caso' onclick='EndCase(".$value["idAsignados"].")'>".
			"<i class='fa fa-check-circle' aria-hidden='true' style='color: white; background:#36D928; '></i></a></td></tr>";
	}


	$listMyAssigned='';
	$stateCase='';
	$bg='';
	$fechaTbl='';
	foreach ($miscasos->ListMyAssigned_model() as $Myassg) {

		$fechaTbl=$Myassg["Fecha_Asignado"];

		if($Myassg["Estado"]==0){
			$stateCase="<div class='btn btn-warning'>Pendiente</div>";
			// $bg='background: #ffc266';
		}
		
		if($Myassg["Estado"]==1){
			$stateCase="<div class='btn btn-success'>Terminado</div>";
			// $bg='background: #80ff80';
		}

		if($Myassg["Estado"]==2){
			$stateCase="<div class='btn btn-primary'>En resignacion</div>";
			// $bg='background: #b3d9ff';
		}

		if($Myassg["Fecha_Asignado"]==null){
			$fechaTbl='No disponible';
		}

		$listMyAssigned.="<tr>";
		$listMyAssigned.="<td>".$Myassg["idCaso"]."</td>";
		$listMyAssigned.="<td>".$Myassg["Nit"]."</td>";
		$listMyAssigned.="<td>".$Myassg["Cliente"]."</td>";
		$listMyAssigned.="<td>".$Myassg["Asunto"]."</td>";
		$listMyAssigned.="<td>".$fechaTbl."</td>";
		$listMyAssigned.="<td>".$stateCase."</td>";
		$listMyAssigned.="<td>".($Myassg["Asignado"]?$Myassg["Asignado"]." ".$Myassg["Apellidos"]:"<p>Sin Asignar</p>")."</td>";
		$listMyAssigned.="<td>".
			"<a href='#' data-toggle='modal' data-target='#ShowMoreMyAssgned'  onclick='ShowMore_MyAssigned(".$Myassg["idCaso"].")' title='Ver Más'>".
			"<i class='fa fa-eye' aria-hidden='true'></i></a></td>";
		$listMyAssigned.="</tr>";
	}


	//Llamando metodos del modelo Casos
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

	$clients='';
	foreach ($miscasos->ListClients_model() as $valClnt) {
		$clients.="<option>".$valClnt["Nit"]."</option>";
	}
	

	if(isset($_GET["list"])==1){
		$lista=$miscasos->ListCasesPersonal_model();
		echo json_encode($lista);
	}

	if (isset($_GET["notf"])==1) {
		$miscasos->__SET("iduser", $user);
		$numAssigned=$miscasos->MyCasesCount_model();
		echo $numAssigned;	
	}

	if(isset($_GET["info"])){
		$miscasos->__SET("idAssgn", $_GET["info"]);
		$moreinfo=$miscasos->ShowMoreMyCases_model();
		echo json_encode($moreinfo);
	}

	if(isset($_GET["infoMyAssg"])){
		$miscasos->__SET("idAssgn", $_GET["infoMyAssg"]);
		$moreinfo=$miscasos->ShowMoreMyAssineds_model();
		echo json_encode($moreinfo);
	}

	if (isset($_GET["noteView"])==1 && isset($_GET["codAsgn"])) {
		$miscasos->__SET("idAssgn", $_GET["codAsgn"]);
		$note=$miscasos->NoteMyCase_model();
		echo json_encode($note);
	}

	if(isset($_GET["theme"])==1){
		$them=$miscasos->ListTheme();
		echo json_encode($them);
	}

	if(isset($_GET["fin"])==1){
		date_default_timezone_set("America/Bogota");
        $fecha = date('y-m-d H:i:s');
		$miscasos->__SET("description", $_POST["desc"]);
		$miscasos->__SET("idAssgn", $_POST["id"]);
		$miscasos->__SET("typeN", 2);
		if($miscasos->NewNote_model()){
			$miscasos->__SET("idAssgn", $_POST["id"]);
			$miscasos->__SET("date", $fecha);
			$miscasos->__SET("theme", $_POST["theme"]);
			$miscasos->EndMyscase_model();
		}
	}

	if(isset($_GET["clnts"])){
		$miscasos->__SET("iduser", $_GET["clnts"]);
		$moreinfoClnts=$miscasos->ListClientsComplete_model();
		echo json_encode($moreinfoClnts);
	}

	if(isset($_GET["saveCaseH"])==1){
		date_default_timezone_set("America/Bogota");
   		$fecha = date('y-m-d H:i:s');
		
		$name=null;

		if($_FILES["fileCaseH"]["name"]!=""){
			$document=$_FILES["fileCaseH"];
			$ext=explode(".", $document["name"])[1];
			$name=md5($document["tmp_name"]).".".$ext;

			$rout="../Files/".$name;
			move_uploaded_file($document["tmp_name"], $rout);

			// if(!file_exists("Files")){
			// 	mkdir("../Files", 0777, true);
			// 	if(file_exists("Files")){
			// 		$rout="../Files/".$name;
			// 		move_uploaded_file($document["tmp_name"], $rout);
			// 	}
			// }else{
			// 	$rout="../Files/".$name;
			// 	move_uploaded_file($document["tmp_name"], $rout);
			// }
			
		}	

		
		$casos->__SET("nit", $_POST["txt_nitCaseHead"]);
		$casos->__SET("cliente", $_POST["txt_clientCaseHead"]);
		$casos->__SET("asunto", $_POST["txt_AsntCaseHead"]);
		$casos->__SET("desc", $_POST["txa_DescCaseHead"]);
		$casos->__SET("fecha", $fecha);
		$casos->__SET("asesor", $_POST["slc_AcCaseHead"]);
		$casos->__SET("soft", $_POST["slc_SoftCaseHead"]);
		$casos->__SET("files", $name);
		$casos->SaveCase_model();
		// foreach ($_FILES["fileCase"] as $key => $value) {
		// 	echo $key.' '.$value.'->';
		// }
	}

	if(isset($_GET["service"])==1){
		$miscasos->__SET("nameService", $_POST["service"]);
		$miscasos->__SET("typeService", $_POST["typeServ"]);
		$miscasos->SaveService();
	}

	if(isset($_GET["serviceList"])==1){
		$listServ=$miscasos->ListService();
		echo json_encode($listServ);
	}

	if(isset($_GET["idAsg"])==1){
		$miscasos->__SET("idAssgn", $_POST["id"]);
		$miscasos->__SET("description", $_POST["txaRa"]);
		$miscasos->__SET("typeN", 3);
		if($miscasos->NewNote_model()){
			$miscasos->__SET("idAssgn", $_POST["id"]);
			$miscasos->ReassignCase();
		}
		
	}

 ?>