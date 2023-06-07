<?php
include_once"../persistencia/adodb.inc.php";
class conexion
{
	protected $dbcon;
	public function get_conexion()
	{
		$matriz_ini = parse_ini_file("../lib/security/conexion.ini", true);
		$bd_host = ($matriz_ini['base_de_datos']['db_config_host']);
		$bd_usuario = ($matriz_ini['base_de_datos']['db_config_username']);
		$bd_pas = ($matriz_ini['base_de_datos']['db_config_password']);
		$bd_port="";
		$dbcon = ADONewConnection("odbc_mssql2012");
		$dbcon->Connect($bd_host, $bd_usuario, $bd_pas);
		$dbcon->debung=true;
			if($dbcon)
				{
				  return $dbcon; 
				}
			else
				{
				   echo "conexion fallida a SQL SERVER";
				}
	}
}
?>







