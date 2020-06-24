<?php 
	
	require_once "./ReportsGenerate.php";
	require_once "../../assets/fpdf/fpdf.php";

	$reports = new Reports();

	class Report extends FPDF
	{
		function Header()
		{

			$this->Image('logo.jpg',30,7,150,20);
			$this->SetFont('Arial','B',20);
		    $this->Cell(40);
		    $this->Cell(100,50,'Casos por cliente',0,1,'C');
		    $this->Ln(-3);
		    $this->SetFont('Arial','',15);
		    $this->cell(10);
		    $this->Cell(40,10,'Nit',1,0,'L',0);
		    $this->Cell(80,10,'Cliente',1,0,'L');
		    $this->Cell(40,10,'N. Casos',1,1,'L');
		    $this->Ln(0);
		    
		}

		function Footer()
		{
			date_default_timezone_set("America/Bogota");
            $fecha = date('Y-m-d H:i:s');
		    // Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    // Arial italic 8
		    $this->SetFont('Arial','I',8);
		    // Número de página
		    $this->cell(20, 10, $fecha,0,0,'C');
		    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}
	$pdf = new Report();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	foreach ($reports->ListaNCasos() as $tblCases) {
			$pdf->cell(10);
			$pdf->Cell(40, 7,utf8_decode($tblCases["Nit"]), 1,0,"L",0);
			$pdf->Cell(80, 7,utf8_decode($tblCases["Cliente"]), 1,0,"L",0);
			$pdf->Cell(40, 7,$tblCases["n_casos"], 1,1,"C",0);

		}

	$pdf->Output();


 ?>
