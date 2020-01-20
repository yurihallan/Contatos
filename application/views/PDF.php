<?php 

$this->load->library('fpdf_gen');


$pdf = new FPDF("L", "mm","A4");
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->setAuthor('Yuri Hallan');
$pdf->setTitle('PDF GERAL');

foreach($contato as $count) {
    $pdf->Cell(96,10,'NOME:'.$count->nome,1,1);
    $pdf->Cell(96,10,$count->email,1,1);
    $pdf->Cell(96,10,$count->cep,1,1);
    $pdf->Cell(96,10,$count->logradouro,1,1);
    $pdf->Cell(96,10,$count->numero,1,1);
    $pdf->Cell(96,10,utf8_decode($count->bairro),1,1);
    $pdf->Cell(96,10,$count->cidade,1,1);
    $pdf->Cell(96,10,$count->uf,1,1);
    $pdf->Ln();
    
    
}
    $pdf->setFont('Arial','',10);

$pdf->Output('FPDF.pdf','D')


?>