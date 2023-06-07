<?php
include_once"../dominio/servicio.php";
$usu=new servicio();
$q=$_GET['q'];
$resUsu=$usu->lista_serviciosXid($q);
echo '<table width="548" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="60" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ID</font></td>
					<td width="360" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td width="51" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESTADO</font></td>
				  </tr>';
  foreach($resUsu as $fila){
				  echo' <tr>
				<td><input type="text" class="caja2" id="id" readonly="true" value="'.$fila["SER_ID"].'"/></td>
				<td><input type="text" class="caja2" id="nombre" size="60" value="'.$fila["SER_NOMBRE"].'"/></td>
				<td><input type="text" class="caja2" id="estado" readonly="true" value="'.$fila["SER_ESTADO"].'"/></td>
				</tr>';}
echo  '</table>';
echo '<div align="center"><input name="guardar" type="button" value="Guardar" onclick="guardarEdicionSrv('.$fila["SER_ID"].');"/></div>';
?>