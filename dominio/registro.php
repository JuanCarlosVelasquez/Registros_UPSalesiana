<?php
include_once "conexion.php";
class registro
  {
   protected $dbcon; 
   
   //lista Usuario
   public function lista_registro()
      {
        	$datos=array();
        	$con=new conexion();
       		$dbcon=$con->get_conexion();		
			$res=$dbcon->Execute("select USU_ID,USU_NOMBRE,USU_APELLIDO from REGBIB_USUARIO");
			
			while (!$res->EOF)
            		{
              		$datos[]=array("USU_ID"=>$res->fields[0],"USU_NOMBRE"=>$res->fields[1],"USU_APELLIDO"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }

                    //metodo guardar				
					public function guardar_usuario($sql)					{
						
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute($sql);	
					  	if(!$res)
					  	{
						  
						echo $dbcon->ErrorMsg();  
					  	}
				    }        
					
					//verificar usuario con clave
					public function verifivarUsuario($usu,$cla)
					{
						
						$con=new conexion();
						$dbcon=$con->get_conexion();
						
						
						
						$res=$dbcon->Execute("select * from REGBIB_USUARIO where USU_NICK='$usu' and USU_PASSWORD='$cla'" ); 
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
					
					
					
					
					//verificar usuario por cedula
					
						public function verifivarUsuarioX_Cedual($ced)
					{
						
						$con=new conexion();
						$dbcon=$con->get_conexion();
						
						
						
						$res=$dbcon->Execute("select * from REGBIB_USUARIO where USU_CEDULA='$ced'" ); 
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
					
					
             //lista de usuario con Id y relacionada con los especialidad institucion, etc
			  public function lista_UsuarioXId($idUsuario)
      {
        	$datos=array();
        	$con=new conexion();
       		$dbcon=$con->get_conexion();	
			$res=$dbcon->Execute("SELECT U.USU_NOMBRE,U.USU_APELLIDO,U.USU_TELEFONO,U.USU_DIRECCION,C.CAT_NOMBRE,I.INS_NOMBRE,E.ESP_NOMBRE,U.USU_CEDULA FROM REGBIB_USUARIO U INNER JOIN REGBIB_CATEGORIA C ON U.CAT_ID=C.CAT_ID INNER JOIN REGBIB_INSTITUCION I ON U.INS_ID=I.INS_ID INNER JOIN REGBIB_ESPECIALIDAD E ON U.ESP_ID=E.ESP_ID WHERE U.USU_ID=$idUsuario");
			while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"U.USU_APELLIDO"=>$res->fields[1],"U.USU_TELEFONO"=>$res->fields[2],"U.USU_DIRECCION"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6],"U.USU_CEDULA"=>$res->fields[7]);
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