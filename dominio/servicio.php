<?php
include_once "conexion.php";
class servicio
  {  
  //protected $dbcon; 
  
  //lista de SERVICIOS y todos sus campos
    public function lista_servicios()
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select * from REGBIB_SERVICIO WHERE SER_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("SER_ID"=>$res->fields[0],"SER_NOMBRE"=>$res->fields[1],"SER_ESTADO"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }

	//lista de servicios por idServicios
	public function lista_serviciosXid($idSer){
	$datos=array();	
        $con=new conexion();
	$dbcon=$con->get_conexion();
        $res=$dbcon->Execute("select SER_ID, SER_NOMBRE, SER_ESTADO from REGBIB_SERVICIO where SER_ID=$idSer");
        while (!$res->EOF)
        {
        	$datos[]=array("SER_ID"=>$res->fields[0],"SER_NOMBRE"=>$res->fields[1],"SER_ESTADO"=>$res->fields[2]);
        	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
        }
	$res->Close();
	return $datos;
	}

	//metodo guardar usuarios con una consulta sql		
	public function guardar_servicio($sql)
	{
		$con=new conexion();
		$dbcon=$con->get_conexion();
		$res=$dbcon->Execute($sql);	
		if(!$res)
		{
			echo $dbcon->ErrorMsg();  
		}
	}
                            
}

?>















