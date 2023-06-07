<?php
include_once"../dominio/usuario.php";
$usu=new usuario();
$q=$_GET['q'];
$n=$_GET['n'];
$a=$_GET['a'];
$t=$_GET['t'];
$cel=$_GET['cel'];
$d=$_GET['d'];
$ced=$_GET['ced'];
$nick=$_GET['nick'];
$r=$_GET['rol'];
$email=$_GET['email'];
$ins=$_GET['ins'];
$esp=$_GET['esp'];
$cat=$_GET['cat'];
$query="UPDATE REGBIB_USUARIO SET USU_NOMBRE='$n',USU_APELLIDO='$a',USU_TELEFONO='$t',USU_CELULAR='$cel',USU_DIRECCION='$d',USU_MAIL='$email',USU_CEDULA='$ced',USU_NICK='$nick', ROL_ID=$r, INS_ID=$ins, ESP_ID=$esp, CAT_ID=$cat WHERE USU_ID=$q AND USU_ESTADO='A'";
$resUsu=$usu->guardar_usuario($query);
if($query){
	print 'se guardo correctamente';
	}
	else{
		print $resUsu->ErrorMsg();
		}
?>