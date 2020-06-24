<?php 
	
	require_once "./ReportsGenerate.php";
	require_once "../../assets/fpdf/fpdf.php";

	$reports = new Reports();

	class Report extends FPDF
	{
		// Cabecera de página
		function Header()
		{
			date_default_timezone_set("America/Bogota");
			setlocale(LC_ALL, "es_CO");
			$month=strftime('%B');

		    // Arial bold 15
		    $this->Image('logo.jpg',30,7,150,20);
		    $this->SetFont('Arial','B',20);
		    // Movernos a la derecha
		    $this->Cell(40);
		    // Título
		    $this->Cell(100,50,'Casos registrados el mes de '.ucwords($month),0,1,'C');
		    $this->Ln(-3);
		    $this->SetFont('Arial','',15);
		    $this->Cell(95,10,'Cliente',0,0,'L',0);
		    $this->Cell(25,10,'Fecha',0,0,'L');
		    $this->Cell(40,10,'Asesor',0,0,'L');
		    $this->Cell(30,10,'Estado',0,1,'L');
		    $this->Ln(3);
		    // Salto de línea
		    
		}

		// Pie de página
		function Footer()
		{
		    // Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Número de página
		    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}
	$pdf = new Report();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	$state='';
	foreach ($reports->CasosMesActual() as $tblCases) {

			if($tblCases["Estado"] == NULL){
				$state='Registrado';
			}
			else if($tblCases["Estado"]==0){
				$state='Asignado';
			}else{
				$state='Finalizado';
			}

			// switch ($tblCases["Estado"]) {
			// 	case 0:
			// 		$state='Asignados';
			// 		break;
			// 	case 1:
			// 		$state='Finalizado';
			// 		break;	
				
			// 	default:
			// 		$state='Registrado';
			// 		break;
			// }

			$pdf->Cell(95,6,utf8_decode($tblCases["Nit"]." ".$tblCases["Cliente"]), 1,0,"L",0);
			$pdf->Cell(25,6,$tblCases["fecha"], 1,0,"L",0);
			$pdf->Cell(40,6,utf8_decode($tblCases["Nombre"]." ".$tblCases["Apellidos"]), 1,0,"L",0);
			$pdf->Cell(30,6,utf8_decode($state), 1,1,"L",0);

		}

	$pdf->Output();


 ?>
