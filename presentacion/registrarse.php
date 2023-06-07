<?php
require("../lib/template/header_inicio.php");
?>
<?php
if(!isset($_SESSION)){
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
     if($tiempo_transcurrido >= 180) {
     //si pasaron 10 minutos o mas
      session_destroy(); // destruyo la sesion
      header("Location: index.php"); //envio al usuario a la pag. de autenticacion
      //sino, actualizo la fecha de la sesion
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}
include_once "../dominio/institucion.php";
include_once "../dominio/categoria.php";
include_once "../dominio/usuario.php";
include_once "../dominio/especialidad.php";

$institucio=new institucion();
$categoria=new categoria();
$usu=new usuario();
$esp=new especialidad();
if(isset($_POST["btnCrear"]))
{
	$usuNom=$_POST["nombres"];
	$usuApe=$_POST["apellidos"];
	$usuTel=$_POST["telefonoF"];
	$usuCel=$_POST["celular"];
	$usudir=$_POST["direccion"];
	$usuced=$_POST["cedula"];
	$codIns=$_POST["institucion"];
	$codCat=$_POST["categoria"];
	$codEsp=$_POST["especialidad"];
	$email=$_POST["email"];
if (($usuNom=="") or ($usuApe=="") or ($usudir=="") or ($usuced=="") or ($codIns=="") or ($codCat=="") or ($codEsp=="") or ($email==""))
{
echo '<script language = javascript>
		alert("Porfavor ingrese todos los Campos Obligatorios (*)")
		</script>'; 
}  
else
{ //hay  campo; 
	$usu->guardar_usuario("INSERT INTO REGBIB_USUARIO(INS_ID,CAT_ID,ESP_ID,USU_NOMBRE,USU_APELLIDO,USU_TELEFONO,
USU_CELULAR,USU_DIRECCION,USU_ESTADO,USU_CEDULA,ROL_ID,USU_MAIL)VALUES($codIns,
$codCat,$codEsp,'$usuNom','$usuApe','$usuTel','$usuCel','$usudir','A','$usuced',2, '$email')");
	header("location:index.php");
} 
}
?>
<script language="javascript">
function validarNro(e) {
var key;
if(window.event) // IE
{
key = e.keyCode;
}
else if(e.which) // Netscape/Firefox/Opera
{
key = e.which;
}
if (key < 48 || key > 57)
{
if(key == 46 || key == 8 ) // Detectar . (punto) y backspace (retroceso)
{ return true; } else { return false; }
}
return true;
}
</script>
<?php
if (isset($_REQUEST['cedula'])) {
$cedula = $_REQUEST['cedula'];
$control = $_REQUEST['cedula'];
} else {
$cedula = "";
$control = "";
}
if (isset($_REQUEST['nombres'])) {
$_REQUEST['nombres'] = $_REQUEST['nombres'];
} else {
$_REQUEST['nombres'] = "";
}
if (isset($_REQUEST['apellidos'])) {
$_REQUEST['apellidos'] = $_REQUEST['apellidos'];
} else {
$_REQUEST['apellidos'] = "";
}
if (isset($_REQUEST['telefonoF'])) {
$_REQUEST['telefonoF'] = $_REQUEST['telefonoF'];
} else {
$_REQUEST['telefonoF'] = "";
}
if (isset($_REQUEST['celular'])) {
$_REQUEST['celular'] = $_REQUEST['celular'];
} else {
$_REQUEST['celular'] = "";
}
if (isset($_REQUEST['direccion'])) {
$_REQUEST['direccion'] = $_REQUEST['direccion'];
} else {
$_REQUEST['direccion'] = "";
}
if (isset($_REQUEST['email'])) {
$_REQUEST['email'] = $_REQUEST['email'];
} else {
$_REQUEST['email'] = "";
}
?>
<?php
include("../lib/functions/ValidarIdentificacion.php");
include_once"../dominio/usuario.php";
if (isset($_REQUEST['cedula'])) {
$cedula = $_REQUEST['cedula'];
} else {
$cedula = "";
}
if ($cedula!=""){
$auditoria= new ValidarIdentificacion();
$cedula=$auditoria->validarCedula($cedula);
if(($cedula) != 1){
		echo '<script language = javascript>
		alert("Cedula Incorrecta")
		</script>';
		$control="";
}
else {
$control = $_REQUEST['cedula'];
$usucons=new usuario();
$datosusu=$usucons->comprueba_usuario($control);
	foreach($datosusu as $fila4)
					{
		$idUsuario=$fila4["TOTAL"];
					}
if (($idUsuario) > 0) {
		echo '<script language = javascript>
		alert("Usuario ya existente en la Base del Sistema como Habilitado")
		</script>';
		$control="";
					}

	}
}
?>
<table width="848" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<form name="user_form" action="registrarse.php" method="post">
<tr>
<td width="20%" bgcolor="#0088AD"><font size=2 color="#FFFFFF"># C&eacute;dula: *</font></td>
<td width="60%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">Nombres: *</font></td>
<td width="60%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">Apellidos: *</font></td>
</tr>
<tr>
<td width="20%"><input type="text" size=13 name="cedula" value="<?php echo $control; ?>" maxlength="10" onkeypress="javascript:return validarNro(event)" onchange="this.form.submit()"></td>
<td width="60%"><input type="text" size=50 name="nombres" value="<?php echo $_REQUEST['nombres']; ?>" maxlength="100"></td>
<td width="60%"><input type="text" size=50 name="apellidos" value="<?php echo $_REQUEST['apellidos']; ?>" ></td>
</tr>
</table><br>
<table width="848" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">Tel&eacute;fono:</font></td>
<td width="15%" bgcolor="#0088AD"><font size=2 color="#FFFFFF"># Celular:</font></td>
<td width="70%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">Direcci&oacute;n: *</font></td>
</tr>
<tr>
<td width="15%"><input type="text" size=10 name="telefonoF" value="<?php echo $_REQUEST['telefonoF']; ?>" maxlength="10" onkeypress="javascript:return validarNro(event)"></td>
<td width="15%"><input type="text" size=10 name="celular" value="<?php echo $_REQUEST['celular']; ?>" maxlength="10" maxlength="100"  onkeypress="javascript:return validarNro(event)"></td>
<td width="70%"><input type="text" size=93 name="direccion" value="<?php echo $_REQUEST['direccion']; ?>" maxlength="100"></td>
</tr>
</table><br>
<table width="848" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">Dir e-mail: *</font></td>
<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">Instituci&oacute;n: *</font></td>
<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">Categoria *</font></td>
</tr>
<tr>
<td><input type="text" name="email" value="<?php echo $_REQUEST['email']; ?>" size="41" maxlength="100"></td>
<td><select name="institucion" id="institucion">
 <?php $datIns=$institucio->lista_institucion();
 foreach($datIns as $fila){
	$c=$fila["INS_ID"];
	$n=$fila["INS_NOMBRE"];
	 echo "<option value=$c>$n</option>";
	 }
 ?>
</select> 
</td>
<td><select name="categoria" id="categoria"><br>
<?php $datCat=$categoria->lista_categoria();
foreach($datCat as $fila2){
	$c2=$fila2["CAT_ID"];
	$n2=$fila2["CAT_NOMBRE"];
	echo "<option value=$c2>$n2</option>";
	}
?>
</select>
</td>
</tr>
</table><br>
<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">Especialidad: *</font></td>
</tr>
<tr>
<td>
<select name="especialidad" id="especialidad">
<?php $datosEsp=$esp->lista_especialidad();
foreach($datosEsp as $fila3){
	$c3=$fila3["ESP_ID"];
	$n3=$fila3["ESP_NOMBRE"];
	echo "<option value=$c3>$n3</option>";
	}
?>
</select>
</td>
</tr>
</table><br>
<table width="100" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
<td>
<input type="submit" name="btnCrear" id="btnCrear" value="Crear Usuario" />
</form>
</td>
</tr>
</table>
<?php
require("../lib/template/footer_inicio.php");
?>