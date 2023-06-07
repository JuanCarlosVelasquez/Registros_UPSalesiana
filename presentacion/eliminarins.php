<?php
include_once"../dominio/institucion.php";
$ins=new institucion();
$q=$_GET['q'];
$query="UPDATE REGBIB_INSTITUCION SET INS_ESTADO='E' WHERE INS_ID=$q";
$resUsu=$ins->guardar_institucion($query);
if($query){
	print 'Registro eliminado';
	}
	else{
		print $resUsu->ErrorMsg();
		}
?>