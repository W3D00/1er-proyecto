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
							if($_SESSION['puesto']=='CONTROL ESCOLAR'){
								echo "<li><a>CONSULTA DE CALIFICACIONES</a>
									<ul>
										<li><a href='../consultas/Inicio_consulta_calificaciones_general.php'>ESPA&Ntilde;OL</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_ingles_general.php'>INGL&Eacute;S</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_deportes.php'>EDUCACI&Oacute;N F&Iacute;SICA</a></li>
										<!--li><a href='../consultas/Inicio_consulta_calificaciones_computacion.php'>COMPUTACI&Oacute;N</a></li-->
										<li><a href='../consultas/Inicio_consulta_calificaciones_club.php'>CLUB</a></li>
										<li><a href='../consultas/Inicio_consulta_calificaciones_talleres.php'>EDUCACI&Oacute;N ART&iacute;STICA</a></li>
										<li><a href='../consultas/Inicio_consulta_promedio_artisticas.php'>PROMEDIO EDUCACI&Oacute;N ART&iacute;STICA</a></li>
										<li><a href='../consultas/Inicio_consulta_promedio_escolta.php'>ESCOLTA</a></li>
									</ul>
								</li>
								<li><a>BLOQUEAR</a>
									<ul>
										<li><a href='../actualizacion/Inicio_actualizar_calificaciones_ingles.php'>INGL&Eacute;S</a></li>
									</ul>
								</li>
								<li><a>CAPTURA</a>
									<ul>
										<li><a href='../captura/Inicio_captura_asistencia.php'>ASISTENCIA</a></li>
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
								while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
									$_SESSION["ciclo"]=$row[0];
								}
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
							
							echo '<div class="col-8 col-12-mobile imp-mobile" id="content">
									<article id="main">
										<form id="form1" name="form1" method="post" onSubmit = "return validation(this)" action="almacenar_calificacion_primaria_ingles.php" autocomplete="off">
											<section>
												<header>
													<h3>ASIGNATURA: INGL&Eacute;S</h3>
												</header>
												<p>GRUPO:'.$grupo.' BLOQUE:'.$unidad.'</p>
											</section>
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
							$con1= mysqli_query($conexion,"SELECT ingles.id as ingles FROM grado, gradoingles, ingles WHERE (grado.id = '".$_SESSION["grado"]."') and (grado.id = gradoingles.grado) and (gradoingles.ingles = ingles.id)") or die("Error 1 :".mysqli_error($conexion)); 
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$ingles=$row[0];
							}
							$idMat=array();
							$evidencias=array();
							$asistencia=array();
							$porcentajeEvidencias=array();
							$knotion=array();
							$porcentajeKnotion=array();
							$suma=array();
							$porcentajeFinal=array();
							$nalumno=count($alumno);
							$j=0;
							for($i=0;$i<count($alumno);$i++){
								for($j=1;$j<=4;$j++){
									$Con = mysqli_query($conexion,"SELECT calificacioningles.id, calificacioningles.evidencias, calificacioningles.porcentajeEvidencias, calificacioningles.knotion, calificacioningles.porcentajeKnotion, calificacioningles.suma, calificacioningles.porcentajeFinal from calificacioningles where calificacioningles.materia = '".$ingles."' and calificacioningles.campoFormativo = '".$j."' AND (calificacioningles.alumno = '".$alumno[$i]."') and (calificacioningles.unidad = '".$_SESSION["bloque"]."') and (calificacioningles.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
									$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
									$idMat[$i][$j]=$row['id'];
									$evidencias[$i][$j]=$row['evidencias'];
									$porcentajeEvidencias[$i][$j]=$row['porcentajeEvidencias'];
									$knotion[$i][$j]=$row['knotion'];
									$porcentajeKnotion[$i][$j]=$row['porcentajeKnotion'];
									$suma[$i][$j]=$row['suma'];
									$porcentajeFinal[$i][$j]=$row['porcentajeFinal'];
								}
							}
						
							if(count($idMat)!=0){		
								echo "<table width=500 align=center> 
									<tr bgcolor='A19F9F' align=center>
										<td colspan = '2'></td>
										<td colspan = '6' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
										<td colspan = '6' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
										<td colspan = '6' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
										<td colspan = '3' style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
									</tr>
									<tr bgcolor='A19F9F' align=center> 
										<td style='border:1px solid white'><center>NO</center></td> 
										<td style='border:1px solid white'><center>NOMBRE</center></td>
											
										<td style='border:1px solid white' bgcolor='4DC131' title='EVIDENCIA INGL&Eacute;S'><center>ING_DC</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='% EVIDENCIA INGL&Eacute;S'><center>%_ING_DC</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='KNOTION'><center>ING_KN</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='% KNOTION'><center>%_ESP_KN</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='% FINAL'><center>%_FINAL</center></td>
										
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA INGL&Eacute;S'><center>ING_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% EVIDENCIA INGL&Eacute;S'><center>%_ING_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>ING_KN</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% KNOTION'><center>%_ESP_KN</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% FINAL'><center>%_FINAL</center></td>
											
										<td style='border:1px solid white' bgcolor='FCAA43' title='EVIDENCIA INGL&Eacute;S'><center>ING_DC</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='% EVIDENCIA INGL&Eacute;S'><center>%_ING_DC</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='KNOTION'><center>ING_KN</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='% KNOTION'><center>%_ESP_KN</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='% FINAL'><center>%_FINAL</center></td>
										
										<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA INGL&Eacute;S EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>I.E.S.E_DC</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A' title='% EVIDENCIA INGL&Eacute;S EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>%_I.E.S.E_DC</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A' title='% FINAL'><center>%_FINAL</center></td>
									</tr>
									<tr bgcolor='A19F9F' align=center> 
										<td colspan = '2' style='border:1px solid white'><center>M&Aacute;XIMOS</center></td>
											
										<td style='border:1px solid white' bgcolor='4DC131'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>40</center></td>
										
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
											
										<td style='border:1px solid white' bgcolor='FCAA43'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>30</center></td>
										
										<td style='border:1px solid white' bgcolor='F5D84A'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A'><center>20</center></td>
									</tr>
									";
								$num_fila = 1; 
								//bucle para mostrar los resultados 
								for($i=0;$i<count($alumno);$i++){
									echo "<tr "; 
									if ($num_fila%2==0) 
										//si el resto de la división es 0 pongo un color 
										echo "bgcolor=#ADACAC";
									else 
										//si el resto de la división NO es 0 pongo otro color 
										echo "bgcolor=#E0DFDF";
									echo ">"; 
									echo"
										<td style='border:1px solid white'><font size='2'><center>".$num_fila."</center></font></td> 
										<td nowrap style='border:1px solid white'>".$nombre[$i]."</td>
										";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$evidencias[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$porcentajeEvidencias[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$knotion[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$porcentajeKnotion[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$suma[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$porcentajeFinal[$i][1]."</center></td>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$evidencias[$i][2]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$porcentajeEvidencias[$i][2]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$knotion[$i][2]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$porcentajeKnotion[$i][2]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$suma[$i][2]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$porcentajeFinal[$i][2]."</center></td>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center>".$evidencias[$i][3]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center>".$porcentajeEvidencias[$i][3]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center>".$knotion[$i][3]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center>".$porcentajeKnotion[$i][3]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center>".$suma[$i][3]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center>".$porcentajeFinal[$i][3]."</center></td>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
										echo "<center>".$evidencias[$i][4]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
										echo "<center>".$porcentajeEvidencias[$i][4]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
										echo "<center>".$porcentajeFinal[$i][4]."</center></td>
										</tr> ";
									//aumentamos en uno el número de filas 
									$num_fila++;
								} //cierro el for
								
								echo"</table>
									</center>
									</p>
									</form>
									</article>
									</div>";
							}
							else{
								echo "No se cuenta con registro";
							}
						?>
					</div>
				<!--/div>
			</div-->
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