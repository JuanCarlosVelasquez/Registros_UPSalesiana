<?php
include_once"../dominio/institucion.php";
$ins=new institucion();
$q=$_GET['q'];
$resins=$ins->lista_institucionesXid($q);
echo '<table width="848" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="2%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ID</font></td>
					<td width="46%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td width="46%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIRECCION</font></td>
					<td width="6%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESTADO</font></td>
				  </tr>';
  foreach($resins as $fila){
				  echo' <tr>
				<td><font color="#000000">'.$fila["INS_ID"].'</font></td>
				<td><font color="#000000">'.$fila["INS_NOMBRE"].'</font></td>
				<td><font color="#000000">'.$fila["INS_DIRECCION"].'</font></td>
				<td><font color="#000000">'.$fila["INS_ESTADO"].'</font></td>
				<td><span style="cursor:pointer;" onclick="EditarIns('.$fila["INS_ID"].');"><font color="#000000">Editar</font>
				</span><br><span style="cursor:pointer;" onclick="ConfirmarIns('.$fila["INS_ID"].');"><font color="#000000">Eliminar</font></span></td>
			  </tr>';
	  }
	  echo  '</table>';
?>