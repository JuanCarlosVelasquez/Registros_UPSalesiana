<?php
include_once "conexion.php";
class categoria
  {
   protected $dbcon; 
   public function lista_categoria()
      {
        	$datos=array();
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select * from REGBIB_CATEGORIA where CAT_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("CAT_ID"=>$res->fields[0],"CAT_NOMBRE"=>$res->fields[1]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}
                $res->Close();
                return $datos;
         }
		 
		 
	 public function lista_categoriaid($catid)
      {
        	$datos=array();
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select * from REGBIB_CATEGORIA where CAT_ESTADO='A' AND CAT_ID = ISNULL($catid,0) 
			UNION ALL 
			select * from REGBIB_CATEGORIA where CAT_ESTADO='A' AND CAT_ID <> ISNULL($catid,0)");
        	while (!$res->EOF)
            		{
              		$datos[]=array("CAT_ID"=>$res->fields[0],"CAT_NOMBRE"=>$res->fields[1]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}
                $res->Close();
                return $datos;
         }


	 public function lista_rolid($rolid)
      {
        	$datos=array();
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select * from REGBIB_ROLES where ROL_ESTADO='A' AND ROL_ID = ISNULL($rolid,0) 
			UNION ALL 
			select * from REGBIB_ROLES where ROL_ESTADO='A' AND ROL_ID <> ISNULL($rolid,0)");
        	while (!$res->EOF)
            		{
              		$datos[]=array("ROL_ID"=>$res->fields[0],"ROL_NOMBRE"=>$res->fields[1]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}
                $res->Close();
                return $datos;
         }
                    //metodo guardar
    public function guardar_categoria($sql)
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