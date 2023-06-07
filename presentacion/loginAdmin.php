<?php
require("../lib/template/header_inicio.php");
?>
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
     if($tiempo_transcurrido >= 30) {
     //si pasaron 10 minutos o mas
      session_destroy(); // destruyo la sesion
      header("Location: index.php"); //envio al usuario a la pag. de autenticacion
      //sino, actualizo la fecha de la sesion
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}

include "../dominio/usuario.php";
$usuario1=new usuario();
if(isset($_POST["btnIngresar"]))
{
	$usu=$_POST["txtUsuario"];
	$cla=$_POST["txtClave"];
	$usu_id=$_SESSION["idUsuario"];

	$res=$usuario1->verificarUsuario($usu,$cla,$usu_id);
	if($res==0)
	{
		echo "<script> alert('Nombre de Usuario o Contrasena Incorrecto')</script>";
	}
	else
	{
		$_SESSION["USUARIO"]=$usu;
		$_SESSION["last_access"]= date("Y-n-j H:i:s");
		$_SESSION["autentificado"]="SI";
		header("Location:menuInicial.php");		
	}
}
if(isset($_POST["btnRegistrar"]))
{
	$_SESSION["last_access"]= date("Y-n-j H:i:s");
	$_SESSION["autentificado"]="SI";
	header("Location:controlRegistroDetalle.php");		
}

?>

<div id="bienvenidada" align="center"><h1>Ingrese Usuario y  Clave</h1></div>
    <div>
    
    
    </div>
    
    <div id="iniciarSesion"><form id="form1" name="form1" method="post" action="">
  <table width="230" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
    <tr>
      <td colspan="2" bgcolor="#0088AD"><div align="center"><font size=4 color="#FFFFFF">LOGIN</font></div></td>
    </tr>	
    <tr>
      <td width="111" bgcolor="#0088AD"><font size=4 color="#FFFFFF">Usuario:</font></td>
      <td width="215"><label for="txtUsuario2"></label>
        <input type="text" name="txtUsuario" id="txtUsuario" /></td>
    </tr>
    <tr>
      <td width="111" bgcolor="#0088AD"><font size=4 color="#FFFFFF">Clave:</font></td>
      <td width="215"><label for="txtClave"></label>
        <input type="password" name="txtClave" id="txtClave" /></td>
    </tr>
    <tr>
	<td height="35" colspan="2"><div align="center">
       <input type="submit" name="btnRegistrar" id="btnRegistrar" value="Registrar" />
        <input type="submit" name="btnIngresar" id="btnIngresar" value="Ingresar" />
      </div></td>
    </tr>
  </table>
</form></div>

<?php
require("../lib/template/footer_inicio.php");
?>