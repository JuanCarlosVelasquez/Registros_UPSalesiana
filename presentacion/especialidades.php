<?php
include_once"../dominio/especialidad.php";
$esp=new especialidad();
$q=$_GET['q'];
$resesp=$esp->lista_especialidadXid($q);
echo '<table width="548" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td width="2%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ID</font></td>
					<td width="90%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td width="8%" bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESTADO</font></td>
				  </tr>';
  foreach($resesp as $fila){
				  echo' <tr>
				<td><font color="#000000">'.$fila["ESP_ID"].'</font></td>
				<td><font color="#000000">'.$fila["ESP_NOMBRE"].'</font></td>
				<td><font color="#000000">'.$fila["ESP_ESTADO"].'</font></td>
				<td><span style="cursor:pointer;" onclick="EditarEsp('.$fila["ESP_ID"].');"><font color="#000000">Editar</font>
				</span><br><span style="cursor:pointer;" onclick="ConfirmarEsp('.$fila["ESP_ID"].');"><font color="#000000">Eliminar</font></span></td>
			  </tr>';
	  }
	  echo  '</table>';
?>