<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	require('fpdf.php'); //Librería
	include "../../../conexion/conexion.php";
	error_reporting(0);
	//mysqli_query($conexion,"SET NAMES 'utf8'");
	
	if(isset($_SESSION['userid'])){
		if($_SESSION["bloque"] != 0 && $_SESSION["grado"]!= 0){
			
			$pdf=new FPDF();
			IF($_SESSION["grado"]<=15){
				$pdf->AddPage('L','A3');
				#Establecemos los márgenes izquierda, arriba y derecha: 
				$pdf->SetMargins(10, 0,5 ); 
				#Establecemos el margen inferior: 
				$pdf->SetAutoPageBreak(true,10);
			}
			ELSE{
				$pdf->AddPage('L','A3');
				#Establecemos los márgenes izquierda, arriba y derecha: 
				$pdf->SetMargins(5, 0,5 ); 
				#Establecemos el margen inferior: 
				$pdf->SetAutoPageBreak(true,10);
			}
			
			switch ($_SESSION["grado"]) {
				case 7://1o
					$grupo = "1o. A";
				break;
				case 8:
					$grupo = "1o. B";
				break;
				case 10://2o
					$grupo = "2o. A";
				break;
				case 11:
					$grupo = "2o. B";
				break;
				case 13://3o
					$grupo = "3o. A";
				break;
				case 14://3o
					$grupo = "3o. B";
				break;
				case 16://3o
					$grupo = "4o. A";
				break;
				case 17://3o
					$grupo = "4o. B";
				break;
				case 19://3o
					$grupo = "5o. A";
				break;
				case 20://3o
					$grupo = "5o. B";
				break;
				case 22://3o
					$grupo = "6o. A";
				break;
				case 23://3o
					$grupo = "6o. B";
				break;
			}
			switch ($_SESSION["bloque"]) {
				case 1://1o
					$unidad = "I";
				break;
				case 2:
					$unidad = "II";
				break;
				case 3://2o
					$unidad = "III";
				break;
				case 4:
					$unidad = "IV";
				break;
				case 5://3o
					$unidad = "V";
				break;
			}
			
			$result1 = mysqli_query($conexion,"SELECT DISTINCT CONCAT(DATE_FORMAT(fecha_inicio,'%Y'),'-',DATE_FORMAT(fecha_fin,'%Y')) as ciclo FROM `ciclo` WHERE ciclo.id = '".$_SESSION["ciclo"]."'") or die(mysqli_error($conexion));
			$row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
			$ciclo_escolar=$row['ciclo'];
			
			$pdf->Image('logo/logo.png',160 ,5, 100 , 20,'PNG', '');
			// Arial bold 15 
			$pdf->Ln(20);
			$pdf->SetFont('Arial','B',11); 
			// Movernos a la derecha 
			//$pdf->Cell(70); 
			// Título
			//$pdf->Cell(30,7,'ESPAÑOL',0,0,'L'); 
			$pdf->Cell(30,7,"GRUPO:".$grupo." BLOQUE:".$unidad,0,0,'L');
			$pdf->Cell(30);
			$pdf->Cell(30,7,"CICLO:".$ciclo_escolar,0,1,'L');
			$pdf->Ln(10);
						
			$con1= mysqli_query($conexion,"select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 	
			$alumno=array();
			$matricula=array();
			$nombre=array();
			while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
				$alumno[] = $row['id'];
				$matricula[] = $row['matricula'];
				$nombre[] = $row['nombre_completo'];
			}
			//ESPAÑOL
			$materia=array();
			$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE (grado.id = '".$_SESSION["grado"]."') and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '3'") or die("Error 1 :".mysqli_error($conexion));
			while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
				$materia[]=$row[0];
			}
			$easistencia=array();
			$eevidencias=array();
			$eporcentajeEvidencias=array();
			$eknotion=array();
			$eporcentajeKnotion=array();
			$esuma=array();
			$eporcentajeFinal=array();
			for($i=0;$i<count($alumno);$i++){
				for($j=0;$j<count($materia);$j++){
					$Con = mysqli_query($conexion,"select calificacionmateria.id, calificacionmateria.materia, calificacionmateria.noClases,  calificacionmateria.asistencia, calificacionmateria.evidencias, calificacionmateria.porcentajeEvidencias, calificacionmateria.knotion, calificacionmateria.porcentajeKnotion, calificacionmateria.suma, calificacionmateria.porcentajeFinal from calificacionmateria where calificacionmateria.materia = '".$materia[$j]."' AND (calificacionmateria.alumno = '".$alumno[$i]."') and (calificacionmateria.unidad = '".$_SESSION["bloque"]."') and (calificacionmateria.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
					$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
					//valores de las consultas
					if($row['materia']=='ESP001' || $row['materia']=='ESP002' || $row['materia']=='ESP003' || $row['materia']=='ESP004' || $row['materia']=='ESP005' || $row['materia']=='ESP006'){
						$enoClases=$row['noClases'];
						$easistencia[$i]=$row['asistencia'];
					}
					$eevidencias[$i][$j]=$row['evidencias'];
					$eporcentajeEvidencias[$i][$j]=$row['porcentajeEvidencias'];
					$eknotion[$i][$j]=$row['knotion'];
					$eporcentajeKnotion[$i][$j]=$row['porcentajeKnotion'];
					$esuma[$i][$j]=$row['suma'];
					$eporcentajeFinal[$i][$j]=$row['porcentajeFinal'];
				}
			}
			//INGLES
			$con1= mysqli_query($conexion,"SELECT ingles.id as ingles FROM grado, gradoingles, ingles WHERE (grado.id = '".$_SESSION["grado"]."') and (grado.id = gradoingles.grado) and (gradoingles.ingles = ingles.id)") or die("Error 1 :".mysqli_error($conexion)); 
			while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
				$ingles=$row[0];
			}
			$ievidencias=array();
			$iasistencia=array();
			$iporcentajeEvidencias=array();
			$iknotion=array();
			$iporcentajeKnotion=array();
			$isuma=array();
			$iporcentajeFinal=array();
			$j=0;
			for($i=0;$i<count($alumno);$i++){
				for($j=1;$j<=4;$j++){
					$Con = mysqli_query($conexion,"SELECT calificacioningles.id, calificacioningles.evidencias, calificacioningles.porcentajeEvidencias, calificacioningles.knotion, calificacioningles.porcentajeKnotion, calificacioningles.suma, calificacioningles.porcentajeFinal from calificacioningles where calificacioningles.materia = '".$ingles."' and calificacioningles.campoFormativo = '".$j."' AND (calificacioningles.alumno = '".$alumno[$i]."') and (calificacioningles.unidad = '".$_SESSION["bloque"]."') and (calificacioningles.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
					$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
					$ievidencias[$i][$j]=$row['evidencias'];
					$iporcentajeEvidencias[$i][$j]=$row['porcentajeEvidencias'];
					$iknotion[$i][$j]=$row['knotion'];
					$iporcentajeKnotion[$i][$j]=$row['porcentajeKnotion'];
					$isuma[$i][$j]=$row['suma'];
					$iporcentajeFinal[$i][$j]=$row['porcentajeFinal'];
				}
			}
			//Artes
			if($_SESSION["grado"]==7 || $_SESSION["grado"]==8 || $_SESSION["grado"]==10 || $_SESSION["grado"]==11 || $_SESSION["grado"]==13 || $_SESSION["grado"]==14 || $_SESSION["grado"]==16 || $_SESSION["grado"]==17){
				$arte=array();
				$con1= mysqli_query($conexion,"SELECT artes.id, artes.nombre FROM artes, gradoarte, grado WHERE grado.id = ".$_SESSION["grado"]." AND grado.id = gradoarte.grado AND gradoarte.artes = artes.id") or die("Error 1 :".mysqli_error($conexion));
				while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
					$arte[]=$row[0];
				}
				$aevidencias=array();
				$aporcentajeEvidencias=array();
				for($i=0;$i<count($alumno);$i++){
					for($j=0;$j<count($arte);$j++){
						$Con = mysqli_query($conexion,"SELECT calificacionartes.id, calificacionartes.evidencias, calificacionartes.porcentajeEvidencias, calificacionartes.suma, calificacionartes.porcentajeFinal from calificacionartes where calificacionartes.artes = '".$arte[$j]."' AND (calificacionartes.alumno = '".$alumno[$i]."') and (calificacionartes.unidad = '".$_SESSION["bloque"]."') and (calificacionartes.ciclo = '".$_SESSION["ciclo"]."') ") or die(mysqli_error($conexion));
						$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
						$aevidencias[$i][$j]=$row['evidencias'];
						$aporcentajeEvidencias[$i][$j]=$row['porcentajeEvidencias'];
					}
				}
			}
			if($_SESSION["grado"]==19 || $_SESSION["grado"]==20 || $_SESSION["grado"]==22 || $_SESSION["grado"]==23){
				$aevidencias=array();
				$aporcentajeEvidencias=array();
				for($i=0;$i<count($alumno);$i++){
					$Con = mysqli_query($conexion,"SELECT calificacionartes.id, calificacionartes.evidencias, calificacionartes.porcentajeEvidencias, calificacionartes.suma, calificacionartes.porcentajeFinal from calificacionartes where (calificacionartes.alumno = '".$alumno[$i]."') and (calificacionartes.unidad = '".$_SESSION["bloque"]."') and (calificacionartes.ciclo = '".$_SESSION["ciclo"]."') ") or die(mysqli_error($conexion));
					$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
					$aevidencias[$i]=$row['evidencias'];
					$aporcentajeEvidencias[$i]=$row['porcentajeEvidencias'];
				}
			}
			//Educacion Fisica
			for($i=0;$i<count($alumno);$i++){
				$Con = mysqli_query($conexion,"SELECT calificacionfisica.id, calificacionfisica.evidencias, calificacionfisica.porcentajeEvidencias, calificacionfisica.suma, calificacionfisica.porcentajeFinal from calificacionfisica where (calificacionfisica.alumno = '".$alumno[$i]."') and (calificacionfisica.unidad = '".$_SESSION["bloque"]."') and (calificacionfisica.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				//valores de las consultas
				$fevidencias[$i]=$row['evidencias'];
				$fporcentajeEvidencias[$i]=$row['porcentajeEvidencias'];
				$fsuma[$i]=$row['suma'];
				$fporcentajeFinal[$i]=$row['porcentajeFinal'];
			}
			//Computacion
			for($i=0;$i<count($alumno);$i++){
				$Con = mysqli_query($conexion,"SELECT calificacionclub.id, calificacionclub.evidencias, calificacionclub.porcentajeEvidencias, calificacionclub.suma, calificacionclub.porcentajeFinal from calificacionclub where (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."') ") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				//valores de las consultas
				$cevidencias[$i]=$row['evidencias'];
				$cporcentajeEvidencias[$i]=$row['porcentajeEvidencias'];
				$csuma[$i]=$row['suma'];
				$cporcentajeFinal[$i]=$row['porcentajeFinal'];
			}
			
			//Calculos
			if($_SESSION["grado"]==7 || $_SESSION["grado"]==8 || $_SESSION["grado"]==10 || $_SESSION["grado"]==11 || $_SESSION["grado"]==13 || $_SESSION["grado"]==14 || $_SESSION["grado"]==16 || $_SESSION["grado"]==17){
				for($i=0;$i<count($alumno);$i++){
					$sumaartes[$i]=$aporcentajeEvidencias[$i][0]+$aporcentajeEvidencias[$i][1];
					$ape[$i]=bcdiv((($sumaartes[$i]*10)/100), '1', 1);
				}
			}
			if($_SESSION["grado"]==19 || $_SESSION["grado"]==20 || $_SESSION["grado"]==22 || $_SESSION["grado"]==23){
				for($i=0;$i<count($alumno);$i++){
					$ape[$i]=bcdiv((($aporcentajeEvidencias[$i]*10)/100), '1', 1);
				}
			}
			for($i=0;$i<count($alumno);$i++){
				//Lenguajes
				$suma1[$i]=$eporcentajeFinal[$i][0]+$iporcentajeFinal[$i][1]+$ape[$i];
				$final1[$i]=round(($suma1[$i]/10), 0);
				//saberes
				$suma2[$i]=$eporcentajeFinal[$i][1]+$iporcentajeFinal[$i][2]+$eporcentajeFinal[$i][2];
				$final2[$i]=round(($suma2[$i]/10), 0);
				//etica, naturaleza
				$suma3[$i]=$eporcentajeFinal[$i][3]+$iporcentajeFinal[$i][3];
				$final3[$i]=round(($suma3[$i]/10), 0);
				//de lo humano
				$suma4[$i]=$eporcentajeFinal[$i][4]+$iporcentajeFinal[$i][4]+$fporcentajeFinal[$i]+$cporcentajeFinal[$i];
				$final4[$i]=round(($suma4[$i]/10), 0);
			}
				
			$pdf->SetFillColor(225, 229, 230); //Gris tenue de cada fila
			//Titulos de tabla
				
				
			$pdf->SetFont('Arial','B',8,true);
			$pdf->Cell(82,5,' ',1,0,'C',true);
			$pdf->Cell(75,5,'LENGUAJES',1,0,'C',true);
			$pdf->Cell(75,5,'SABERES',1,0,'C',true);
			$pdf->Cell(60,5,'ENyS',1,0,'C',true);
			$pdf->Cell(90,5,'DHC',1,1,'C',true);
			
			$pdf->SetFont('Arial','B',8,true);
			$pdf->Cell(7,5,'NO',1,0,'C',true);
			$pdf->Cell(65,5,'NOMBRE',1,0,'C',true);
			$pdf->SetFont('Arial','B',6,true);
			$pdf->Cell(10,5,'ASIST.',1,0,'C',true);
			
			$pdf->Cell(15,5,'% FINAL ESP',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL ING',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL ART',1,0,'C',true);
			$pdf->Cell(15,5,'SUMA DE %',1,0,'C',true);
			$pdf->Cell(15,5,'FINAL',1,0,'C',true);
			
			$pdf->Cell(15,5,'% FINAL MAT',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL ING',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL C.N.',1,0,'C',true);
			$pdf->Cell(15,5,'SUMA DE %',1,0,'C',true);
			$pdf->Cell(15,5,'FINAL',1,0,'C',true);
			
			$pdf->Cell(15,5,'% FINAL E.N.S',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL ING',1,0,'C',true);
			$pdf->Cell(15,5,'SUMA DE %',1,0,'C',true);
			$pdf->Cell(15,5,'FINAL',1,0,'C',true);
			
			$pdf->Cell(15,5,'% FINAL TEC.',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL E.FIS.',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL E.S.E.',1,0,'C',true);
			$pdf->Cell(15,5,'% FINAL ING',1,0,'C',true);
			$pdf->Cell(15,5,'SUMA DE %',1,0,'C',true);
			$pdf->Cell(15,5,'FINAL',1,1,'C',true);
			
			$pdf->SetFont('Arial','B',8,true);
			$pdf->Cell(72,5,'MÁXIMOS',1,0,'C',true);
			$pdf->Cell(10,5,$enoClases,1,0,'C',true);
			
			$pdf->Cell(15,5,'50',1,0,'C',true);
			$pdf->Cell(15,5,'40',1,0,'C',true);
			$pdf->Cell(15,5,'10',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			
			$pdf->Cell(15,5,'60',1,0,'C',true);
			$pdf->Cell(15,5,'10',1,0,'C',true);
			$pdf->Cell(15,5,'30',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			
			$pdf->Cell(15,5,'70',1,0,'C',true);
			$pdf->Cell(15,5,'30',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			
			$pdf->Cell(15,5,'30',1,0,'C',true);
			$pdf->Cell(15,5,'30',1,0,'C',true);
			$pdf->Cell(15,5,'20',1,0,'C',true);
			$pdf->Cell(15,5,'20',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,0,'C',true);
			$pdf->Cell(15,5,' ',1,1,'C',true);
			
			$pdf->SetFont('Arial','B',8);
			$pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
			$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
			$bandera = false; //Para alternar el relleno
								
			$num_fila = 1; 
			//bucle para mostrar los resultados 
				
			if(count($alumno)<33){
				for($i=0;$i<count($alumno);$i++){
						
					$pdf->Cell(7,5,$num_fila,1,0,'L',$bandera);
					$pdf->Cell(65,5,substr(utf8_decode($nombre[$i]),0,36),1,0,'L',$bandera);
					$pdf->Cell(10,5,$easistencia[$i],1,0,'C',$bandera);
					
					$pdf->Cell(15,5,$eporcentajeFinal[$i][0],1,0,'C',$bandera);
					$pdf->Cell(15,5,$iporcentajeFinal[$i][1],1,0,'C',$bandera);
					$pdf->Cell(15,5,$ape[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$suma1[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$final1[$i],1,0,'C',$bandera);
					
					$pdf->Cell(15,5,$eporcentajeFinal[$i][1],1,0,'C',$bandera);
					$pdf->Cell(15,5,$iporcentajeFinal[$i][2],1,0,'C',$bandera);
					$pdf->Cell(15,5,$eporcentajeFinal[$i][2],1,0,'C',$bandera);
					$pdf->Cell(15,5,$suma2[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$final2[$i],1,0,'C',$bandera);
					
					$pdf->Cell(15,5,$eporcentajeFinal[$i][3],1,0,'C',$bandera);
					$pdf->Cell(15,5,$iporcentajeFinal[$i][3],1,0,'C',$bandera);
					$pdf->Cell(15,5,$suma3[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$final3[$i],1,0,'C',$bandera);
					
					$pdf->Cell(15,5,$cporcentajeFinal[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$fporcentajeFinal[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$eporcentajeFinal[$i][4],1,0,'C',$bandera);
					$pdf->Cell(15,5,$iporcentajeFinal[$i][4],1,0,'C',$bandera);
					$pdf->Cell(15,5,$suma4[$i],1,0,'C',$bandera);
					$pdf->Cell(15,5,$final4[$i],1,1,'C',$bandera);
					
					$bandera = !$bandera;//Alterna el valor de la bandera
					//aumentamos en uno el número de filas 
					$num_fila++;
				} //cierro el for
			}
			date_default_timezone_set('America/Mexico_City');
			setlocale(LC_TIME, 'spanish');
			$fecha = strftime("%A, %d de %B de %Y");
			$pdf->Ln(5);	
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(340);
			$pdf->Cell(25,2,$fecha,0,1,'C');
			
			$pdf->Ln(5);
			$pdf->MultiCell(196,3,"Esta acta ha sido revisada por la coordinación.",0,'J');
			$pdf->Ln(10);
			$pdf->Cell(150);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(25,3,'________________________________________',0,0,'C');
			$pdf->Cell(80);
			$pdf->Cell(25,3,'________________________________________',0,1,'C');
			$pdf->Ln();
			$pdf->Cell(150);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,2,"NOMBRE Y FIRMA DE COORDINACIÓN",0,0,'C');
			$pdf->Cell(80);
			$pdf->Cell(25,2,"NOMBRE Y FIRMA DEL DOCENTE",0,1,'C');
			$pdf->Output();
		}
					
	}
	else{
		header('location: ../index.php');
	}
?>