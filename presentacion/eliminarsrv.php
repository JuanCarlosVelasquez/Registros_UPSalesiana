<?php
include_once"../dominio/servicio.php";
$usu=new servicio();
$q=$_GET['q'];
$query="UPDATE REGBIB_SERVICIO SET SER_ESTADO='E' WHERE SER_ID=$q";
$resUsu=$usu->guardar_servicio($query);
if($query){
	print 'Registro eliminado';
	}
	else{
		print $resUsu->ErrorMsg();
		}
?>