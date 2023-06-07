<?php
include_once"../dominio/institucion.php";
$ins=new institucion();
$q=$_GET['q'];
$n=$_GET['n'];
$d=$_GET['d'];
$query="UPDATE REGBIB_INSTITUCION SET INS_NOMBRE='$n', INS_DIRECCION='$d' WHERE INS_ID=$q";
$resins=$ins->guardar_institucion($query);
if($query){
	print 'se guardo correctamente';
	}
	else{
		print $resins->ErrorMsg();
		
		
		}
?>