<?php 
	
	// if($_POST["slc_typeReport"]=="actual"){
		
	// 	exit;
	// }else if($_POST["slc_typeReport"]=="rango"){
		
	// 	exit;
	// }else if($_POST["slc_typeReport"]=="agrupado"){
		
	// 	exit;
	// }else{
		
	// 	exit;
	// }

	switch ($_POST["slc_typeReport"]) {
		case 'actual':
			header("location: ./Casos_Mes_Actual.php");
			break;

		case 'rango':
			header("location: ./Casos_Por_Rango.php?ini=".$_POST["slc_mesInicial"]."&fin=".$_POST["slc_mesFinal"]);
			break;

		case 'agrupado':
			header("location: ./Numero_De_Casos.php");
			break;	

		case 'asesor':
			header("location: ./Casos_Por_Asesor.php");
			break;	
		
		default:
			header("location: ../../controller/Casos.php");
			break;
	}

 ?>