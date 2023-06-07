<?php
include_once"../dominio/usuario.php";
$q=$_GET['q'];
$usu=new usuario();
$res=$usu->listaUsuarioXnombre($q);
foreach($res as $fila)
{
	echo $fila3["U.USU_NOMBRE"].'<br>';
}
?>