<?php
include_once"../dominio/usuario.php";
include_once "../dominio/institucion.php";
include_once "../dominio/especialidad.php";
include_once "../dominio/categoria.php";
$usu=new usuario();
$institucio=new institucion();
$esp=new especialidad();
$categoria=new categoria();
$q=$_GET['q'];
$resUsu=$usu->lista_usuarioxIdUsuario($q);
echo '<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
				  	<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CEDULA</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">NOMBRE</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">APELLIDO</font></td>
				</tr>';
foreach($resUsu as $fila){
				  echo' <tr>
				<td><input type="text" class="caja2" id="cedula" value="'.$fila["USU_CEDULA"].'"/></td>
				<td><input type="text" class="caja2" id="nombre" value="'.$fila["USU_NOMBRE"].'"/></td>
				<td><input type="text" class="caja2" id="apellido" value="'.$fila["USU_APELLIDO"].'"/></td>
				</tr>';}
echo  '</table> <br>';
echo '<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
				  <tr>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">TELEFONO</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CELULAR</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">INSTITUCION</font></td>
				</tr>';
foreach($resUsu as $fila){
				  echo' <tr>
				<td><input type="text" class="caja2" id="telefono" value="'.$fila["USU_TELEFONO"].'"/></td>
				<td><input type="text" class="caja2" id="celular" value="'.$fila["USU_CELULAR"].'"/></td>
				<td><select name="institucion" id="institucion">'.$z=$fila["INS_ID"];
				if ($z=="") {$z=0;}$datIns=$institucio->lista_institucionid($z);
				foreach($datIns as $fila2){
				$c=$fila2["INS_ID"];
				$n=$fila2["INS_NOMBRE"];
				echo "<option value=$c>$n</option>";} echo'</select>
				</td>
				</tr>';}
echo  '</table> <br>';
echo '<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">				
				<tr>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">DIRECCION</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">E-MAIL</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">NICK</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">ROL</font></td>
				  </tr>';
foreach($resUsu as $fila){
				  echo' <tr>
				<td><input type="text" class="caja2" id="direccion" value="'.$fila["USU_DIRECCION"].'"/></td>
				<td><input type="text" class="caja2" id="email" value="'.$fila["USU_MAIL"].'"/></td>
				<td><input type="text" class="caja2" id="nick" value="'.$fila["USU_NICK"].'"/></td>
				<td><select name="rol" id="rol">'.$d=$fila["ROL_ID"];
				if ($d=="") {$d=0;}$datrol=$categoria->lista_rolid($d);
				foreach($datrol as $fila5){
				$c5=$fila5["ROL_ID"];
				$n5=$fila5["ROL_NOMBRE"];
				echo "<option value=$c5>$n5</option>";} echo '</select>
				</td>
				</tr>';}
echo  '</table> <br>';
echo '<table width="843" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">				
				<tr>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">CATEGORIA</font></td>
					<td bgcolor="#0088AD"><font size=2 color="#FFFFFF">ESPECIALIDAD</font></td>
				  </tr>';
foreach($resUsu as $fila){
				  echo' <tr>
				<td><select name="categoria" id="categoria">'.$y=$fila["CAT_ID"];
				if ($y=="") {$y=0;}$datCat=$categoria->lista_categoriaid($y);
				foreach($datCat as $fila4){
				$c4=$fila4["CAT_ID"];
				$n4=$fila4["CAT_NOMBRE"];
				echo "<option value=$c4>$n4</option>";} echo '</select>
				</td>
				<td><select name="especialidad" id="especialidad">'.$j=$fila["ESP_ID"];
				if ($j=="") {$j=0;}$datosEsp=$esp->lista_especialidadid($j);
				foreach($datosEsp as $fila3){
				$c3=$fila3["ESP_ID"];
				$n3=$fila3["ESP_NOMBRE"];
				echo "<option value=$c3>$n3</option>";} echo '</select>
				</td>
				</tr>';}
echo  '</table> <br>';
echo '<input name="guardar" type="button" value="Guardar" onclick="guardarEdicion('.$fila["USU_ID"].');"/>';
?>