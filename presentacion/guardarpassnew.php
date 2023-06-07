<?php
include_once"../dominio/usuario.php";
$usu=new usuario();
$q=$_GET['q'];
$p2=$_GET['p2'];
$p3=$_GET['p3'];
$query="UPDATE REGBIB_USUARIO SET USU_PASSWORD=ENCRYPTBYPASSPHRASE('UPS','$p2')
WHERE USU_CEDULA=(right('000000000'+ltrim(rtrim('$q')),10)) AND
USU_ESTADO='A' AND
ROL_ID=1";
$resUsu=$usu->guardar_usuario($query);
if($query){
	print 'se guardo correctamente';
	}
	else{
		print $resUsu->ErrorMsg();
		}
?>