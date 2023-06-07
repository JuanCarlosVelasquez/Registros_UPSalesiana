<?php
include_once"../dominio/usuario.php";
$usu=new usuario();

$q=$_GET['q'];
$resUsu=$usu->listaUsuarioXnombre($q);
echo '<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
				  	<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CEDULA</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">APELLIDO</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">TELEFONO</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CELULAR</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIRECCION</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">E-MAIL</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">NICK</font></td>
				  </tr>';
  foreach($resUsu as $fila){
				  echo' <tr>
				<td><font color="#000000">'.$fila["USU_CEDULA"].'</font></td>
				<td><font color="#000000">'.$fila["USU_NOMBRE"].'</font></td>
				<td><font color="#000000">'.$fila["USU_APELLIDO"].'</font></td>
				<td><font color="#000000">'.$fila["USU_TELEFONO"].'</font></td>
				<td><font color="#000000">'.$fila["USU_CELULAR"].'</font></td>
				<td><font color="#000000">'.$fila["USU_DIRECCION"].'</font></td>
				<td><font color="#000000">'.$fila["USU_MAIL"].'</font></td>
				<td><font color="#000000">'.$fila["USU_NICK"].'</font></td>
				<td><span style="cursor:pointer;" onclick="Editar('.$fila["USU_ID"].');"><font color="#000000">Editar</font></span>
				<br>
				<span style="cursor:pointer;" onclick="Confirmar('.$fila["USU_ID"].');"><font color="#000000">Eliminar</font></span>
				<br>
				'.$j="";
				$r=$fila["ROL_ID"];
  				$p=$fila["USU_PASSWORD"];
                $n=$fila["USU_NICK"];
  if ($r==1 && $n!="" && $p!=""):echo '<span style="cursor:pointer;" onclick="Mod_Pass('.$fila["USU_ID"].');"><font color="#000000">Mod_Pass</font></span>';
  elseif ($r==1 && $n!="" && $p==""):echo '<span style="cursor:pointer;" onclick="New_Pass('.$fila["USU_ID"].');"><font color="#000000">New_Pass</font></span>';
  else: echo '';
  endif;
  				echo'</td></tr>';
	  }
	  echo  '</table>';
?>