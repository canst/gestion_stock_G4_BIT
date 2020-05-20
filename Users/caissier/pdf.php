<?php 
require '../../config/fpdf.php';
require ('../../config/fonctions.php');
//$id = $_GET['ID'];
/////////
$panner1 = $bdd->query('SELECT * FROM gs.orders o, gs.products p, gs.content c WHERE o.ID_COMMANDE = c.ID_COMMANDE AND c.ID_PRODUCT = p.ID_PRODUCT AND o.ID_COMMANDE = 15');
$panners = $panner1->fetchAll(PDO::FETCH_OBJ);
//var_dump($panners);
//$panner->execute(array($id));
/////////
 class Mypdf extends FPDF
 {
 	function header()
 	{
 		//$this->Image('logo.pdf', 10, 6);
 		$this->SetFont('Arial', 'B', 14);
 		$this->Cell(276, 10, 'FACTURE','0','0', 'C');
 		$this->Ln();
 		$this->SetFont('Times','',9);
 		$this->Cell(276, 5, 'Entreprise ...',0,0, 'C');
 	}
 	function footer()
 	{
 		$this->SetXY(-10, -160);
 		$this->SetFont('Arial','', '8');
 		$this->Cell(0,10,'Page'. $this->PageNo(),0,0,'C');
 	}
 	function headerTable()
 	{
 		$this->SetXY(-10, -160);
 		$this->SetFont('Times','B',12);
 		$this->Cell(-70,10,'PRIX UNITAIRE',1,0,'C');
 		$this->Cell(-70,10,'QUANTITE',1,0,'C');
 		$this->Cell(-70,10,'FORMAT',1,0,'C');
 		$this->Cell(-70,10,'ARTICLE',1,0,'C');
 		$this->Ln();
 	}
 	function viewTable($panners)
 	{
 		$this->SetFont('Times','B',12);
 		$this->SetXY(-10, -150);
 		$montant = null;
 		
 		foreach ($panners as $panner)
 		{
 		$this->Cell(-70,10,'$panner->PRODUCT_NAME',1,0,'C');
 		$this->Cell(-70,10,'$panner->FORMAT',1,0,'C');
 		$this->Cell(-70,10,'$panner->QUANTITY',1,0,'C');
 		$this->Cell(-70,10,'$panner->PRICE',1,0,'C');
 		$montant +=$panner->QUANTITY*$panner->PRICE*(1-$panner->REDUCTION_RATE/100);
 		}

 		/*$this->Cell(276, 10, 'MONTANT TOTAL :$montant','0','0', 'C');
 		$this->Cell(276, 10, 'SOMME PAYEE :$panner->PAID','0','0', 'C');
 		$this->Cell(276, 10, 'RESTE A PAYER PAYEE :$montant - $panner->PAID','0','0', 'C');*/
 	}


 }

 $pdf = new Mypdf();
 $pdf->AliasNbPages();
 $pdf->AddPage('L','A4',0);
 $pdf->headerTable();
 $pdf->viewTable($panners);
 $pdf->Output();

























 ?>