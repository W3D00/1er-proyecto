<?php
	require('fpdf.php'); //Librería
	include "../../conexion/conexion.php";
	error_reporting(0);
	//Configuración de la página
	//mysqli_query("SET NAMES", "utf8");
	//mysqli_set_charset($conexion,"utf8");
	
	//Datos
	$nivel = 3;
	$ciclo = $_POST['Ciclo'];
	$grado = $_POST['Grado'];
	$bloque = $_POST['Bloque'];
	$fecha = preg_split("/[\s-]/", $_POST['fecha']);
	$ano = $fecha[0];
	$mes = $fecha[1];
	$dia = $fecha[2];
	//$bloque = 2;
	$lado = $_POST['Lado'];
	switch ($grado) {
		case 7://1o
			$grupoi = "1er";
			$docente = 'Rut Noemí Rivera Hernández';
		break;
		case 8:
			$grupoi = "1er";
			$docente = 'Rut Noemí Rivera Hernández';
		break;
		case 10://2o
			$grupoi = "2o";
			$docente = 'Jose Jesus Ramirez Capistran';
		break;
		case 11:
			$grupoi = "2o";
			$docente = 'Jose Jesus Ramirez Capistran';
		break;
		case 13://3o
			$grupoi = "3er";
			$docente = 'Dilsa Viguera Sosa';
		break;
		case 14:
			$grupoi = "3er";
			$docente = 'Dilsa Viguera Sosa';
		break;
		case 16://4o
			$grupoi = "4o";
			$docente = 'María Susana Rodríguez Marín';
		break;
		case 17:
			$grupoi = "4o";
			$docente = 'María Susana Rodríguez Marín';
		break;
		case 19://5o
			$grupoi = "5o";
			$docente = 'Marlene Ronzon Falfan';
		break;
		case 20:
			$grupoi = "5o";
			$docente = 'Marlene Ronzon Falfan';
		break;
		case 22://6o
			$grupoi = "6o";
			$docente = 'Doris Melgarejo Limon';
		break;
		case 23:
			$grupoi = "6o";
			$docente = 'Doris Melgarejo Limon';
		break;
	}
	if($lado == 'SEGUIMIENTO'){
		//Página
		$pdf=new FPDF(); 
		$pdf->SetAutoPageBreak(true,1); 
		
		$Con = mysqli_query($conexion,"SELECT distinct alumno.id, concat(alumno.paterno,' ',alumno.materno,' ',alumno.nombre) AS nombre_completo, alumno.paterno, alumno.materno, alumno.nombre, alumno.curp, grupo.descripcion as gg FROM grado , alumnogrado , grupo , alumnosituacion , situacion , alumno WHERE grado.grupo = grupo.id AND grado.id = alumnogrado.grado AND alumnogrado.alumno = alumno.id AND alumno.id =  alumnosituacion.alumno AND alumnosituacion.situacion = situacion.id AND situacion.situacion <> 'BAJA' AND grado.id = '".$grado."' AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$ciclo."') ORDER BY nombre_completo") or die(mysqli_error($conexion));
			
		$id=array();
		$nombre=array();
		$grupo=array();
			
		while ($row = mysqli_fetch_array($Con,MYSQLI_ASSOC)){ 
			//valores de las consultas
			$id[]=$row['id'];
			$nombre[]=$row['nombre_completo'];
			$paterno[]=$row['paterno'];
			$materno[]=$row['materno'];
			$nombres[]=$row['nombre'];
			$curp[]=$row['curp'];
			$grupo[]=$row['gg'];
			//$gg[]=$row['gg'];
		}
		$result1 = mysqli_query($conexion,"SELECT DISTINCT CONCAT(DATE_FORMAT(fecha_inicio,'%Y'),'-',DATE_FORMAT(fecha_fin,'%Y')) as ciclo FROM `ciclo` WHERE ciclo.id = '".$ciclo."'");
		$row = mysqli_fetch_array($result1,MYSQLI_NUM);
		$ciclo_escolar=$row[0];
		
		//ESPAÑOL
		$materia=array();
		$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE (grado.id = '".$grado."') and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '3'") or die("Error 1 :".mysqli_error($conexion));
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
		for($i=0;$i<count($id);$i++){
			for($j=0;$j<count($materia);$j++){
				for($k=1;$k<=$bloque;$k++){
					$Con = mysqli_query($conexion,"select calificacionmateria.id, calificacionmateria.materia, calificacionmateria.noClases,  calificacionmateria.asistencia, calificacionmateria.evidencias, calificacionmateria.porcentajeEvidencias, calificacionmateria.knotion, calificacionmateria.porcentajeKnotion, calificacionmateria.suma, calificacionmateria.porcentajeFinal from calificacionmateria where calificacionmateria.materia = '".$materia[$j]."' AND (calificacionmateria.alumno = '".$id[$i]."') and (calificacionmateria.unidad = '".$k."') and (calificacionmateria.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
					$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
					//valores de las consultas
					if($row['materia']=='ESP001' || $row['materia']=='ESP002' || $row['materia']=='ESP003' || $row['materia']=='ESP004' || $row['materia']=='ESP005' || $row['materia']=='ESP006'){
						$enoClases[$k]=$row['noClases'];
						$easistencia[$i][$k]=$row['asistencia'];
					}
					$eevidencias[$i][$j][$k]=$row['evidencias'];
					$eporcentajeEvidencias[$i][$j][$k]=$row['porcentajeEvidencias'];
					$eknotion[$i][$j][$k]=$row['knotion'];
					$eporcentajeKnotion[$i][$j][$k]=$row['porcentajeKnotion'];
					$esuma[$i][$j][$k]=$row['suma'];
					$eporcentajeFinal[$i][$j][$k]=$row['porcentajeFinal'];
				}
			}
		}
		//INGLES
		$con1= mysqli_query($conexion,"SELECT ingles.id as ingles FROM grado, gradoingles, ingles WHERE (grado.id = '".$grado."') and (grado.id = gradoingles.grado) and (gradoingles.ingles = ingles.id)") or die("Error 1 :".mysqli_error($conexion)); 
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
		for($i=0;$i<count($id);$i++){
			for($j=1;$j<=4;$j++){
				for($k=1;$k<=$bloque;$k++){
					$Con = mysqli_query($conexion,"SELECT calificacioningles.id, calificacioningles.evidencias, calificacioningles.porcentajeEvidencias, calificacioningles.knotion, calificacioningles.porcentajeKnotion, calificacioningles.suma, calificacioningles.porcentajeFinal from calificacioningles where calificacioningles.materia = '".$ingles."' and calificacioningles.campoFormativo = '".$j."' AND (calificacioningles.alumno = '".$id[$i]."') and (calificacioningles.unidad = '".$k."') and (calificacioningles.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
					$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
					$ievidencias[$i][$j][$k]=$row['evidencias'];
					$iporcentajeEvidencias[$i][$j][$k]=$row['porcentajeEvidencias'];
					$iknotion[$i][$j][$k]=$row['knotion'];
					$iporcentajeKnotion[$i][$j][$k]=$row['porcentajeKnotion'];
					$isuma[$i][$j][$k]=$row['suma'];
					$iporcentajeFinal[$i][$j][$k]=$row['porcentajeFinal'];
				}
			}
		}
		//Artes
		if($grado==7 || $grado==8 || $grado==10 || $grado==11 || $grado==13 || $grado==14 || $grado==16 || $grado==17){
			$arte=array();
			$con1= mysqli_query($conexion,"SELECT artes.id, artes.nombre FROM artes, gradoarte, grado WHERE grado.id = ".$grado." AND grado.id = gradoarte.grado AND gradoarte.artes = artes.id") or die("Error 1 :".mysqli_error($conexion));
			while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
				$arte[]=$row[0];
			}
			$aevidencias=array();
			$aporcentajeEvidencias=array();
			for($i=0;$i<count($id);$i++){
				for($j=0;$j<count($arte);$j++){
					for($k=1;$k<=$bloque;$k++){
						$Con = mysqli_query($conexion,"SELECT calificacionartes.id, calificacionartes.evidencias, calificacionartes.porcentajeEvidencias, calificacionartes.suma, calificacionartes.porcentajeFinal from calificacionartes where calificacionartes.artes = '".$arte[$j]."' AND (calificacionartes.alumno = '".$id[$i]."') and (calificacionartes.unidad = '".$k."') and (calificacionartes.ciclo = '".$ciclo."') ") or die(mysqli_error($conexion));
						$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
						$aevidencias[$i][$j][$k]=$row['evidencias'];
						$aporcentajeEvidencias[$i][$j][$k]=$row['porcentajeEvidencias'];
					}
				}
			}
		}
		if($grado==19 || $grado==20 || $grado==22 || $grado==23){
			$aevidencias=array();
			$aporcentajeEvidencias=array();
			for($i=0;$i<count($id);$i++){
				for($k=1;$k<=$bloque;$k++){
					$Con = mysqli_query($conexion,"SELECT calificacionartes.id, calificacionartes.evidencias, calificacionartes.porcentajeEvidencias, calificacionartes.suma, calificacionartes.porcentajeFinal from calificacionartes where (calificacionartes.alumno = '".$id[$i]."') and (calificacionartes.unidad = '".$k."') and (calificacionartes.ciclo = '".$ciclo."') ") or die(mysqli_error($conexion));
					$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
					$aevidencias[$i][$k]=$row['evidencias'];
					$aporcentajeEvidencias[$i][$k]=$row['porcentajeEvidencias'];
				}
			}
		}
		//Educacion Fisica
		for($i=0;$i<count($id);$i++){
			for($k=1;$k<=$bloque;$k++){
				$Con = mysqli_query($conexion,"SELECT calificacionfisica.id, calificacionfisica.evidencias, calificacionfisica.porcentajeEvidencias, calificacionfisica.suma, calificacionfisica.porcentajeFinal from calificacionfisica where (calificacionfisica.alumno = '".$id[$i]."') and (calificacionfisica.unidad = '".$k."') and (calificacionfisica.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				//valores de las consultas
				$fevidencias[$i][$k]=$row['evidencias'];
				$fporcentajeEvidencias[$i][$k]=$row['porcentajeEvidencias'];
				$fsuma[$i][$k]=$row['suma'];
				$fporcentajeFinal[$i][$k]=$row['porcentajeFinal'];
			}
		}
		//Computacion
		for($i=0;$i<count($id);$i++){
			for($k=1;$k<=$bloque;$k++){
				$Con = mysqli_query($conexion,"SELECT calificacionclub.id, calificacionclub.evidencias, calificacionclub.porcentajeEvidencias, calificacionclub.suma, calificacionclub.porcentajeFinal from calificacionclub where (calificacionclub.alumno = '".$id[$i]."') and (calificacionclub.unidad = '".$k."') and (calificacionclub.ciclo = '".$ciclo."') ") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				//valores de las consultas
				$cevidencias[$i][$k]=$row['evidencias'];
				$cporcentajeEvidencias[$i][$k]=$row['porcentajeEvidencias'];
				$csuma[$i][$k]=$row['suma'];
				$cporcentajeFinal[$i][$k]=$row['porcentajeFinal'];
			}
		}
					
		//Calculos
		if($grado==7 || $grado==8 || $grado==10 || $grado==11 || $grado==13 || $grado==14 || $grado==16 || $grado==17){
			for($i=0;$i<count($id);$i++){
				for($k=1;$k<=$bloque;$k++){
					$sumaartes[$i][$k]=$aporcentajeEvidencias[$i][0][$k]+$aporcentajeEvidencias[$i][1][$k];
					$ape[$i][$k]=bcdiv((($sumaartes[$i][$k]*10)/100), '1', 1);
				}
			}
		}
		if($grado==19 || $grado==20 || $grado==22 || $grado==23){
			for($i=0;$i<count($id);$i++){
				for($k=1;$k<=$bloque;$k++){
					$ape[$i][$k]=bcdiv((($aporcentajeEvidencias[$i][$k]*10)/100), '1', 1);
				}
			}
		}
		for($i=0;$i<count($id);$i++){
			$nsuma1[$i]=0;
			$nsuma2[$i]=0;
			$nsuma3[$i]=0;
			$nsuma4[$i]=0;
			for($k=1;$k<=$bloque;$k++){
				//Lenguajes
				$suma1[$i][$k]=$eporcentajeFinal[$i][0][$k]+$iporcentajeFinal[$i][1][$k]+$ape[$i][$k];
				$final1[$i][$k]=round(($suma1[$i][$k]/10), 0);
				$nsuma1[$i]=$nsuma1[$i]+$final1[$i][$k];
				//saberes
				$suma2[$i][$k]=$eporcentajeFinal[$i][1][$k]+$iporcentajeFinal[$i][2][$k]+$eporcentajeFinal[$i][2][$k];
				$final2[$i][$k]=round(($suma2[$i][$k]/10), 0);
				$nsuma2[$i]=$nsuma2[$i]+$final2[$i][$k];
				//etica, naturaleza
				$suma3[$i][$k]=$eporcentajeFinal[$i][3][$k]+$iporcentajeFinal[$i][3][$k];
				$final3[$i][$k]=round(($suma3[$i][$k]/10), 0);
				$nsuma3[$i]=$nsuma3[$i]+$final3[$i][$k];
				//de lo humano
				$suma4[$i][$k]=$eporcentajeFinal[$i][4][$k]+$iporcentajeFinal[$i][4][$k]+$fporcentajeFinal[$i][$k]+$cporcentajeFinal[$i][$k];
				$final4[$i][$k]=round(($suma4[$i][$k]/10), 0);
				$nsuma4[$i]=$nsuma4[$i]+$final4[$i][$k];
			}
			$promedio1[$i]=round(($nsuma1[$i]/$bloque), 0);
			$promedio2[$i]=round(($nsuma2[$i]/$bloque), 0);
			$promedio3[$i]=round(($nsuma3[$i]/$bloque), 0);
			$promedio4[$i]=round(($nsuma4[$i]/$bloque), 0);
		}
		
		//comentarios
		for($i=0;$i<count($id);$i++){
			for($k=1;$k<=$bloque;$k++){
				//$Con = mysqli_query($conexion,"select comentarios.id, comentarios.comentario from comentarios where comentarios.tipo like '".mb_convert_encoding('Español', 'UTF-8', 'ISO-8859-1')."' AND (comentarios.alumno = '".$id[$i]."') and (comentarios.unidad = '".$k."') and (comentarios.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
				$Con = mysqli_query($conexion,"select comentarios.id, comentarios.comentario from comentarios where comentarios.tipo like 'Español' AND (comentarios.alumno = '".$id[$i]."') and (comentarios.unidad = '".$k."') and (comentarios.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				$comentarios[$i][$k]=$row['comentario']."\n";
			}
		}
		for($i=0;$i<count($id);$i++){
			for($k=1;$k<=$bloque;$k++){
				//$Con = mysqli_query($conexion,"select comentarios.id, comentarios.comentario from comentarios where comentarios.tipo = '".mb_convert_encoding('Inglés', 'UTF-8', 'ISO-8859-1')."' AND (comentarios.alumno = '".$id[$i]."') and (comentarios.unidad = '".$k."') and (comentarios.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
				$Con = mysqli_query($conexion,"select comentarios.id, comentarios.comentario from comentarios where comentarios.tipo = 'Inglés' AND (comentarios.alumno = '".$id[$i]."') and (comentarios.unidad = '".$k."') and (comentarios.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				$comentarios[$i][$k]=$comentarios[$i][$k].$row['comentario']."\n";
			}
		}
		for($i=0;$i<count($id);$i++){
			for($k=1;$k<=$bloque;$k++){
				$Con = mysqli_query($conexion,"select comentarios.id, comentarios.comentario from comentarios where comentarios.tipo = 'Taller' AND (comentarios.alumno = '".$id[$i]."') and (comentarios.unidad = '".$k."') and (comentarios.ciclo = '".$ciclo."')") or die(mysqli_error($conexion));
				$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
				$comentarios[$i][$k]=$comentarios[$i][$k].$row['comentario']."\n";
			}
		}
		
		$num_cont=0;
		for($i=0;$i<count($id);$i++){
			$pdf->AddPage('P','Letter');
			$pdf->Image('img/Boleta_2023.jpg',0,0,215,279);
			$num_cont++;
			
			$pdf->SetFont('Arial','',7.2);//cambiamos el tamaño de letra
			$pdf->Ln(13.5);//Alineamos el ciclo escolar
			$pdf->Cell(143);
			$pdf->Cell(5,5,$grupoi,0,1,'C');
			$pdf->Ln(-0.8);
			$pdf->Cell(186);
			$pdf->Cell(5,5,$ciclo_escolar,0,0,'C');
			$pdf->SetFont('Arial','',6.8);//cambiamos el tamaño de letra
			$pdf->Ln(9.2);//Alineamos el ciclo escolar
			$pdf->Cell(80);
			$pdf->Cell(5,5,$nombre[$i],0,0,'C');
			$pdf->Cell(84);
			$pdf->Cell(5,5,$curp[$i],0,1,'C');
			$pdf->Ln(3.8);
			$pdf->Cell(188);
			$pdf->Cell(5,5,$grupo[$i],0,1,'C');
			$pdf->SetFont('Arial','',8);
			if($bloque==1){
				$pdf->Ln(17);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$final1[$i][1],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$final2[$i][1],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final3[$i][1],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final4[$i][1],0,1,'C');
				$pdf->Ln(20);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$promedio1[$i],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$promedio2[$i],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$promedio3[$i],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$promedio4[$i],0,1,'C');
				$pdf->Ln(-23.5);
				$pdf->Cell(167);
				$pdf->Cell(5,5,$easistencia[$i][1],0,1,'C');
				$pdf->Ln(29);
				$pdf->Cell(9);
				$pdf->MultiCell(187,4,$comentarios[$i][1],'','J');
				$pdf->SetFont('Arial','',7);
				$pdf->Ln(123);
				$pdf->Cell(45);
				$pdf->Cell(5,5,$docente,0,1,'J');
				$pdf->Ln(2);
				$pdf->Cell(48);
				$pdf->Cell(5,5,"MARÍA ELOÍNA JIMÉNEZ DOMÍNGUEZ",0,1,'J');
				$pdf->Ln(2);
				$pdf->Cell(10);
				$pdf->Cell(50,5,"XALAPA VERACRUZ",0,1,'C');
				$pdf->Ln(1);
				$pdf->Cell(5);
				$pdf->Cell(50,5,$dia."/".$mes."/".$ano,0,1,'C');
			}
			if($bloque==2){
				$pdf->Ln(17);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$final1[$i][1],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$final2[$i][1],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final3[$i][1],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final4[$i][1],0,1,'C');
				$pdf->Ln(3);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$final1[$i][2],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$final2[$i][2],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final3[$i][2],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final4[$i][2],0,1,'C');
				$pdf->Ln(12);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$promedio1[$i],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$promedio2[$i],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$promedio3[$i],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$promedio4[$i],0,1,'C');
				$pdf->Ln(-23.5);
				$pdf->Cell(167);
				$pdf->Cell(5,5,$easistencia[$i][2],0,1,'C');
				$pdf->Ln(28);
				$pdf->Cell(9);
				$pdf->MultiCell(187,4,$comentarios[$i][1],'','J');
				$pdf->SetY(150);
				$pdf->Cell(9);
				$pdf->MultiCell(187,4,$comentarios[$i][2],'','J');
				$pdf->SetY(240);
				$pdf->Cell(45);
				$pdf->Cell(5,5,$docente,0,1,'J');
				$pdf->Ln(2);
				$pdf->Cell(48);
				$pdf->Cell(5,5,"MARÍA ELOÍNA JIMÉNEZ DOMÍNGUEZ",0,1,'J');
				$pdf->Ln(2);
				$pdf->Cell(10);
				$pdf->Cell(50,5,"XALAPA VERACRUZ",0,1,'C');
				$pdf->Ln(1);
				$pdf->Cell(5);
				$pdf->Cell(50,5,$dia."/".$mes."/".$ano,0,1,'C');
			}
			if($bloque==3){
				$pdf->Ln(17);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$final1[$i][1],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$final2[$i][1],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final3[$i][1],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final4[$i][1],0,1,'C');
				$pdf->Ln(3);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$final1[$i][2],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$final2[$i][2],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final3[$i][2],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final4[$i][2],0,1,'C');
				$pdf->Ln(4);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$final1[$i][3],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$final2[$i][3],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final3[$i][3],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$final4[$i][3],0,1,'C');
				$pdf->Ln(3.5);
				$pdf->Cell(22);
				$pdf->Cell(5,5,$promedio1[$i],0,0,'C');
				$pdf->Cell(21);
				$pdf->Cell(5,5,$promedio2[$i],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$promedio3[$i],0,0,'C');
				$pdf->Cell(20);
				$pdf->Cell(5,5,$promedio4[$i],0,1,'C');
				$pdf->Ln(-24.5);
				$pdf->Cell(167);
				$pdf->Cell(5,5,$easistencia[$i][3],0,1,'C');
				$pdf->Ln(29);
				$pdf->Cell(9);
				$pdf->MultiCell(187,4,$comentarios[$i][1],'','J');
				$pdf->Ln(35);
				$pdf->Cell(9);
				$pdf->MultiCell(187,4,$comentarios[$i][2],'','J');
				$pdf->Ln(35);
				$pdf->Cell(9);
				$pdf->MultiCell(187,4,$comentarios[$i][3],'','J');
				$pdf->Ln(37);
				$pdf->Cell(45);
				$pdf->Cell(5,5,$docente,0,1,'J');
				$pdf->Ln(2);
				$pdf->Cell(48);
				$pdf->Cell(5,5,"MARÍA ELOÍNA JIMÉNEZ DOMÍNGUEZ",0,1,'J');
				$pdf->Ln(2);
				$pdf->Cell(10);
				$pdf->Cell(50,5,"XALAPA VERACRUZ",0,1,'C');
				$pdf->Ln(1);
				$pdf->Cell(5);
				$pdf->Cell(50,5,$dia."/".$mes."/".$ano,0,1,'C');
			}
		}
	}
	$pdf->Output("Boleta_".$grupoi.".pdf",'I');
?>