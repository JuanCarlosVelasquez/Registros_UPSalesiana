<?php
include_once"../dominio/especialidad.php";
$usu=new especialidad();
$q=$_GET['q'];
$query="UPDATE REGBIB_ESPECIALIDAD SET ESP_ESTADO='E' WHERE ESP_ID=$q";
$resUsu=$usu->guardarEspecialidad($query);
if($query){
	print 'Registro eliminado';
	}
	else{
		print $resUsu->ErrorMsg();
		}
?>