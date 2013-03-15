<?php
	include("barcodes.php");
	class Card{
		function __construct($firstname="Renoire", $lastname="McStudentsen",
								$sid = "123", $bloodtype="Unknown",$dob="12-Jan-1999",
								$econtact1="017-922-088",$econtact2="092-094-843"){

			$this->firstname = $firstname;
			$this->lastname = $lastname;
			$this->sid = $sid;
			if($bloodtype != null || $bloodtype !="")
				$this->bloodtype = $bloodtype;
			$this->dob = $dob;
			$this->econtact1 = $econtact1;
			$this->econtact2 = $econtact2;

		}
		function getID(){
			return $this->sid;
		}

		function toString(){
			return("Firstname:\t\t".$this->firstname."\n"."Lastname:\t\t".$this->lastname."\n".
			"SID:\t\t\t".$this->sid."\n".
			"Bloodtype:\t\t".$this->bloodtype."\n".
			"DOB:\t\t\t".$this->dob."\n".
			"Emergency Contacts:\t".$this->econtact1."\n\t\t\t".$this->econtact2."\n");

		}
		function toHTML(){
			if(file_exists("StudentPhotos/$this->sid.JPG")) $photo="StudentPhotos/$this->sid.JPG";
			else $photo = "StudentPhotos/nophoto.JPG";
			return("
					<table style=\"width: 13.0cm;\"  >
					 <tr><td><img src = \"logo.jpg\"></td><td rowspan=\"2\" align = \"right\" style=\"width:2.2cm;\"><img src = \"$photo\" width=\"2cm\"></td></tr>
					 <tr><td><b style=\"font-size: x-large;\">$this->lastname, $this->firstname</b></td></tr>
							<b>Student ID: $this->sid</b><br>
							<i style=\"font-size:x-small\">expires: 10-10-10</i></td></tr>
					 <tr><td>DOB:</td> <td>$this->dob</td></tr>
					 <tr><td>Blood Type:</td><td>$this->bloodtype</td></tr>
					 <tr><td>Emergency Contacts/ទំនាក់ទំនងលេខ:</td><td>$this->econtact1</td></tr>
					 <tr><td rowspan=\"2\"></td><td>$this->econtact2</td></tr>
					 <tr></tr>

					 </table>

					");

		}

		function toRawHTML(){
			if(file_exists("StudentPhotos/$this->sid.JPG")) $photo="StudentPhotos/$this->sid.JPG";
			else $photo = "StudentPhotos/nophoto.JPG";
			$bc = new TCPDFBarcode("C128","C128");


			return("

					<div class = \"card\">
					    <div class = \"watermark\"><img class=\"watermarkimg\" src = \"img/ahback.png\"></div>
						<div class = \"studentpic\"><img class = \"studentimg\" src = \"$photo\"><div class =\"expires\">valid until: ".date("M Y",strtotime("+1 year"))."</div></div>
						<div class = \"schoolname\">Logos International School</div>
						<div class =\"tagline\">a ministry of Asian Hope</div>
						<div class = \"studentname\">$this->lastname, $this->firstname</div>
						<div class = \"sid\">Student ID: $this->sid</div>
						<div class = \"biographic\">
						<table>
							<tr><td>DOB</td><td align = \"right\">$this->dob</td></tr>
							<tr><td>Emergency Contacts<br/>
									ទំនាក់ទំនងលេខ</td>
								<td align =\right\"> $this->econtact1<br/>
									 $this->econtact2</td>
							</tr>
						</table>
						</div>
						<div class = \"barcode\">
						<img src = \"barcodes/$this->sid.png\">
						</div>


					</div>
					");

		}

	}

?>

