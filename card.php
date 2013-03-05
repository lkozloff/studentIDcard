<?php

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
				<br><br>
					<table style=\"width: 12.75cm;\"  > 
					 <tr><td><img src = \"logo.jpg\"></td><td rowspan=\"2\" align = \"right\" style=\"width:2.2cm;\"><img src = \"$photo\" width=\"2cm\"></td></tr>
					 <tr><td><b style=\"font-size: x-large;\">$this->lastname, $this->firstname</b><br>
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
		
	}

?>

