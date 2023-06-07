<?php
include_once"../dominio/servicio.php";
$usu=new servicio();
$q=$_GET['q'];
$n=$_GET['n'];
$query="UPDATE REGBIB_SERVICIO SET SER_NOMBRE='$n' WHERE SER_ID=$q";
$resUsu=$usu->guardar_servicio($query);
if($query){
	print 'se guardo correctamente';
	}
	else{
		print $resUsu->ErrorMsg();
		
		
		}
?>