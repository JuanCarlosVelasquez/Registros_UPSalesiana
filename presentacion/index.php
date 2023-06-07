<?php
require("../lib/template/header_inicio.php");
?>
<?php
if(!isset($_SESSION)){
	session_start();
	}
include_once"../dominio/usuario.php";
$_usua=new usuario();
if(isset($_POST["btnIngresar"]))
{
			$ced=$_POST["txtCedula"];
		if (strlen($ced) >= 10) 
		{
			$res=$_usua->verifivarUsuarioX_Cedula($ced);
			$datUsua=$_usua->lista_usuarioXcedula($ced);
			if($res==0)
				{
					$_SESSION["last_access"]= date("Y-n-j H:i:s");
					$_SESSION["autentificado"]="SI";
					echo '<script language = javascript>
					var respuesta = confirm(" Usuario no Registrado, porfavor Registrese Aqui")
					if(respuesta==true)
					{
					self.location = "registrarse.php"
					}
					else 
					{
					self.location = "index.php"
					}
					</script>';  	
		
				}
				else
				{
					foreach($datUsua as $fila)
						{
						$_SESSION["nick"]=$fila["USU_NICK"];
						$_SESSION["cedula"]=$fila["USU_CEDULA"];	
						$_SESSION["idUsuario"]=$fila["USU_ID"];
						$_SESSION["rol"]=$fila["ROL_ID"];
						$_SESSION["autentificado"]="SI";
						$_SESSION["last_access"]= date("Y-n-j H:i:s");
						}
						switch($_SESSION["rol"])
						{
				 		case 1: header("Location:loginAdmin.php"); break;
						case 2: header("Location:controlRegistroDetalle.php"); break;
						}
				}
			}
			else
			{
			echo "<script languaje='javascript'>alert('Ingrese una Cedula Correcta')</script>";
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
<h2>INGRESE SU IDENTIFICACION</h2>
<form name="form1" method="post" action="">
<p><input name="txtCedula" type="text" maxlength="10" size="30px" height="30px" onkeypress="javascript:return validarNro(event)"></p>
<p><input type="submit" name="btnIngresar" value="Ingresar"></p>
<a href="registrarse.php" class="blye-text-underline"><strong>Registrarse Ahora</strong></a>
<?php $_SESSION["last_access"]= date("Y-n-j H:i:s");
$_SESSION["autentificado"]="SI"; ?>
</form>
<?php
require("../lib/template/footer_inicio.php");
?>