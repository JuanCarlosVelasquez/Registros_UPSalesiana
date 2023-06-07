<?php
if (!isset($_SESSION))
    {
    	session_start();
    }
if ($_SESSION["autentificado"] != "SI") {
    //si no esta logueado lo envio a la pagina de autentificacion
    header("Location: index.php");
} else {
    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["last_access"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= 600) {
     //si pasaron 10 minutos o mas
      session_destroy(); // destruyo la sesion
      header("Location: index.php"); //envio al usuario a la pag. de autenticacion
      //sino, actualizo la fecha de la sesion
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}
?>
<?php
require("../lib/template/header_inicio_adm_ret.php");
?>
<?php
include_once "../dominio/servicio.php";
$servicio=new servicio();
if(isset($_POST["btnCrear"]))
{
	$srvNom=$_POST["nombre"];
	if ($srvNom != ''){
		$servicio->guardar_servicio("INSERT INTO REGBIB_SERVICIO (SER_NOMBRE, SER_ESTADO) VALUES ('$srvNom', 'A')");
		$_POST["nombre"]='';
		$srvNom='';
		header("Location: buscarSrv.php");
	}
}
?>

<form name="srv_form" action="" method="POST">
<font size=4 color="#FFFFFF">Nuevo Tipo Ingreso:</font>
<input type="text" name="nombre" maxlength="100" size="60"/>
<br>
<br>
<input type="submit" name="btnCrear" id="btnCrear" value="Crear Servicio" />
</form>
<br>
<br>
<?php
include_once"../dominio/servicio.php";
$usu=new servicio();
$resUsu=$usu->lista_servicios();
echo '<table width="548" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="2%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ID</font></td>
					<td width="90%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td width="8$" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESTADO</font></td>
				  </tr>';
  foreach($resUsu as $fila){
				  echo' <tr>
				<td><font color="#000000">'.$fila["SER_ID"].'</font></td>
				<td><font color="#000000">'.$fila["SER_NOMBRE"].'</font></td>
				<td><font color="#000000">'.$fila["SER_ESTADO"].'</font></td>
				</tr>';}
echo  '</table>';
?>

<style type="text/css">
.input {
	float: center;
	width: 100%;
}
.caja {
	width: 400px;
}
.resultados {
	float: center;
	min-height:100px;
	min-width:300px;
	border: 1px dashed #FFF;
}
</style>
<br>
<div align="center"><h2>Gestionar Tipo Ingreso</h2></div>
<br>
<script language="javascript" type="text/javascript" src="ajax.js"></script>
<div class="input">
<div align="center">
<font color="#FFFFFF">Ingrese ID :</font>
<input type="text" size="40" class="caja" id="texto" onkeyup="BuscarSrv();"/>
</div>
<div class="resultados" id="resultados">
</div>
</div>
<?php
require("../lib/template/footer_inicio.php");
?>