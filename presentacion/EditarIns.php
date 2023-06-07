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
				<td width="2%"><input type="text" id="id" size=4 readonly="true" value="'.$fila["INS_ID"].'"/></td>
				<td width="46%"><input type="text" id="nombre" size=50 value="'.$fila["INS_NOMBRE"].'"/></td>
				<td width="46%"><input type="text" id="direccion" size=50 value="'.$fila["INS_DIRECCION"].'"/></td>
				<td width="6%"><input type="text" id="estado" readonly="true" font size=1 value="'.$fila["INS_ESTADO"].'"/></td>
				</tr>';}
echo  '</table>';
echo '<div align="center"><input name="guardar" type="button" value="Guardar" onclick="guardarEdicionIns('.$fila["INS_ID"].');"/></div>';
?>