<?php
include_once "conexion.php";


class detalle
  {  
  protected $dbcon; 
  
  //lista de registros y todos sus campos
    public function lista_detalle()
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select * from REGBIB_DETALLE_REGISTRO");
        	while (!$res->EOF)
            		{
              		$datos[]=array("DET_ID"=>$res->fields[0],"USU_ID"=>$res->fields[1],"SER_ID"=>$res->fields[2],"DET_HORA_ENTRADA"=>$res->fields[3],"DET_FECHA"=>$res->fields[4],"DET_ESTADO"=>$res->fields[5],"DET_DIA"=>$res->fields[6]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		
					//metodo guardar detalle registro con una consulta sql		
					 public function guardar_detalleRegistro($sql)
					{
						
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute($sql);	
					  	if(!$res)
					  	{
						  
						echo $dbcon->ErrorMsg();  
					  	}
				    }        
					
					
					//metodo parala hora del sistema		
					 public function metodoHoradeSistem($sql)
					{
						
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute($sql);	
					  	if(!$res)
					  	{
						  
						echo $dbcon->ErrorMsg();  
					  	}
				    }        

					//verificar detalle registro por paramettro
					public function verifivarDetalleRegistro($idReg)
					{
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute("select * from REGBIB_USUARIO where USU_NICK='$usu' and USU_PASSWORD='$cla'");	
						if($res)
							{
							 if(!$res->EOF)
								{
								return 1;
								}
								else
								{
									return 0;
								}	
						
							}
							else
							{
							return 0;	
							}
					}
		
			//funcion para detalle registro con parametro 
			
			 public function lista_DetalleRegistroXId($idReg)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT DR.DET_ID,DR.DET_HORA_ENTRADA,DR.DET_FECHA,DR.DET_DIA,U.USU_NOMBRE,U.USU_APELLIDO,S.SER_NOMBRE FROM REGBIB_DETALLE_REGISTRO DR INNER JOIN REGBIB_USUARIO U ON DR.USU_ID=U.USU_ID INNER JOIN REGBIB_SERVICIO S ON DR.SER_ID=S.SER_ID WHERE DR.DET_ID=$idReg
");
        	while (!$res->EOF)
            		{
              		$datos[]=array("DR.DET_ID"=>$res->fields[0],"DR.DET_HORA_ENTRADA"=>$res->fields[1],"DR.DET_FECHA"=>$res->fields[2],"DR.DET_DIA"=>$res->fields[3],"U.USU_NOMBRE"=>$res->fields[4],"U.USU_APELLIDO"=>$res->fields[5],"S.SER_NOMBRE"=>$res->fields[6]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
                  
}

?>