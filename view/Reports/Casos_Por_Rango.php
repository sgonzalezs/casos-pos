<?php 
	
	require_once "./ReportsGenerate.php";
	require_once "../../assets/fpdf/fpdf.php";

	$reports = new Reports();
	$reports->__SET("monthIni", $_GET["ini"]);
	$reports->__SET("monthFin", $_GET["fin"]);

	class Report extends FPDF
	{

		function Header()
		{
			$this->Image('logo.jpg',30,7,150,20);
			$this->SetFont('Arial','B',20);
		    $this->Cell(40);
		    $this->Cell(100,50,'Lista de Casos ',0,1,'C');
		    $this->Ln(-3);
		    $this->SetFont('Arial','',15);
		    $this->Cell(90,10,'Cliente',1,0,'L',0);
		    $this->Cell(40,10,'Fecha',1,0,'L');
		    $this->Cell(40,10,'Asesor',1,0,'L');
		    $this->Cell(20,10,'Estado',1,1,'L');
		    $this->Ln(0);
		    
		}

		function Footer()
		{
		    $this->SetY(-15);
		    $this->SetFont('Arial','I',8);
		    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}


	$pdf = new Report();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);

	$state='';
	foreach ($reports->CasosPorRango() as $tblCases) {

			if($tblCases["Estado"] == NULL){
				$state='Registrado';
			}
			else if($tblCases["Estado"]==0){
				$state='Asignado';
			}else{
				$state='Finalizado';
			}
			$data=$tblCases["Nit"]." ".$tblCases["Cliente"];

			// $pdf->MultiCell(90,7,utf8_decode($data),1,"L",0);
			$pdf->Cell(90,7,utf8_decode($data),1,0,"L",0);
			$pdf->Cell(40,7,$tblCases["fecha"], 1,0,"L",0);				
			$pdf->Cell(40,7,utf8_decode($tblCases["Nombre"]." ".$tblCases["Apellidos"]), 1,0,"L",0);
			$pdf->Cell(20,7,utf8_decode($state), 1,1,"L",0);				
		}

	$pdf->Output();

 ?>
