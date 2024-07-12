<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	include "../../conexion/conexion.php";
	error_reporting(0);
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
						<li><a href='../captura/Inicio_captura_calificaciones.php'>CAPTURA DE CALIFICACIONES</a></li>
						<li><a href='../captura/Inicio_captura_comentarios_calificaciones.php'>CAPTURA DE COMENTARIOS</a></li>
						<li><a href='../consultas/Inicio_consulta_calificaciones_general.php'>CONSULTA DE CALIFICACIONES</a></li>
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
											<form id="form1" name="form1" method="post" onSubmit = "return validation(this)" action="almacenar_calificacion_primaria.php" autocomplete="off">
												<section>
													<header>
														<h3>GRUPO:'.$grupo.' BLOQUE:'.$unidad.'</h3>
													</header>
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
							$materia=array();
							$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE (grado.id = '".$_SESSION["grado"]."') and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '3'") or die("Error 1 :".mysqli_error($conexion));
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$materia[]=$row[0];
							}
							$asistencia=array();
							$idMat=array();
							$evidencias=array();
							$porcentajeEvidencias=array();
							$knotion=array();
							$porcentajeKnotion=array();
							$suma=array();
							$porcentajeFinal=array();
							for($i=0;$i<count($alumno);$i++){
								for($j=0;$j<count($materia);$j++){
									$Con = mysqli_query($conexion,"select calificacionmateria.id, calificacionmateria.materia, calificacionmateria.noClases,  calificacionmateria.asistencia, calificacionmateria.evidencias, calificacionmateria.porcentajeEvidencias, calificacionmateria.knotion, calificacionmateria.porcentajeKnotion, calificacionmateria.suma, calificacionmateria.porcentajeFinal from calificacionmateria where calificacionmateria.materia = '".$materia[$j]."' AND (calificacionmateria.alumno = '".$alumno[$i]."') and (calificacionmateria.unidad = '".$_SESSION["bloque"]."') and (calificacionmateria.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
									$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
									//valores de las consultas
									if($row['materia']=='ESP001' || $row['materia']=='ESP002' || $row['materia']=='ESP003' || $row['materia']=='ESP004' || $row['materia']=='ESP005' || $row['materia']=='ESP006'){
										$noClases=$row['noClases'];
										$asistencia[$i]=$row['asistencia'];
									}
									$idMat[$i][$j]=$row['id'];
									$evidencias[$i][$j]=$row['evidencias'];
									$porcentajeEvidencias[$i][$j]=$row['porcentajeEvidencias'];
									$knotion[$i][$j]=$row['knotion'];
									$porcentajeKnotion[$i][$j]=$row['porcentajeKnotion'];
									$suma[$i][$j]=$row['suma'];
									$porcentajeFinal[$i][$j]=$row['porcentajeFinal'];
								}
							}
							if(count($asistencia)!=0){
								$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
								$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
								echo "<table width=500 align=center> 
									<tr bgcolor='A19F9F' align=center>
										<td colspan = '2'><center>N&Uacute;MERO DE CLASES</center></td>
										<td style='border:1px solid white'><center>".$noClases."</center></td>
										<td colspan = '6' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
										<td colspan = '12' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
										<td colspan = '6' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
										<td colspan = '3' style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
									</tr>
									<tr bgcolor='A19F9F' align=center> 
										<td style='border:1px solid white'><center>NO</center></td> 
										<td style='border:1px solid white'><center>NOMBRE</center></td>
										<td style='border:1px solid white'><center>ASIST.</center></td>
											
										<td style='border:1px solid white' bgcolor='4DC131' title='EVIDENCIA ESPA&Ntilde;OL'><center>ESP_DC</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='% EVIDENCIA ESPA&Ntilde;OL'><center>%_ESP_DC</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='KNOTION'><center>ESP_KN</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='% KNOTION'><center>%_ESP_KN</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='% FINAL'><center>%_FINAL</center></td>
										
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA MATEMATICAS'><center>MAT_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% EVIDENCIA MATEMATICAS'><center>%_MAT_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>MAT_KN</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% KNOTION'><center>%_MAT_KN</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% FINAL'><center>%_FINAL</center></td>
											
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA CIENCIAS NATURALES'><center>C.N_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% EVIDENCIA CIENCIAS NATURALES'><center>%_C.N_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>C.N_KN</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% KNOTION'><center>%_C.N_KN</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='% FINAL'><center>%_FINAL</center></td>
											
										<td style='border:1px solid white' bgcolor='FCAA43' title='EVIDENCIA &Eacute;TICA, NATURALEZA Y SOCIEDADES'><center>E.N.S_DC</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='% EVIDENCIA &Eacute;TICA, NATURALEZA Y SOCIEDADES'><center>%_E.N.S_DC</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='KNOTION'><center>E.N.S_KN</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='% KNOTION'><center>%_E.N.S_KN</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='SUMA DE %'><center>SUMA_%</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='% FINAL'><center>%_FINAL</center></td>
										
										<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>EV_E.S.E.</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A' title='% EVIDENCIA EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>%_EV_E.S.E.</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A' title='% FINAL'><center>%_FINAL</center></td>
									</tr>
									<tr bgcolor='A19F9F' align=center> 
										<td colspan = '3' style='border:1px solid white'><center>M&Aacute;XIMOS</center></td>
											
										<td style='border:1px solid white' bgcolor='4DC131'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='4DC131'><center>50</center></td>
										
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>60</center></td>
											
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB'><center>30</center></td>
											
										<td style='border:1px solid white' bgcolor='FCAA43'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>50</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43'><center>70</center></td>
										
										<td style='border:1px solid white' bgcolor='F5D84A'><center>10</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A'><center>100</center></td>
										<td style='border:1px solid white' bgcolor='F5D84A'><center>20</center></td>
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
										<td style='border:1px solid white'><center>".$asistencia[$i]."</center></td>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$evidencias[$i][0]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$porcentajeEvidencias[$i][0]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$knotion[$i][0]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$porcentajeKnotion[$i][0]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$suma[$i][0]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center>".$porcentajeFinal[$i][0]."</center></td>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$evidencias[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$porcentajeEvidencias[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$knotion[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$porcentajeKnotion[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center>".$suma[$i][1]."</center></td>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
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
									//aumentamos en uno el n\u00famero de filas 
									$num_fila++;
									$i++;
								} //cierro el while 
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