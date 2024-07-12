<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	mysqli_set_charset($conexion,'utf8');
	
	if(isset($_SESSION['userid'])){
?>
<html>
	<head>
		<title>CESXXI - PRIMARIA</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="../../estilo/images/icono.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../estilo/css/main.css" />
		<noscript><link rel="stylesheet" href="../../estilo/css/noscript.css" /></noscript>
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">
			<!-- Header -->
			<div id="header">
				<!-- Inner -->
				<div class="inner">
					<header>
						<h1><a id="logo"><img id="imagen_corp" src="../../estilo/images/cesxxi.png" width="150px" height="90px"></a></h1>
						<h1><a id="logo">PRIMARIA</a></h1>
					</header>
				</div>
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="../../index.php"><img src="../../estilo/images/home.png" width="20px" height="20px"/></a></li>
						<?php
							if($_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO'){
								echo "<li><a>CONSULTA</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_general.php'>CONSULTA DE CALIFICACIONES</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_campo.php'>CONSULTA DE CAMPO FORMATIVO</a></li>
									</ul>
								</li>
								<li><a>ACTUALIZACI&Oacute;N</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones.php'>ACTUALIZACI&Oacute;N DE CALIFICACIONES</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_comentarios.php'>ACTUALIZACI&Oacute;N DE COMENTARIOS</a></li>
									</ul>
								</li>";
							}
							if($_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO INGLES'){
								echo "<li><a>CONSULTA</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_ingles_general.php'>CONSULTA DE CALIFICACIONES</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_campo.php'>CONSULTA DE CAMPO FORMATIVO</a></li>
									</ul>
								</li>
								<li><a>ACTUALIZACI&Oacute;N</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_ingles.php'>ACTUALIZACI&Oacute;N DE CALIFICACIONES</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_comentarios_ingles.php'>ACTUALIZACI&Oacute;N DE COMENTARIOS</a></li>
									</ul>
								</li>";
							}
							if($_SESSION['puesto']=='ASESOR TECNICO DE TALLERES'){
								echo "<li><a>CONSULTA DE CALIFICACIONES</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_talleres.php'>TALLERES</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_deportes.php'>EDUCACI&Oacute;N F&Iacute;SICA</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_club.php'>TECNOLOG&Iacute;A</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_campo.php'>CONSULTA DE CAMPO FORMATIVO</a></li>
									</ul>
								</li>
								<li><a>ACTUALIZACI&Oacute;N DE CALIFICACIONES</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_talleres.php'>TALLERES</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_deportes.php'>EDUCACI&Oacute;N F&Iacute;SICA</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_club.php'>TECNOLOG&Iacute;A</a></li>
									</ul>
								</li>
								<li><a>COMENTARIOS</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_comentarios_talleres.php'>ACTUALIZACI&Oacute;N DE COMENTARIOS</a></li>
									</ul>
								</li>";
							}
							if($_SESSION['puesto']=='CONTROL ESCOLAR'){
								echo "<li><a>CONSULTA DE CALIFICACIONES</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_campo.php'>CAMPO FORMATIVO</a></li>
										<li><a href='../consultas/Inicio_comentarios.php'>COMENTARIOS</a></li>
										<li><a href='../consultas/Inicio_consulta_promedio_escolta.php'>ESCOLTA</a></li>
									</ul>
								</li>
								<li><a href='../pdf/Inicio_reporte.php'>IMPRESI&Oacute;N DE BOLETA</a></li>";
							}
							if($_SESSION['puesto']=='COORDINADOR'){
								echo "<li><a>CONSULTA DE CALIFICACIONES</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_general.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_ingles_general.php'>INGL&Eacute;S</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_campo.php'>CAMPO FORMATIVO</a></li>
									</ul>
								</li>
								<li><a>ACTUALIZAR CALIFICACIONES</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_ingles.php'>INGL&Eacute;S</a></li>
									</ul>
								</li>
								<li><a>COMENTARIOS</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_comentarios.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_comentarios_ingles.php'>INGL&Eacute;S</a></li>
									</ul>
								</li>
								<li><a href='../pdf/Inicio_reporte.php'>IMPRESI&Oacute;N DE BOLETA</a></li>";
							}
							if($_SESSION['puesto']=='ADMINISTRADOR'){
								echo "<li><a>CAPTURA DE CALIFICACIONES</a>
									<ul>
										<li><a href='../captura/Inicio_captura_calificaciones.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../captura/Inicio_captura_calificaciones_ingles.php'>INGL&Eacute;S</a></li>
										<li><a href='../captura/Inicio_captura_calificaciones_deportes.php'>EDUCACI&Oacute;N F&Iacute;SICA</a></li>
										<li><a href='../captura/Inicio_captura_calificaciones_computacion.php'>TECNOLOG&Iacute;A</a></li>
										<li><a href='../captura/Inicio_captura_calificaciones_talleres.php'>EDUCACI&Oacute;N ART&iacute;STICA</a></li>
									</ul>
								</li>
								<li><a>ACTUALIZAR DE CALIFICACIONES</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_ingles.php'>INGL&Eacute;S</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_deportes.php'>EDUCACI&Oacute;N F&Iacute;SICA</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_computacion.php'>TECNOLOG&Iacute;A</a></li>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_talleres.php'>EDUCACI&Oacute;N ART&iacute;STICA</a></li>
									</ul>
								</li>
								<li><a>CONSULTA DE CALIFICACIONES</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_general.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_ingles_general.php'>INGL&Eacute;S</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_deportes.php'>EDUCACI&Oacute;N F&Iacute;SICA</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_computacion.php'>TECNOLOG&Iacute;A</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_talleres.php'>EDUCACI&Oacute;N ART&iacute;STICA</a></li>
										<li><a href='../consultas/Inicio_consulta_promedio_artisticas.php'>PROMEDIO EDUCACI&Oacute;N ART&iacute;STICA</a></li>
										<li><a href='../consultas/Inicio_consulta_promedio_escolta.php'>ESCOLTA</a></li>
									</ul>
								</li>
								<li><a href='../pdf/Inicio_reporte.php'>IMPRESI&Oacute;N DE BOLETA</a></li>";
							}
						?>		
						<li><a href="../../conexion/logout.php"><img src="../../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
					</ul>
				</nav>
			</div>
			<!-- Main -->
			<!--div class="wrapper style1">
				<div class="container"-->
					<div class="row gtr-200">
						<?php
							$_SESSION["bloque"]=$_GET['Bloque'];
							$_SESSION["grado"]=$_GET['Grado'];
							if($_SESSION['puesto']=='CONTROL ESCOLAR' || $_SESSION['puesto']=='ADMINISTRADOR'){
								$_SESSION["ciclo"]=$_GET['Ciclo'];
							}
							else{
								$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
								$unidad=array();
								while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
									$_SESSION["ciclo"]=$row[0];
								}
							}
							if($_SESSION["bloque"] != 0 && $_SESSION["grado"]!= 0){
						
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
							
							echo '<div class="col-8 col-12-mobile imp-mobile" id="content">
										<article id="main">
											<form id="form1">
												<header>
													GRUPO:'.$grupo.' BLOQUE:'.$unidad.'<br>';
													if($_SESSION['puesto']=='ASESOR TECNICO DE TALLERES' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO INGLES' || $_SESSION['puesto']=='CONTROL ESCOLAR' || $_SESSION['puesto']=='COORDINADOR' || $_SESSION['puesto']=='ADMINISTRADOR'){
														echo "<a target='_blank' href='pdf/consulta_calificacion_primaria_general.php' style='border-radius: 5px; padding: 10px 7px; text-decoration: none; color: #fff; background-color: #333; margin: 5px;'>PDF ACTA</a>";
													}
													if($_SESSION['puesto']=='ASESOR TECNICO DE TALLERES' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO INGLES' || $_SESSION['puesto']=='COORDINADOR' || $_SESSION['puesto']=='ADMINISTRADOR'){
														echo "<a target='_blank' href='pdf/consulta_calificacion_primaria_general1.php' style='border-radius: 5px; padding: 10px 7px; text-decoration: none; color: #fff; background-color: #333; margin: 5px;'>PDF GENERAL</a>";
													}
												echo '</header>
												<p>
												<center>';
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
							
							if(count($easistencia)!=0){
								if($_SESSION['puesto']=='ASESOR TECNICO DE TALLERES' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO INGLES' || $_SESSION['puesto']=='COORDINADOR' || $_SESSION['puesto']=='ADMINISTRADOR'){
									$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
									$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
									echo "<table width=500 align=center> 
										<tr bgcolor='A19F9F' align=center>
											<td colspan = '2'><center>N&Uacute;MERO DE CLASES</center></td>
											<td style='border:1px solid white'><center>".$enoClases."</center></td>
											<td colspan = '5' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
											<td colspan = '5' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
											<td colspan = '4' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
											<td colspan = '6' style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
										</tr>
										<tr bgcolor='A19F9F' align=center> 
											<td style='border:1px solid white'><center>NO</center></td> 
											<td style='border:1px solid white'><center>NOMBRE</center></td>
											<td style='border:1px solid white'><center>ASIST.</center></td>
												
											<td style='border:1px solid white' bgcolor='4DC131' title='% FINAL ESPA&Ntilde;OL'><center>%_FINAL_ESP</center></td>
											<td style='border:1px solid white' bgcolor='4DC131' title='% FINAL INGL&Eacute;S'><center>%_FINAL_ING</center></td>
											<td style='border:1px solid white' bgcolor='4DC131' title='% FINAL ARTES'><center>%_FINAL_ART</center></td>
											<td style='border:1px solid white' bgcolor='4DC131' title='SUMA DE %'><center>SUMA_%</center></td>
											<td style='border:1px solid white' bgcolor='4DC131' title='FINAL'><center>FINAL</center></td>
											
											<td style='border:1px solid white' bgcolor='33C1FB' title='% FINAL EVIDENCIA MATEMATICAS'><center>%_FINAL_MAT</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB' title='% FINAL EVIDENCIA INGL&Eacute;S'><center>%_FINAL_ING</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB' title='% FINAL EVIDENCIA CIENCIAS NATURALES'><center>%_FINAL_C.N</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB' title='SUMA DE %'><center>SUMA_%</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB' title='FINAL'><center>FINAL</center></td>
												
											<td style='border:1px solid white' bgcolor='FCAA43' title='% FINAL EVIDENCIA &Eacute;TICA, NATURALEZA Y SOCIEDADES'><center>%_FINAL_E.N.S</center></td>
											<td style='border:1px solid white' bgcolor='FCAA43' title='% FINAL EVIDENCIA INGL&Eacute;S'><center>%_FINAL_ING</center></td>
											<td style='border:1px solid white' bgcolor='FCAA43' title='SUMA DE %'><center>SUMA_%</center></td>
											<td style='border:1px solid white' bgcolor='FCAA43' title='FINAL'><center>FINAL</center></td>
											
											<td style='border:1px solid white' bgcolor='F5D84A' title='% FINAL EVIDENCIA TECNOLOGIA'><center>%_FINAL_TEC.</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='% FINAL EVIDENCIA EDUCACI&Oacute;N FISICA'><center>%_FINAL_E.FIS.</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='% FINAL EVIDENCIA EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>%_FINAL_E.S.E.</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='% FINAL EVIDENCIA INGL&Eacute;S'><center>%_FINAL_ING</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='SUMA DE %'><center>SUMA_%</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='FINAL'><center>FINAL</center></td>
										</tr>
										<tr bgcolor='A19F9F' align=center> 
											<td colspan = '3' style='border:1px solid white'><center>M&Aacute;XIMOS</center></td>
												
											<td style='border:1px solid white' bgcolor='4DC131'><center>50</center></td>
											<td style='border:1px solid white' bgcolor='4DC131'><center>40</center></td>
											<td style='border:1px solid white' bgcolor='4DC131'><center>10</center></td>
											<td style='border:1px solid white' bgcolor='4DC131'><center></center></td>
											<td style='border:1px solid white' bgcolor='4DC131'><center></center></td>
											
											<td style='border:1px solid white' bgcolor='33C1FB'><center>60</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB'><center>30</center></td>
											<td style='border:1px solid white' bgcolor='33C1FB'><center></center></td>
											<td style='border:1px solid white' bgcolor='33C1FB'><center></center></td>
												
											<td style='border:1px solid white' bgcolor='FCAA43'><center>70</center></td>
											<td style='border:1px solid white' bgcolor='FCAA43'><center>30</center></td>
											<td style='border:1px solid white' bgcolor='FCAA43'><center></center></td>
											<td style='border:1px solid white' bgcolor='FCAA43'><center></center></td>
											
											<td style='border:1px solid white' bgcolor='F5D84A'><center>30</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A'><center>30</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A'><center>20</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A'><center>20</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A'><center></center></td>
											<td style='border:1px solid white' bgcolor='F5D84A'><center></center></td>
										</tr>";
									
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1; 
									$i=0;
									//bucle para mostrar los resultados 
									while ($damefila=mysqli_fetch_object($result)){ 
										echo "<tr "; 
										if ($num_fila%2==0) 
											//si el resto de la divisi?n es 0 pongo un color 
											echo "bgcolor=#ADACAC";
										else 
											//si el resto de la divisi?n NO es 0 pongo otro color 
											echo "bgcolor=#E0DFDF";
										echo ">"; 
										
										$_SESSION["id"][$num_fila]=$damefila->id;
										//echo "<input type='hidden' name='ids' value='$damefila->id'>";
								
										echo"
											<td style='border:1px solid white'><font size='2'><center>$num_fila</center></font></td> 
											<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
											<td style='border:1px solid white'><center>".$easistencia[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center>".$eporcentajeFinal[$i][0]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center>".$iporcentajeFinal[$i][1]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center>".$ape[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center>".$suma1[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center>".$final1[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center>".$eporcentajeFinal[$i][1]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center>".$iporcentajeFinal[$i][2]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center>".$eporcentajeFinal[$i][2]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center>".$suma2[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center>".$final2[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center>".$eporcentajeFinal[$i][3]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center>".$iporcentajeFinal[$i][3]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center>".$suma3[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center>".$final3[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$cporcentajeFinal[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$fporcentajeFinal[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$eporcentajeFinal[$i][4]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$iporcentajeFinal[$i][4]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$suma4[$i]."</center></td>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$final4[$i]."</center></td>
											</tr> ";
										//aumentamos en uno el n\u00famero de filas 
										$num_fila++;
										$i++;
									} //cierro el while 
								}
								if($_SESSION['puesto']=='CONTROL ESCOLAR'){
									$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
									$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
									echo "<table width=500 align=center> 
										<tr bgcolor='A19F9F' align=center>
											<td colspan = '2'><center>N&Uacute;MERO DE CLASES</center></td>
											<td style='border:1px solid white'><center>".$enoClases."</center></td>
											<td colspan = '1' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
											<td colspan = '1' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
											<td colspan = '1' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
											<td colspan = '1' style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
										</tr>
										<tr bgcolor='A19F9F' align=center> 
											<td style='border:1px solid white'><center>NO</center></td> 
											<td style='border:1px solid white'><center>NOMBRE</center></td>
											<td style='border:1px solid white'><center>ASIST.</center></td>
												
											<td style='border:1px solid white' bgcolor='4DC131' title='FINAL'><center>FINAL</center></td>
											
											<td style='border:1px solid white' bgcolor='33C1FB' title='FINAL'><center>FINAL</center></td>
												
											<td style='border:1px solid white' bgcolor='FCAA43' title='FINAL'><center>FINAL</center></td>
											
											<td style='border:1px solid white' bgcolor='F5D84A' title='FINAL'><center>FINAL</center></td>
										</tr>";
									
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1; 
									$i=0;
									//bucle para mostrar los resultados 
									while ($damefila=mysqli_fetch_object($result)){ 
										echo "<tr "; 
										if ($num_fila%2==0) 
											//si el resto de la divisi?n es 0 pongo un color 
											echo "bgcolor=#ADACAC";
										else 
											//si el resto de la divisi?n NO es 0 pongo otro color 
											echo "bgcolor=#E0DFDF";
										echo ">"; 
										
										$_SESSION["id"][$num_fila]=$damefila->id;
										//echo "<input type='hidden' name='ids' value='$damefila->id'>";
								
										echo"
											<td style='border:1px solid white'><font size='2'><center>$num_fila</center></font></td> 
											<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
											<td style='border:1px solid white'><center>".$easistencia[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center>".$final1[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center>".$final2[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center>".$final3[$i]."</center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center>".$final4[$i]."</center></td>
											</tr> ";
										//aumentamos en uno el n\u00famero de filas 
										$num_fila++;
										$i++;
									} //cierro el while 
								}
							}
							else{
								echo "No se cuenta con registro";
							}
						}
						else{
							header('location: Inicio_consulta_calificaciones_general.php');
						}
						echo "</form>
							</article>
							</div>";
						?>
					<!--/div>
				</div-->
			</div>
        </div>
		<!-- Scripts -->
		<script src="../../estilo/js/jquery.min.js"></script>
		<script src="../../estilo/js/jquery.dropotron.min.js"></script>
		<script src="../../estilo/js/jquery.scrolly.min.js"></script>
		<script src="../../estilo/js/jquery.scrollex.min.js"></script>
		<script src="../../estilo/js/browser.min.js"></script>
		<script src="../../estilo/js/breakpoints.min.js"></script>
		<script src="../../estilo/js/util.js"></script>
		<script src="../../estilo/js/main.js"></script>
		<!--Validar datos numericos-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script language="JavaScript"> 
			function abrir(pagina,titulo){
				window.open(pagina,titulo,'width=800,height=500,menubar=no,scrollbars=no,toolbar=no,location=no,directories=no,resizable=yes,top=0,left=0');
			}
		</script>
	</body>
</html>
<?php
	}
	else{
		 header('location:../../index.php');
	}
?>