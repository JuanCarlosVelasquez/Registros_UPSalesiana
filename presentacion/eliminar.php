<?php
include_once"../dominio/usuario.php";
$usu=new usuario();
$q=$_GET['q'];
$query="UPDATE REGBIB_USUARIO SET USU_ESTADO='E' WHERE USU_ID=$q";
$resUsu=$usu->guardar_usuario($query);
if($query){
	print 'Registro eliminado';
	}
	else{
		print $resUsu->ErrorMsg();
		}
?>