<?php
require('fpdf.php');
$nombre = $_POST['Nombre'];

class PDF extends FPDF{
	function Header(){
		$this->Image('https://seeklogo.com/images/G/GEARS_of_WAR-logo-FCF3196963-seeklogo.com.png',10,6,30);
		$this->SetFont('Arial','B',15);
		$this->Cell(90);
		$this->Cell(30,10,'Ventas por Vendedor',0,0,'C');
		$this->Ln(30);
	}

	function Footer(){
		$this->SetY(-10);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,'Pagina '.$this->PageNo());
	}
}
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->Cell(40);
$pdf->Cell(40,5,'nombre',1,0,'C',1);
$pdf->Cell(40,5,'costo',1,0,'C',1);
$pdf->Cell(40,5,'producto',1,1,'C',1);

$pdf->SetFont('Times','',12);

$con=mysqli_connect("localhost","id5523351_radik","123456789","id5523351_tutorial");
if($con===false){
    die("error: no se a podido conectar".mysqli_connect_error);
}
else{
$consulta=mysqli_query($con,"SELECT * FROM ventas WHERE nombre LIKE '%$nombre%'");

while ($resultado=mysqli_fetch_array($consulta)) {
    $pdf->Cell(40);
	$pdf->Cell(40,5,$resultado['nombre'],1,0,'C');
	$pdf->Cell(40,5,$resultado['costo'],1,0,'C');
	$pdf->Cell(40,5,$resultado['producto'],1,1,'C');
}
$pdf->Output();
    
}
?>