<?php 
		
	require_once "../config/config.php";
	require_once "../libs/Database.php";
	require_once "../model/Casos.php";
	session_start();
	$casos= new Casos();
	
	$listEnv=$casos->ListEnviroment();

	$optionEnv='';
	foreach ($listEnv as $value) {
		$optionEnv.="<option value='".$value["idEntorno"]."'>".$value["Nombre"]."</option>";
	}

	$listAc='';
	foreach ($casos->ListAC_model() as $ac) {
		$listAc.="<option value='".$ac["idUsuario"]."'>".$ac["Nombre"]." ".$ac["Apellidos"]."</option>";
	}

	$slcServ='';
	foreach ($casos->ListService_model() as $valServ) {
		$slcServ.="<option value='".$valServ["idServicio"]."' class='".$valServ["Tipo"]."'>".utf8_encode($valServ["Nombre"])."</option>";
	}

	$userCase='';
	foreach ($casos->ListUsers_model() as $valUserC) {
		$userCase.="<option value='".$valUserC["idUsuario"]."'>".$valUserC["Nombre"]." ".$valUserC["Apellidos"]."</option>";
	}

	$clients='';
	foreach ($casos->ListClients_model() as $valClnt) {
		$clients.="<option>".$valClnt["Nit"]."</option>";
	}

	$tablecases='';
	$btnassg='';
	$usr=$_SESSION["Usuario"];
	foreach ($casos->ListCases_model() as $tblCases) {

		if($usr==='admin'){
			$btnassg="<i class='fa fa-address-book' aria-hidden='true' style='color: white; background: #434343;'></i></a>";
		}

		$tablecases.="<tr>";
		$tablecases.="<td>".$tblCases["idCaso"]."</td>";
		$tablecases.="<td>".$tblCases["Nit"]."</td>";
		$tablecases.="<td>".utf8_encode($tblCases["Cliente"])."</td>";
		$tablecases.="<td>".$tblCases["fecha"]."</td>";
		$tablecases.="<td>".($tblCases["Asunto"])."</td>";
		$tablecases.="<td>".$tblCases["Nombre"]." ".$tblCases["Apellidos"]."</td>";
		$tablecases.="<td>".
					"<a href='#' data-toggle='modal' data-target='#ShowMoreCase'  onclick='ShowMore(".$tblCases["idCaso"].")' title='Ver Más'>".
						"<i class='fa fa-eye' aria-hidden='true'></i></a>".
					"<a href='#' title='Asignar Caso' data-toggle='modal' data-target='#ModalAsignar' 
					onclick='AssignCase(".$tblCases["idCaso"].",`".$tblCases["Usuarios_idUsuario"]."`,`".$tblCases["Nombre"]." ".$tblCases["Apellidos"]."`)'>".$btnassg.
					"</td>";
		$tablecases.="</tr>";
	}

	if (isset($_GET["notf"])==1) {
		$numCases=$casos->CasesCount_model();
		echo $numCases;	
	}

	if (isset($_GET["Type"])==1) {
		$TypeThem=$casos->ListAllType();
		echo json_encode($TypeThem);	
	}


	if(isset($_GET["cod"])){
		$casos->__SET("idEnv", $_GET["cod"]);
		$listSoft=$casos->ListType();
		echo json_encode($listSoft);
	}

	if(isset($_GET["VerMasid"])){
		$casos->__SET("idcaso", $_GET["VerMasid"]);
		$info=$casos->ShowMoreCase_model();
		echo json_encode($info);
	}

	switch (isset($_GET["op"])) {
		case 'SaveCase':

			date_default_timezone_set("America/Bogota");
            $fecha = date('y-m-d H:i:s');

            $name=null;
            if($_FILES["file_Case"]["name"]!=""){
	            $documentCase=$_FILES["file_Case"];
				$ext=explode(".", $documentCase["name"])[1];
				$name=md5($documentCase["tmp_name"]).".".$ext;
				$rout="../Files/".$name;
				move_uploaded_file($documentCase["tmp_name"], $rout);

            }

			$casos->__SET("nit", $_POST["txt_nitCase"]);
			$casos->__SET("cliente", $_POST["txt_clientCase"]);
			$casos->__SET("asunto", $_POST["txt_AsntCase"]);
			$casos->__SET("desc", $_POST["txa_DescCase"]);
			$casos->__SET("fecha", $fecha);
			$casos->__SET("asesor", $_POST["slc_AcCase"]);
			$casos->__SET("soft", $_POST["slc_SoftCase"]);
			$casos->__SET("files", $name);
			// if(filesize($name)>5){
			// 	echo
			// }
			if($casos->SaveCase_model()){
				// var_dump($_FILES["file_Case"]["name"]);
				echo "Caso registrado exitosamente";
			}

		break;
	}
	

	if(isset($_GET["AsignarCaso"])==1){
		date_default_timezone_set("America/Bogota");
        $date = date('y-m-d H:i:s');
		$casos->__SET("idcaso", $_POST["id"]);
		$casos->__SET("iduser", $_POST["user"]);
		$casos->__SET("service", $_POST["service"]);
		$casos->__SET("fecha", $date);
		$casos->Assingcases_model();
	}

	if(isset($_GET["Note"])==1){
		$idAssgn=$casos->CodCaseAssgn_model();
		$casos->__SET("note", $_POST["note"]);
		$casos->__SET("codAssgn", $idAssgn);
		$casos->__SET("typeNote", $_POST["typeN"]);
		if(isset($_POST["note"])!=""){
			return $casos->NoteAssgn_model();
		}
	}

	if(isset($_GET["infothemes"])==1){
		$listTheme=$casos->ListThemes_model();
		echo json_encode($listTheme);
	}


	if(isset($_GET["NewTheme"])==1){
		$casos->__SET("theme", $_POST["theme"]);
		$casos->__SET("typeTheme", $_POST["type"]);
		$casos->NewTheme_model();
	}

 ?>