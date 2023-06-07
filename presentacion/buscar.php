<?php
if (!isset($_SESSION))
    {
    	session_start();
    }
if ($_SESSION["autentificado"] != "SI") {
    //si no esta logueado lo envio a la pagina de autentificacion
    header("Location: index.php");
} else {
    //sino, calculamos el tiempo transcurrido
    $fechaGuardada = $_SESSION["last_access"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
    //comparamos el tiempo transcurrido
     if($tiempo_transcurrido >= 600) {
     //si pasaron 10 minutos o mas
      session_destroy(); // destruyo la sesion
      header("Location: index.php"); //envio al usuario a la pag. de autenticacion
      //sino, actualizo la fecha de la sesion
    }else {
    $_SESSION["ultimoAcceso"] = $ahora;
   }
}
?>
<?php
require("../lib/template/header_inicio_adm_ret.php");
?>
<style type="text/css">
.input {
	float: center;
	width: 100%;
}
.caja {
	width: 400px;
}
.resultados {
	float: center;
	min-height:100px;
	min-width:300px;
	border: 1px dashed #FFF;
}
</style>
<div align="center"><h2>Gestionar Usuarios</h2></div>
<br>
<script language="javascript" type="text/javascript" src="ajax.js"></script>
<div class="input">
<font color="#FFFFFF">Busqueda por Nombre :</font>
<input type="text" size="40" class="caja" id="texto" onkeyup="Buscar();"/>
</div>
<br>
<div class="resultados" id="resultados">
</div>

<?php
require("../lib/template/footer_inicio.php");
?>