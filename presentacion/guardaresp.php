<?php
include_once"../dominio/especialidad.php";
$usu=new especialidad();
$q=$_GET['q'];
$n=$_GET['n'];
$query="UPDATE REGBIB_ESPECIALIDAD SET ESP_NOMBRE='$n' WHERE ESP_ID=$q";
$resUsu=$usu->guardarEspecialidad($query);
if($query){
	print 'se guardo correctamente';
	}
	else{
		print $resUsu->ErrorMsg();
		
		
		}
?>