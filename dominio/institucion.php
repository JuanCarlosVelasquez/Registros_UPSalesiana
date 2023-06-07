<?php
include_once "conexion.php";
class institucion
	{
	//protected $dbcon;
	
	public function lista_institucion()
	{	
		$datos=array();
		$con=new conexion();
		$dbcon=$con->get_conexion();
		$res=$dbcon->Execute("select * from REGBIB_INSTITUCION WHERE INS_ESTADO='A'");
		while(!$res->EOF){
				$datos[]=array("INS_ID"=>$res->fields[0],"INS_NOMBRE"=>$res->fields[1],"INS_DIRECCION"=>$res->fields[2],"INS_ESTADO"=>$res->fields[3]);
				if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
			}
		$res->Close();	
		return $datos;
		}


	public function lista_institucionid($idIns)
	{	
		$datos=array();
		$con=new conexion();
		$dbcon=$con->get_conexion();
		$res=$dbcon->Execute("select * from REGBIB_INSTITUCION WHERE INS_ESTADO='A' AND INS_ID = ISNULL($idIns,0)
UNION ALL
select * from REGBIB_INSTITUCION WHERE INS_ESTADO='A' AND INS_ID <> ISNULL($idIns,0)");
		while(!$res->EOF){
				$datos[]=array("INS_ID"=>$res->fields[0],"INS_NOMBRE"=>$res->fields[1],"INS_DIRECCION"=>$res->fields[2],"INS_ESTADO"=>$res->fields[3]);
				if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}			
			}
		$res->Close();	
		return $datos;
		}

		
public function lista_institucionesXid($idIns){
	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select INS_ID, INS_NOMBRE, INS_DIRECCION, INS_ESTADO from REGBIB_INSTITUCION where INS_ID=$idIns");
        	while (!$res->EOF)
            	{
              		$datos[]=array("INS_ID"=>$res->fields[0],"INS_NOMBRE"=>$res->fields[1],"INS_DIRECCION"=>$res->fields[2],"INS_ESTADO"=>$res->fields[3]);
			if ($res->fields[0] != '')
			{
        	        	$res->MoveNext();
			}
                 }

                $res->Close();
                return $datos;
}
	

//metodo guardar usuarios con una consulta sql		
					 public function guardar_institucion($sql)
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