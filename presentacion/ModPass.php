<?php
include_once"../dominio/usuario.php";
$usu=new usuario();
$q=$_GET['q'];
//$q=1;
$resUsu=$usu->lista_usuarioxIdUsuariopass($q);
echo '<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
				  	<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CEDULA</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">APELLIDO</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">NICKER</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">PASSWORD ACTUAL</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">PASSWORD NUEVO</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CONFIRMAR PASSWORD</font></td>
				  </tr>';
  foreach($resUsu as $fila){
				  echo' <tr>
				<td><font color="#000000">'.$fila["USU_CEDULA"].'</font></td>
				<td><font color="#000000">'.$fila["USU_NOMBRE"].'</font></td>
				<td><font color="#000000">'.$fila["USU_APELLIDO"].'</font></td>
				<td><font color="#000000">'.$fila["USU_NICK"].'</font></td>
				<td><input type="password" name="pass1" id="pass1" value=""/></td>
				<td><input type="password" name="pass2" id="pass2" value=""/></td>
				<td><input type="password" name="pass3" id="pass3" value=""/></td>
				<td><input type="hidden" name="pass0" id="pass0" value="'.$fila["USU_PASS"].'"/></td>
				<td>'.$j="";
				if (isset($_REQUEST['pass0'])) {
				$_REQUEST['pass0'] = $_REQUEST['pass0'];
				} else {
				$_REQUEST['pass0'] = "";
				}
				if (isset($_REQUEST['pass1'])) {
				$_REQUEST['pass1'] = $_REQUEST['pass1'];
				} else {
				$_REQUEST['pass1'] = "";
				}
				if (isset($_REQUEST['pass2'])) {
				$_REQUEST['pass2'] = $_REQUEST['pass2'];
				} else {
				$_REQUEST['pass2'] = "";
				}
				if (isset($_REQUEST['pass3'])) {
				$_REQUEST['pass3'] = $_REQUEST['pass3'];
				} else {
				$_REQUEST['pass3'] = "";
				} echo '
				<span style="cursor:pointer;" onclick="Validarpass('.$fila["USU_CEDULA"].');"><font color="#000000">Validar</font></span></td></tr>';
	  }
	  echo  '</table>';
?>