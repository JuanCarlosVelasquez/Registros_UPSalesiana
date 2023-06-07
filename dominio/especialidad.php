<?php
include_once "conexion.php";
class especialidad
  {
   protected $dbcon; 
  
  
   //lista de especialidades y todos sus campos
    public function lista_especialidad()
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select ESP_ID, ESP_NOMBRE, ESP_ESTADO from REGBIB_ESPECIALIDAD where ESP_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("ESP_ID"=>$res->fields[0],"ESP_NOMBRE"=>$res->fields[1],"ESP_ESTADO"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
	 //lista de especialidades y todos sus campos
    public function lista_especialidadid($idesp)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select ESP_ID, ESP_NOMBRE, ESP_ESTADO from REGBIB_ESPECIALIDAD where ESP_ESTADO='A' AND ESP_ID = ISNULL($idesp,0) 
			UNION ALL 
			select ESP_ID, ESP_NOMBRE, ESP_ESTADO from REGBIB_ESPECIALIDAD where ESP_ESTADO='A' AND ESP_ID <> ISNULL($idesp,0)");
        	while (!$res->EOF)
            		{
              		$datos[]=array("ESP_ID"=>$res->fields[0],"ESP_NOMBRE"=>$res->fields[1],"ESP_ESTADO"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
	public function lista_especialidad_modif()
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select ESP_ID, ESP_NOMBRE, ESP_ESTADO from REGBIB_ESPECIALIDAD where ESP_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("ESP_ID"=>$res->fields[0],"ESP_NOMBRE"=>$res->fields[1],"ESP_ESTADO"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
  
  
  //lista de servicios por idServicios
public function lista_especialidadXid($idesp){
	
	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select ESP_ID, ESP_NOMBRE, ESP_ESTADO from REGBIB_ESPECIALIDAD where ESP_ID=$idesp");
        	while (!$res->EOF)
            		{
              		$datos[]=array("ESP_ID"=>$res->fields[0],"ESP_NOMBRE"=>$res->fields[1],"ESP_ESTADO"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
	}

                    //metodo guardar
					public function guardarEspecialidad($sql)
					{
						
					$con=new conexion();
					$dbcon=$con->get_conexion();
					$res=$dbcon->Execute($sql);	
					  if(!$res)
					  {
						  
						echo $dbcon->ErrorMsg();  
					  }
					  
						
						
				    }        
					
					
					  public function actualizar_especialidad($sql)
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