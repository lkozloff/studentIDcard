<html>
<head>
<meta charset="UTF-8" />
<style style="text/css">
<!--
@page { size:86mm 54mm; margin: 0cm }
table{

	padding: 0cm;
	#border:solid black 1px;
	border-collapse: collapse;

}

tr,td{
	font-size: 8pt;
	#border:solid black 1px;
	padding-right: 3mm;
}

.schoolname{
	font-family: serif;
	font-size: 12pt;
	font-weight: bold;

}

.tagline{
	font-family: serif;
	font-size: 6pt;
	margin-bottom: 2mm;

}
.studentname{

	font-size: 14pt;
	font-weight: bold;
}
.sid{
	font-size: 10pt;
	margin-bottom: 5mm;
}
.expires{
	color: darkred;
	font-size: 6pt;
	margin: 1mm;
	text-align: center;
}
.card{
	font-family: sans;
	width: 86mm;
	height: 54mm;

}
.studentpic{
	float:right;
	position: relative;
	top: -2mm;
}
.barcode{

}
.bcimg{
	width: 40mm;
	position: relative;
	top: -17mm;
}
.biographic{
	margin-bottom: 5mm;
}

.watermark{
	z-index:-1;
	position: absolute;
}
.watermarkimg{
	height: 54mm;
}
.studentimg{
	width: 2.5cm;
}
-->
</style>
</head>
<body>
<?php
include "card.php";
$fh = fopen("cards_full.csv",'r');
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

foreach($cardarray as $testcard){

	print($testcard->toRawHTML());
	/*print("
		<img style =\"width: 86mm\" src = \"img/cardback.png\">
        ");*/
}
?>
</body>
</html>

