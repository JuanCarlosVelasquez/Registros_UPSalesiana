<?php
include_once "conexion.php";
class usuario
  {  
  protected $dbcon; 
  
  //lista de usuarios y todos sus campos
    public function lista_usuario()
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select * from REGBIB_USUARIO WHERE USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("USU_ID"=>$res->fields[0],"INS_ID"=>$res->fields[1],"CAT_ID"=>$res->fields[2],"USU_NOMBRE"=>$res->fields[3],"USU_APELLIDO"=>$res->fields[4],"USU_TELEFONO"=>$res->fields[5],"USU_CELULAR"=>$res->fields[6],"USU_DIRECCION"=>$res->fields[7],"USU_ESTADO"=>$res->fields[8],"USU_CEDULA"=>$res->fields[9],"USU_NICK"=>$res->fields[10],"USU_PASSWORD"=>$res->fields[11]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }


 	public function usuario_datos($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select TOP 1 * from REGBIB_USUARIO WHERE USU_CEDULA='$ced' and USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("USU_ID"=>$res->fields[0]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 
	public function resumen_visitasporservicio($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT S.SER_NOMBRE SERVICIO,
COUNT(DR.SER_ID) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END)),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
INNER JOIN REGBIB_SERVICIO S
          ON DR.SER_ID = S.SER_ID
WHERE DR.USU_CEDULA = '$ced'
GROUP BY DR.SER_ID, S.SER_NOMBRE
UNION ALL
SELECT 'TOTAL DE REGISTROS' SERVICIO,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE USU_CEDULA = '$ced'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("SERVICIO"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }


public function resumen_viservfec($fecha1, $fecha2, $hora1, $hora2)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT S.SER_NOMBRE SERVICIO,
COUNT(DR.SER_ID) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J 
WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) 
AND J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND 
J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR INNER JOIN REGBIB_SERVICIO S ON DR.SER_ID = S.SER_ID
WHERE DR.DET_FECHA >= CAST('$fecha1' AS DATE) AND DR.DET_FECHA <= CAST('$fecha2' AS DATE)
AND DR.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) 
AND DR.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))
GROUP BY DR.SER_ID, S.SER_NOMBRE
UNION ALL
SELECT 'TOTAL DE REGISTROS' SERVICIO,
COUNT(1) VISITAS, 100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE DET_FECHA >= CAST('$fecha1' AS DATE) AND DET_FECHA <= CAST('$fecha2' AS DATE)
AND DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
AND DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))");
        	while (!$res->EOF)
            		{
              		$datos[]=array("SERVICIO"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
	
	public function resumen_viservfecser($fecha1, $fecha2, $hora1, $hora2, $servicio)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT S.SER_NOMBRE SERVICIO,
COUNT(DR.SER_ID) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE)
         AND J.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND J.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND J.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND J.SER_ID LIKE ('$servicio'))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
INNER JOIN REGBIB_SERVICIO S
          ON DR.SER_ID = S.SER_ID
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND DR.SER_ID LIKE ('$servicio')
GROUP BY DR.SER_ID, S.SER_NOMBRE
UNION ALL
SELECT 'TOTAL DE REGISTROS' SERVICIO,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND SER_ID LIKE ('$servicio')");
        	while (!$res->EOF)
            		{
              		$datos[]=array("SERVICIO"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 
	public function resumen_visitaspordia($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT DR.DET_DIA DIA,
COUNT(DR.SER_ID) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END)),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.USU_CEDULA = '$ced'
GROUP BY DR.DET_DIA
UNION ALL
SELECT 'TOTAL DE REGISTROS' DIA,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE USU_CEDULA = '$ced'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("DIA"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
	
	
	public function resumen_visitaspordiafec($fecha1, $fecha2, $hora1, $hora2)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT DR.DET_DIA DIA,
COUNT(DR.SER_ID) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE)
         AND J.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND J.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND J.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))
GROUP BY DR.DET_DIA
UNION ALL
SELECT 'TOTAL DE REGISTROS' DIA,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))");
        	while (!$res->EOF)
            		{
              		$datos[]=array("DIA"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
	
	public function resumen_visitaspordiafecser($fecha1, $fecha2, $hora1, $hora2, $servicio)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT DR.DET_DIA DIA,
COUNT(DR.SER_ID) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE)
         AND J.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND J.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND J.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND J.SER_ID LIKE ('$servicio'))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND DR.SER_ID LIKE ('$servicio')
GROUP BY DR.DET_DIA
UNION ALL
SELECT 'TOTAL DE REGISTROS' DIA,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND SER_ID LIKE ('$servicio')");
        	while (!$res->EOF)
            		{
              		$datos[]=array("DIA"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 	 
	public function resumen_visitasporhorario($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT 'MA&Ntilde;ANA DE 07 A 13 h' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)=0 THEN 1 ELSE (CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END) END)/(CASE WHEN (CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END)=0 THEN 1 ELSE (CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END) END)),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.USU_CEDULA = '$ced' AND
DR.DET_HORA_ENTRADA >=
ISNULL(CAST('07:00:00' AS TIME),CAST('07:00:00' AS TIME))
AND DR.DET_HORA_ENTRADA <=
ISNULL(CAST('13:00:00' AS TIME),CAST('13:00:00' AS TIME))
UNION ALL
SELECT 'TARDE DE 13 A 18 h' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)=0 THEN 1 ELSE (CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END) END)/(CASE WHEN (CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END)=0 THEN 1 ELSE (CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END) END)),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.USU_CEDULA = '$ced' AND
DR.DET_HORA_ENTRADA >=
ISNULL(CAST('13:00:01' AS TIME),CAST('13:00:01' AS TIME))
AND DR.DET_HORA_ENTRADA <=
ISNULL(CAST('18:00:00' AS TIME),CAST('18:00:00' AS TIME))
UNION ALL
SELECT 'NOCHE DE 18h adelante' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)=0 THEN 1 ELSE (CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END) END)/(CASE WHEN (CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END)=0 THEN 1 ELSE (CASE WHEN (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced')=0 THEN 1 ELSE (SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.USU_CEDULA = '$ced') END) END)),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.USU_CEDULA = '$ced' AND 
((DR.DET_HORA_ENTRADA >= ISNULL(CAST('18:00:01' AS TIME),CAST('18:00:01' AS TIME)) AND 
DR.DET_HORA_ENTRADA <= ISNULL(CAST('23:59:59' AS TIME),CAST('23:59:59' AS TIME))) OR 
(DR.DET_HORA_ENTRADA >= ISNULL(CAST('00:00:00' AS TIME),CAST('00:00:00' AS TIME)) AND 
DR.DET_HORA_ENTRADA <= ISNULL(CAST('06:59:59' AS TIME),CAST('06:59:59' AS TIME))))
UNION ALL
SELECT 'TOTAL DE REGISTROS' HORARIO,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE USU_CEDULA = '$ced'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("HORARIO"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 
	public function resumen_visitasporhorfec($fecha1, $fecha2, $hora1, $hora2)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT 'MA&Ntilde;ANA DE 07 A 13 h' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) AND 
J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND
DR.DET_HORA_ENTRADA >=
ISNULL(CAST('07:00:00' AS TIME),CAST('07:00:00' AS TIME))
AND DR.DET_HORA_ENTRADA <=
ISNULL(CAST('13:00:00' AS TIME),CAST('13:00:00' AS TIME))
UNION ALL
SELECT 'TARDE DE 13 A 18 h' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) AND J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND
DR.DET_HORA_ENTRADA >=
ISNULL(CAST('13:00:01' AS TIME),CAST('13:00:01' AS TIME))
AND DR.DET_HORA_ENTRADA <=
ISNULL(CAST('18:00:00' AS TIME),CAST('18:00:00' AS TIME))
UNION ALL
SELECT 'NOCHE DE 18h adelante' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) AND J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND 
((DR.DET_HORA_ENTRADA >= ISNULL(CAST('18:00:01' AS TIME),CAST('18:00:01' AS TIME)) AND DR.DET_HORA_ENTRADA <= ISNULL(CAST('23:59:59' AS TIME),CAST('23:59:59' AS TIME))) OR 
(DR.DET_HORA_ENTRADA >= ISNULL(CAST('00:00:00' AS TIME),CAST('00:00:00' AS TIME)) AND DR.DET_HORA_ENTRADA <= ISNULL(CAST('06:59:59' AS TIME),CAST('06:59:59' AS TIME))))
UNION ALL
SELECT 'TOTAL DE REGISTROS' HORARIO,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))");
        	while (!$res->EOF)
            		{
              		$datos[]=array("HORARIO"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 
	public function resumen_visitasporhorfecser($fecha1, $fecha2, $hora1, $hora2, $servicio)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT 'MA&Ntilde;ANA DE 07 A 13 h' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) AND 
J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND J.SER_ID LIKE 
('$servicio'))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND
DR.DET_HORA_ENTRADA >=
ISNULL(CAST('07:00:00' AS TIME),CAST('07:00:00' AS TIME))
AND DR.DET_HORA_ENTRADA <=
ISNULL(CAST('13:00:00' AS TIME),CAST('13:00:00' AS TIME)) AND DR.SER_ID LIKE ('$servicio')
UNION ALL
SELECT 'TARDE DE 13 A 18 h' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) AND 
J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND J.SER_ID LIKE 
('$servicio'))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND
DR.DET_HORA_ENTRADA >=
ISNULL(CAST('13:00:01' AS TIME),CAST('13:00:01' AS TIME))
AND DR.DET_HORA_ENTRADA <=
ISNULL(CAST('18:00:00' AS TIME),CAST('18:00:00' AS TIME)) AND DR.SER_ID LIKE ('$servicio')
UNION ALL
SELECT 'NOCHE DE 18h adelante' HORARIO,
COUNT(1) VISITAS,
ROUND(((CASE WHEN (COUNT(DR.SER_ID)*100)=0 THEN 1 ELSE (COUNT(DR.SER_ID)*100) END)/(SELECT COUNT(1) FROM REGBIB_DETALLE_REGISTRO J WHERE J.DET_FECHA >= CAST('$fecha1' AS DATE) AND J.DET_FECHA <= CAST('$fecha2' AS DATE) AND J.DET_HORA_ENTRADA >= ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME)) AND J.DET_HORA_ENTRADA <= ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND J.SER_ID LIKE ('$servicio'))),2) PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO DR
WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND DR.SER_ID LIKE ('$servicio') AND 
((DR.DET_HORA_ENTRADA >= ISNULL(CAST('18:00:01' AS TIME),CAST('18:00:01' AS TIME)) AND DR.DET_HORA_ENTRADA <= ISNULL(CAST('23:59:59' AS TIME),CAST('23:59:59' AS TIME))) OR 
(DR.DET_HORA_ENTRADA >= ISNULL(CAST('00:00:00' AS TIME),CAST('00:00:00' AS TIME)) AND DR.DET_HORA_ENTRADA <= ISNULL(CAST('06:59:59' AS TIME),CAST('06:59:59' AS TIME))))
UNION ALL
SELECT 'TOTAL DE REGISTROS' HORARIO,
COUNT(1) VISITAS,
100 PORCENTAJE
FROM REGBIB_DETALLE_REGISTRO
WHERE DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME)) AND SER_ID LIKE ('$servicio')");
        	while (!$res->EOF)
            		{
              		$datos[]=array("HORARIO"=>$res->fields[0],"VISITAS"=>$res->fields[1],"PORCENTAJE"=>$res->fields[2]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 	 
	public function comprueba_usuario($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select COUNT(1) TOTAL from REGBIB_USUARIO WHERE USU_CEDULA='$ced' and USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("TOTAL"=>$res->fields[0]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
  
  
	public function comprueba_usuariopass($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT TOP 1 CONVERT(VARCHAR,DECRYPTBYPASSPHRASE('UPS',USU_PASSWORD)) FROM REGBIB_USUARIO WHERE USU_CEDULA='$ced' AND USU_ESTADO='A'");
        	while ($res != NULL)
            		{
              			$datos[]=array("PASS"=>$res->fields[0]);
                		if ($res->fields[0] != '')
						{
	        				$res->MoveNext();
						}
                 	}

                $res->Close();
                return $datos;
         }
                	


				//cargar lista de usarios por la cedula
				public function lista_usuarioXcedula($ced)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("select TOP 1 USU_ID,USU_NICK,USU_CEDULA,ROL_ID,USU_NOMBRE from REGBIB_USUARIO where USU_CEDULA='$ced' AND USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("USU_ID"=>$res->fields[0],"USU_NICK"=>$res->fields[1],"USU_CEDULA"=>$res->fields[2],"ROL_ID"=>$res->fields[3], "USU_NOMBRE"=>$res->fields[3]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }

				
	
	
	//lista de usuarios y todos sus campos por idUusario
    public function lista_usuarioxIdUsuario($idUsuario)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT USU_ID, INS_ID, CAT_ID, USU_NOMBRE, USU_APELLIDO, USU_TELEFONO, USU_CELULAR, USU_DIRECCION, USU_ESTADO, USU_CEDULA, USU_NICK, USU_PASSWORD, ESP_ID, ROL_ID, USU_MAIL from REGBIB_USUARIO WHERE USU_ID=$idUsuario AND USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("USU_ID"=>$res->fields[0],"INS_ID"=>$res->fields[1],"CAT_ID"=>$res->fields[2],"USU_NOMBRE"=>$res->fields[3],"USU_APELLIDO"=>$res->fields[4],"USU_TELEFONO"=>$res->fields[5],"USU_CELULAR"=>$res->fields[6],"USU_DIRECCION"=>$res->fields[7],"USU_ESTADO"=>$res->fields[8],"USU_CEDULA"=>$res->fields[9],"USU_NICK"=>$res->fields[10],"USU_PASSWORD"=>$res->fields[11],"ESP_ID"=>$res->fields[12],"ROL_ID"=>$res->fields[13], "USU_MAIL"=>$res->fields[14]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
		 
	//lista de usuarios y todos sus campos por idUusario YA CAMBIADO Y FUNCIONANDO
    public function lista_usuarioxIdUsuariopass($idUsuario)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT TOP 1 USU_ID, INS_ID, CAT_ID, USU_NOMBRE, USU_APELLIDO, USU_TELEFONO, USU_CELULAR, USU_DIRECCION, USU_ESTADO, USU_CEDULA, USU_NICK, 
USU_PASSWORD, ESP_ID, ROL_ID, USU_MAIL, CONVERT(VARCHAR,DECRYPTBYPASSPHRASE('UPS',USU_PASSWORD)) USU_PASS 
from REGBIB_USUARIO WHERE USU_ID=$idUsuario AND USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("USU_ID"=>$res->fields[0],"INS_ID"=>$res->fields[1],"CAT_ID"=>$res->fields[2],"USU_NOMBRE"=>$res->fields[3],"USU_APELLIDO"=>$res->fields[4],"USU_TELEFONO"=>$res->fields[5],"USU_CELULAR"=>$res->fields[6],"USU_DIRECCION"=>$res->fields[7],"USU_ESTADO"=>$res->fields[8],"USU_CEDULA"=>$res->fields[9],"USU_NICK"=>$res->fields[10],"USU_PASSWORD"=>$res->fields[11],"ESP_ID"=>$res->fields[12],"ROL_ID"=>$res->fields[13],"USU_MAIL"=>$res->fields[14],"USU_PASS"=>$res->fields[15]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		
				//cargar lista de usarios por nombre
			public function listaUsuarioXnombre($nom)
      {   	$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT USU_NOMBRE,USU_APELLIDO,USU_TELEFONO,USU_CELULAR,USU_DIRECCION,USU_CEDULA,USU_NICK,USU_PASSWORD,USU_ID, ROL_ID, USU_MAIL FROM REGBIB_USUARIO WHERE USU_NOMBRE LIKE '%$nom%' AND USU_ESTADO='A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("USU_NOMBRE"=>$res->fields[0],"USU_APELLIDO"=>$res->fields[1],"USU_TELEFONO"=>$res->fields[2],"USU_CELULAR"=>$res->fields[3],"USU_DIRECCION"=>$res->fields[4],"USU_CEDULA"=>$res->fields[5],"USU_NICK"=>$res->fields[6],"USU_PASSWORD"=>$res->fields[7],"USU_ID"=>$res->fields[8],"ROL_ID"=>$res->fields[9],"USU_MAIL"=>$res->fields[10]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
	
					//guardar usuarios con una consulta sql		
					 public function guardar_usuario($sql)
					{
						
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute($sql);	
					  	if(!$res)
					  	{
						  
						echo $dbcon->ErrorMsg();  
					  	}
				    }        
					
					
					public function verificarUsuario($usu,$cla,$usu_id)
					{
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute("select * from REGBIB_USUARIO where USU_ID=$usu_id AND USU_NICK='$usu' and 
			CONVERT(varbinary(100),'$cla')=(SELECT TOP 1 CONVERT(varbinary(100),DECRYPTBYPASSPHRASE('UPS',USU_PASSWORD)) 
			FROM REGBIB_USUARIO WHERE USU_ID=$usu_id AND USU_NICK='$usu') AND USU_ESTADO='A'");
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
					public function verifivarUsuarioX_Cedula($ced)
					{
						$con=new conexion();
						$dbcon=$con->get_conexion();
						$res=$dbcon->Execute("select * from REGBIB_USUARIO where USU_CEDULA='$ced' AND USU_ESTADO='A'");	
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

			//lista d usuario para el encabezado
			 public function lista_UsuarioXId($idUsuario)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT TOP 1 U.USU_NOMBRE,
       U.USU_APELLIDO,
       U.USU_TELEFONO,
       U.USU_DIRECCION,
       C.CAT_NOMBRE,
       I.INS_NOMBRE,
       E.ESP_NOMBRE,
	   U.USU_MAIL
  FROM REGBIB_USUARIO U
       INNER JOIN REGBIB_CATEGORIA C
          ON U.CAT_ID = C.CAT_ID
       INNER JOIN REGBIB_INSTITUCION I
          ON U.INS_ID = I.INS_ID
       INNER JOIN REGBIB_ESPECIALIDAD E
		  ON U.ESP_ID = E.ESP_ID
 WHERE U.USU_CEDULA = '$idUsuario' AND USU_ESTADO = 'A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"U.USU_APELLIDO"=>$res->fields[1],"U.USU_TELEFONO"=>$res->fields[2],"U.USU_DIRECCION"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6], "U.USU_MAIL"=>$res->fields[7]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }

                    
	//CARGAR tabla de asistencias acumuladas USADO EN EL REPORTE
	public function lista_AsistenciasAcumuladas($idUsuario)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT (U.USU_NOMBRE + ' ' + U.USU_APELLIDO) USU_NOMBRE,
       DR.DET_FECHA,
       DR.DET_DIA,
	CONVERT(VARCHAR,DR.DET_HORA_ENTRADA,108) AS DET_HORA_ENTRADA,
       C.CAT_NOMBRE,
       I.INS_NOMBRE,
       E.ESP_NOMBRE,
       S.SER_NOMBRE,
       U.USU_ID,
       U.USU_CEDULA,
	   U.USU_MAIL
  FROM REGBIB_USUARIO U
       INNER JOIN REGBIB_DETALLE_REGISTRO DR
          ON U.USU_CEDULA = DR.USU_CEDULA
       INNER JOIN REGBIB_CATEGORIA C
          ON U.CAT_ID = C.CAT_ID
       INNER JOIN REGBIB_INSTITUCION I
          ON U.INS_ID = I.INS_ID
       INNER JOIN REGBIB_SERVICIO S
          ON DR.SER_ID = S.SER_ID
       INNER JOIN REGBIB_ESPECIALIDAD E
		  ON U.ESP_ID = E.ESP_ID
 WHERE U.USU_CEDULA = '$idUsuario' AND USU_ESTADO = 'A'");
        	while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"DR.DET_FECHA"=>$res->fields[1],"DR.DET_DIA"=>$res->fields[2],"DET_HORA_ENTRADA"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6],"S.SER_NOMBRE"=>$res->fields[7],"U.USU_ID"=>$res->fields[8],"U.USU_CEDULA"=>$res->fields[9],"U.USU_MAIL"=>$res->fields[10]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }

	public function lista_AsistenciasAcumuladasFechas($fecha1, $fecha2, $hora1, $hora2)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT (U.USU_NOMBRE + ' ' + U.USU_APELLIDO) USU_NOMBRE,
         DR.DET_FECHA,
         DR.DET_DIA,
         CONVERT(VARCHAR,DR.DET_HORA_ENTRADA,108) AS DET_HORA_ENTRADA,
         C.CAT_NOMBRE,
         I.INS_NOMBRE,
         E.ESP_NOMBRE,
         S.SER_NOMBRE,
         U.USU_ID,
         U.USU_CEDULA,
		 U.USU_MAIL
    FROM REGBIB_USUARIO U
         INNER JOIN REGBIB_DETALLE_REGISTRO DR
            ON U.USU_CEDULA = DR.USU_CEDULA
         INNER JOIN REGBIB_CATEGORIA C
            ON U.CAT_ID = C.CAT_ID
         INNER JOIN REGBIB_INSTITUCION I
            ON U.INS_ID = I.INS_ID
         INNER JOIN REGBIB_SERVICIO S
            ON DR.SER_ID = S.SER_ID
         INNER JOIN REGBIB_ESPECIALIDAD E
			ON U.ESP_ID = E.ESP_ID
   WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))
         AND USU_ESTADO = 'A'
ORDER BY DR.DET_FECHA ASC, DR.DET_HORA_ENTRADA ASC");
        	while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"DR.DET_FECHA"=>$res->fields[1],"DR.DET_DIA"=>$res->fields[2],"DET_HORA_ENTRADA"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6],"S.SER_NOMBRE"=>$res->fields[7],"U.USU_ID"=>$res->fields[8],"U.USU_CEDULA"=>$res->fields[9],"U.USU_MAIL"=>$res->fields[10]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
		 
	public function lista_AsistenciasAcumuladasFechasServicio($fecha1, $fecha2, $hora1, $hora2, $servicio)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT (U.USU_NOMBRE + ' ' + U.USU_APELLIDO) USU_NOMBRE,
         DR.DET_FECHA,
         DR.DET_DIA,
         CONVERT(VARCHAR,DR.DET_HORA_ENTRADA,108) AS DET_HORA_ENTRADA,
         C.CAT_NOMBRE,
         I.INS_NOMBRE,
         E.ESP_NOMBRE,
         S.SER_NOMBRE,
         U.USU_ID,
         U.USU_CEDULA,
         U.USU_MAIL
    FROM REGBIB_USUARIO U
         INNER JOIN REGBIB_DETALLE_REGISTRO DR
            ON U.USU_CEDULA = DR.USU_CEDULA
         INNER JOIN REGBIB_CATEGORIA C
            ON U.CAT_ID = C.CAT_ID
         INNER JOIN REGBIB_INSTITUCION I
            ON U.INS_ID = I.INS_ID
         INNER JOIN REGBIB_SERVICIO S
            ON DR.SER_ID = S.SER_ID
INNER JOIN REGBIB_ESPECIALIDAD E
			ON U.ESP_ID = E.ESP_ID
   WHERE DR.DET_FECHA >=
            CAST('$fecha1' AS DATE)
         AND DR.DET_FECHA <=
                CAST('$fecha2' AS DATE)
         AND DR.DET_HORA_ENTRADA >=
                ISNULL(CAST('$hora1' AS TIME),CAST('00:00:00' AS TIME))
         AND DR.DET_HORA_ENTRADA <=
                ISNULL(CAST('$hora2' AS TIME),CAST('23:59:59' AS TIME))
		 AND DR.SER_ID LIKE ('$servicio')
         AND USU_ESTADO = 'A'
ORDER BY DR.DET_FECHA ASC, DR.DET_HORA_ENTRADA ASC");
        	while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"DR.DET_FECHA"=>$res->fields[1],"DR.DET_DIA"=>$res->fields[2],"DET_HORA_ENTRADA"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6],"S.SER_NOMBRE"=>$res->fields[7],"U.USU_ID"=>$res->fields[8],"U.USU_CEDULA"=>$res->fields[9],"U.USU_MAIL"=>$res->fields[10]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }
				
	public function lista_AsistenciasAcumuladasxUsr($idUsuario)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute("SELECT TOP 50 U.USU_NOMBRE,
         DR.DET_FECHA,
         DR.DET_DIA,
	CONVERT(VARCHAR,DR.DET_HORA_ENTRADA,108)  AS DET_HORA_ENTRADA,
         C.CAT_NOMBRE,
         I.INS_NOMBRE,
         E.ESP_NOMBRE,
         S.SER_NOMBRE,
         U.USU_ID,
         U.USU_APELLIDO
    FROM REGBIB_USUARIO U
         INNER JOIN REGBIB_DETALLE_REGISTRO DR
            ON U.USU_CEDULA = DR.USU_CEDULA
         INNER JOIN REGBIB_CATEGORIA C
            ON U.CAT_ID = C.CAT_ID
         INNER JOIN REGBIB_INSTITUCION I
            ON U.INS_ID = I.INS_ID
         INNER JOIN REGBIB_SERVICIO S
            ON DR.SER_ID = S.SER_ID
INNER JOIN REGBIB_ESPECIALIDAD E
			ON U.ESP_ID = E.ESP_ID
   WHERE U.USU_CEDULA = '$idUsuario' AND USU_ESTADO = 'A'
ORDER BY DR.DET_FECHA DESC, DR.DET_HORA_ENTRADA DESC");
        	while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"DR.DET_FECHA"=>$res->fields[1],"DR.DET_DIA"=>$res->fields[2],"DET_HORA_ENTRADA"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6],"S.SER_NOMBRE"=>$res->fields[7],"U.USU_ID"=>$res->fields[8], "U.USU_APELLIDO"=>$res->fields[9]);
                	if ($res->fields[0] != '')
				{
        				$res->MoveNext();
				}
                 	}

                $res->Close();
                return $datos;
         }				
	
	
	
	//CARGAR tabla de asistencias acumuladas por consulta query
	public function lista_AsistenciasAcumuladasXconsulta($query)
      {   	
	  		$datos=array();	
        	$con=new conexion();
       		$dbcon=$con->get_conexion();
        	$res=$dbcon->Execute($query);
        	while (!$res->EOF)
            		{
              		$datos[]=array("U.USU_NOMBRE"=>$res->fields[0],"DR.DET_FECHA"=>$res->fields[1],"DR.DET_DIA"=>$res->fields[2],"DR.DET_HORA_ENTRADA"=>$res->fields[3],"C.CAT_NOMBRE"=>$res->fields[4],"I.INS_NOMBRE"=>$res->fields[5],"E.ESP_NOMBRE"=>$res->fields[6],"S.SER_NOMBRE"=>$res->fields[7],"U.USU_ID"=>$res->fields[8]);
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