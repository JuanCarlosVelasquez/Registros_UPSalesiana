<?php 
if (!isset($_SESSION))
    {
    	session_start();
    }
include_once"../dominio/usuario.php";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_servicio_fechas.xls");
$_usua=new usuario();
$servicio = $_SESSION["servicio"];
$fecha1 = $_SESSION["fecha1"];
$fecha2 = $_SESSION["fecha2"];
$hora1 = $_SESSION["hora1"];
$hora2 = $_SESSION["hora2"];
if ($hora1=="") {
  $hora1="00:00:00";
}
if ($hora2=="") {
  $hora2="23:59:59";
}
?>
<table width="100%" border="1" cellspacing="5" cellpadding="5">
				  <tr>
					<td>NOMBRE</td>
					<td>CEDULA</td>
                    <td>FECHA</td>
					<td>DIA</td>
					<td>HORA DE ENTRADA</td>
					<td>CATEGORIA</td>
					<td>INSTITUCION</td>
					<td>ESPECIALIDAD</td>
                    <td>E-MAIL</td>
					<td>SERVICIO</td>
				  </tr>
<?php 
$lisUsu=$_usua->lista_AsistenciasAcumuladasFechasServicio($fecha1, $fecha2, $hora1, $hora2, $servicio);
foreach($lisUsu as $fila3){
?>
 <tr>
    <td><?php echo $fila3["U.USU_NOMBRE"];?></td>
    <td><?php echo $fila3["U.USU_CEDULA"];?></td>
      <td><?php echo $fila3["DR.DET_FECHA"];?></td>
      <td><?php echo $fila3["DR.DET_DIA"];?></td>
      <td><?php echo $fila3["DET_HORA_ENTRADA"]; ?></td>
      <td><?php echo $fila3["C.CAT_NOMBRE"];?></td>
      <td><?php echo $fila3["I.INS_NOMBRE"]; ?></td>
      <td><?php echo $fila3["E.ESP_NOMBRE"];?></td>
      <td><?php echo $fila3["U.USU_MAIL"];?></td>
      <td><?php echo $fila3["S.SER_NOMBRE"]; ?></td>
      </tr>
<?php 
	}
?>
  </table>