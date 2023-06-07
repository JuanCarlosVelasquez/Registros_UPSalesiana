<?php
include_once"../dominio/especialidad.php";
$esp=new especialidad();
$q=$_GET['q'];
$resesp=$esp->lista_especialidadXid($q);
echo '<table width="548" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="60" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ID</font></td>
					<td width="360" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRES</font></td>
					<td width="51" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESTADO</font></td>
				  </tr>';
  foreach($resesp as $fila){
	  echo' <tr>
			<td><input type="text" class="caja2" id="id" size="1" readonly="true" value="'.$fila["ESP_ID"].'"/></td>
			<td><input type="text" class="caja2" id="nombre" size="60" value="'.$fila["ESP_NOMBRE"].'"/></td>
			<td><input type="text" class="caja2" id="estado" size="4" readonly="true" value="'.$fila["ESP_ESTADO"].'"/></td>
				</tr>';}
echo  '</table>';
echo '<div align="center"><input name="guardar" type="button" value="Guardar" onclick="guardarEdicionEsp('.$fila["ESP_ID"].');"/></div>';
?>