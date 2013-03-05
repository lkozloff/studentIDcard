<?php
include "card.php";
require_once "tcpdf.php";
require_once "config/lang/eng.php";

	
$fh = fopen("cards.csv",'r');
$c = 0;

//load data set
while(($data = fgetcsv($fh))!=false){

	$sid = $data[0];
	$dob = $data[1];
	$fname = $data[2];
	$sname = $data[3];
	$e1 = $data[4];
	$e2 = $data[5];
	$bloodtype= "unknown";
	
	$cardarray[$c] = new Card($fname, $sname, $sid, $bloodtype, $dob, $e1, $e2);
	$c++;
}
fclose($fh);

	//*** PDF Setup ****//
	$pdf = new TCPDF('P', 'mm' , 'A4', true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Lyle Kozloff');
	$pdf->SetTitle('Student ID Card');
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	
	//set margins
	$pdf->SetMargins(2,2,2);
	//set auto page breaks
	$pdf->SetAutoPageBreak(false);
	
	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	//set some language-dependent strings
	$pdf->setLanguageArray($l);
	
	// define barcode style
	$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => false,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => false,
			'font' => 'helvetica',
			'fontsize' => 12,
			'stretchtext' => 0
	);
	
	//*** END PDF Setup *****//
	
	
	$KhmerOS = $pdf->addTTFfont('fonts/KhmerOS.ttf', 'TrueTypeUnicode', '', 32);
	$pdf->SetFont('KhmerOS', '', 9);
	
	//$pdf->Cell(95,60,'95x60',true,1);
	
	//header
	//$pdf->Image('logo.jpg', 2, 2, 75, 0, 'JPG', '', '', false, 300, '', false, false, false, false, false, false);
	//Student Picture
	//$pdf->Image('test.jpg', 77, 3, 20, 25, 'JPG', '', '', false, 300, '', false, false, false, false, false, false);
	//Student ID
	//$pdf->write1DBarcode("123", 'C128', -7, 45, '', 20, 1, $style, 'N');
	//$pdf->writeHTML($testcard->toHTML());
	
	$yoffset=58;
	$xoffset = 98;
	$i = 0;
	$j = 0;
	$cols = 2;
	$rows = 5;
	
	$pdf->AddPage();
	
	foreach($cardarray as $testcard){
		
		$pdf->writeHTMLCell(85,55,14+$i*$xoffset,5+$j*$yoffset,$testcard->toHTML(),'1',1);
		$pdf->write1DBarcode($testcard->getID(), 'C128', 12+$i*$xoffset, 46+$j*$yoffset, '', 15, 0.4, $style, 'N');
		
		//increment positions
		$i++; $j++;
		$i %= $cols; $j %= $rows;
		
		if($i==0 && $j==0){
			$pdf->AddPage(); //we've reached the end of a page!
			$pdf = printBacks($pdf, $cols, $rows, $xoffset, $yoffset);
			$pdf->AddPage();
		}
		
	}
	$pdf->Output('example_005.pdf', 'I');
	
	function printBacks($pdf, $cols, $rows, $xoffset, $yoffset){
		
		$back = "
				<br><br>
				<table>
				
				<tr><td>ម្ចាស់កាតនេះ</td><td style = \"font-size: small\">The bearer of this card is a student of Logos International School, located in Phnom Penh, Cambodia and is entitled to all rights befitting such a station.  

This card is the property of Logos International School and shall be returned by the student to the office if so requested.

IN THE EVENT OF AN EMERGENCY, PLEASE USE THE EMERGENCY CONTACT NUMBERS LISTED ON THE FRONT OF THE CARD</td></tr>
				
				</table>
				";
		
		for($j=0; $j<$rows;$j++){
			for($i=0; $i<$cols; $i++){
				
				$pdf->writeHTMLCell(85,55,14+$i*$xoffset,5+$j*$yoffset,$back,'1',1);
				
			}
		}
		return $pdf;
	}
?>