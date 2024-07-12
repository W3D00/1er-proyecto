<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');

	session_start();
	error_reporting(0);
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
						<li><a href="../captura/Inicio_captura_calificaciones.php">CAPTURA DE CALIFICACIONES</a></li>
						<li><a href="../captura/Inicio_captura_comentarios_calificaciones.php">CAPTURA DE COMENTARIOS</a></li>
						<li><a href="../consultas/Inicio_consulta_calificaciones_general.php">CONSULTA DE CALIFICACIONES</a></li>
						<li><a href="../../conexion/logout.php"><img src="../../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
					</ul>
				</nav>
			</div>
			<!-- Main -->
			<!--div class="wrapper style1">
				<div class="container"-->
					<div class="row gtr-200">
						<center>
						<?php
							//Variables 
							$_SESSION["grado"]=$_POST['Grado'];
							
							$con1= mysqli_query($conexion,"SELECT unidad.id FROM unidad ,unidadperiodo ,periodocalificacion WHERE unidad.id = unidadperiodo.unidad AND unidadperiodo.periodoCalificacion = periodocalificacion.id AND DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN periodocalificacion.fecha_inicio and periodocalificacion.fecha_fin AND periodocalificacion.nivel=3") or die(mysqli_error($conexion)); 
							$unidad=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["bloque"]=$row[0];
							}
							$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
							$unidad=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["ciclo"]=$row[0];
							}
							//Consulta de mateterias
							$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE (grado.id = '".$_SESSION["grado"]."') and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave)") or die("Error 1 :".mysqli_error($conexion)); 
							$materia=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$materia[]=$row[0];
							}
							$con1= mysqli_query($conexion,"select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 
							$alumno=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
								$alumno[]=$row['id'];
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
							/*echo "<div class='col-3 col-12-mobile' id='sidebar'>
								<hr class='first' />
								<section>
									<p>
										GRUPO:".$grupo." BLOQUE:".$unidad."
									</p>
								</section>
							</div>";*/
							echo '<div class="col-8 col-12-mobile imp-mobile" id="content">
									<article id="main">
										<form id="form1" name="form1" method="post" onSubmit = "return validation(this)" action="almacenar_calificacion_primaria.php" autocomplete="off">
											<section>
												<header>
													<center>
														<h3>ASIGNATURA: ESPA&Ntilde;OL</h3><br>
														<h3>GRUPO:'.$grupo.' BLOQUE:'.$unidad.'</h3>
													</center>
												</header>
											</section>
											<p>
											<center>';
							//Consulta de terminos a evaluar
							$bloqueo=array();
							$datos=array();
							$j=0;
							for($i=0;$i<count($alumno);$i++){
								for($j=0;$j<count($materia);$j++){
									$Con = mysqli_query($conexion,"select calificacionmateria.bloquear from calificacionmateria where (calificacionmateria.materia = '".$materia[$j]."') and (calificacionmateria.alumno = '".$alumno[$i]."') and (calificacionmateria.unidad = '".$_SESSION["bloque"]."') and (calificacionmateria.ciclo = '".$_SESSION["ciclo"]."') and (calificacionmateria.bloquear = '1')") or die(mysqli_error($conexion));
									$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
									//valores de las consultas
									if(is_array($row)){
									  $bloqueo[$i]=$row['bloquear'];
									}
									//if($row['bloquear'] == 1)
										
								}
							}
							for($i=0;$i<count($alumno);$i++){
								for($j=0;$j<count($materia);$j++){
									//echo $_SESSION["ingles"];
									$Con = mysqli_query($conexion,"select calificacionmateria.id from calificacionmateria where calificacionmateria.materia = '".$materia[$j]."' AND (calificacionmateria.alumno = '".$alumno[$i]."') and (calificacionmateria.unidad = '".$_SESSION["bloque"]."') and (calificacionmateria.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
									$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
									//valores de las consultas
									if(is_array($row)){
									  $datos[$i]=$row['id'];
									}
									/*if($row['id'] != 0 ){
										$datos[$i]=$row['id'];
									}*/
								}
							}
							if(count($bloqueo) != 0){
								$con1= mysqli_query($conexion,"select distinct alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and ciclo.id = '".$_SESSION["ciclo"]."' ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 	
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
								$materia=array();
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
								
								$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
								$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
								echo "<table style='width: 10%;' width=500 align=center> 
									<tr bgcolor='A19F9F' align=center>
										<td colspan = '2'><center>N&Uacute;MERO DE CLASES</center></td>
										<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='clase' id='clase' value='".$noClases."' maxlength='5' size='5' readonly/></center></td>
										<td colspan = '2' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
										<td colspan = '4' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
										<td colspan = '2' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
										<td style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
									</tr>
									<tr bgcolor='A19F9F' align=center> 
									<td style='border:1px solid white'><center>NO</center></td> 
									<td style='border:1px solid white'><center>NOMBRE</center></td>
									<td style='border:1px solid white'><center>ASIST._</center></td>
										
									<td style='border:1px solid white' bgcolor='4DC131' title='EVIDENCIA ESPA&Ntilde;OL'><center>ESP_DC</center></td>
									<td style='border:1px solid white' bgcolor='4DC131' title='KNOTION'><center>ESP_KN</center></td>
									
									<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA MATEMATICAS'><center>MAT_DC</center></td>
									<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>MAT_KN</center></td>
										
									<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA CIENCIAS NATURALES'><center>C.N_DC</center></td>
									<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>C.N_KN</center></td>
										
									<td style='border:1px solid white' bgcolor='FCAA43' title='EVIDENCIA &Eacute;TICA, NATURALEZA Y SOCIEDADES'><center>E.N.S_DC</center></td>
									<td style='border:1px solid white' bgcolor='FCAA43' title='KNOTION'><center>E.N.S_KN</center></td>
									
									<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>E.S.E_DC</center></td>
									</tr>";
								
								//creo e inicializo la variable para contar el n\u00famero de filas 
								$num_fila = 1; 
								$i=0;
								//bucle para mostrar los resultados 
								while ($damefila=mysqli_fetch_object($result)){ 
									echo "<tr "; 
									if ($num_fila%2==0) 
										//si el resto de la divisi�n es 0 pongo un color 
										echo "bgcolor=#ADACAC";
									else 
										//si el resto de la divisi�n NO es 0 pongo otro color 
										echo "bgcolor=#E0DFDF";
									echo ">"; 
									
									$_SESSION["id"][$num_fila]=$damefila->id;
									//echo "<input type='hidden' name='ids' value='$damefila->id'>";
							
									echo"
										<td style='border:1px solid white'><font size='3'><center>$num_fila</center></font></td> 
										<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
										<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='asist[$num_fila]' id='asist[$num_fila]' value='".$asistencia[$i]."' maxlength='5' size='5' readonly/></center></td>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<input type='hidden' name='mat1[$num_fila]' id='mat1[$num_fila]' value='".$idMat[$i][0]."'>
										<center><input style='font-size:14px; font-family: arial' type='text' name='cesp[$num_fila]' id='cesp[$num_fila]' value='".$evidencias[$i][0]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pesp[$num_fila]' id='pesp[$num_fila]' value='".$porcentajeEvidencias[$i][0]."' readonly/>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='4DC131'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
										echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kesp[$num_fila]' id='kesp[$num_fila]' value='".$knotion[$i][0]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pkesp[$num_fila]' id='pkesp[$num_fila]' value='".$porcentajeKnotion[$i][0]."' readonly/>
										<input type='hidden' name='sumae[$num_fila]' id='sumae[$num_fila]' value='".$suma[$i][0]."' readonly/>
										<input type='hidden' name='fesp[$num_fila]' id='fesp[$num_fila]' value='".$porcentajeFinal[$i][0]."' readonly/>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<input type='hidden' name='mat2[$num_fila]' id='mat2[$num_fila]' value='".$idMat[$i][1]."'>
										<center><input style='font-size:14px; font-family: arial' type='text' name='cmat[$num_fila]' id='cmat[$num_fila]' value='".$evidencias[$i][1]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pmat[$num_fila]' id='pmat[$num_fila]' value='".$porcentajeEvidencias[$i][1]."' readonly/>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kmat[$num_fila]' id='kmat[$num_fila]' value='".$knotion[$i][1]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pkmat[$num_fila]' id='pkmat[$num_fila]' value='".$porcentajeKnotion[$i][1]."' readonly/>
										<input type='hidden' name='sumam[$num_fila]' id='sumam[$num_fila]' value='".$suma[$i][1]."' readonly/>
										<input type='hidden' name='fmat[$num_fila]' id='fmat[$num_fila]' value='".$porcentajeFinal[$i][1]."' readonly/>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<input type='hidden' name='mat3[$num_fila]' id='mat3[$num_fila]' value='".$idMat[$i][2]."'>
										<center><input style='font-size:14px; font-family: arial' type='text' name='ccn[$num_fila]' id='ccn[$num_fila]' value='".$evidencias[$i][2]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pcn[$num_fila]' id='pcn[$num_fila]' value='".$porcentajeEvidencias[$i][2]."' readonly/>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
										echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kcn[$num_fila]' id='kcn[$num_fila]' value='".$knotion[$i][2]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pkcn[$num_fila]' id='pkcn[$num_fila]' value='".$porcentajeKnotion[$i][2]."' readonly/>
										<input type='hidden' name='sumacn[$num_fila]' id='sumacn[$num_fila]' value='".$suma[$i][2]."' readonly/>
										<input type='hidden' name='fcn[$num_fila]' id='fcn[$num_fila]' value='".$porcentajeFinal[$i][2]."' readonly/>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<input type='hidden' name='mat4[$num_fila]' id='mat4[$num_fila]' value='".$idMat[$i][3]."'>
										<center><input style='font-size:14px; font-family: arial' type='text' name='cens[$num_fila]' id='cens[$num_fila]' value='".$evidencias[$i][3]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pens[$num_fila]' id='pens[$num_fila]' value='".$porcentajeEvidencias[$i][3]."' readonly/>";
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
										echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kens[$num_fila]' id='kens[$num_fila]' value='".$knotion[$i][3]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pkens[$num_fila]' id='pkens[$num_fila]' value='".$porcentajeKnotion[$i][3]."' readonly/>
										<input type='hidden' name='sumaens[$num_fila]' id='sumaens[$num_fila]' value='".$suma[$i][3]."' readonly/>
										<input type='hidden' name='fens[$num_fila]' id='fens[$num_fila]' value='".$porcentajeFinal[$i][3]."' readonly/>";
										
										if ($num_fila%2==0)
											echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
										else 
											echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
										echo "<center><input style='font-size:14px; font-family: arial' type='text' name='cese[$num_fila]' id='cese[$num_fila]' value='".$evidencias[$i][4]."' maxlength='5' size='5' readonly/></center></td>
										<input type='hidden' name='pese[$num_fila]' id='pese[$num_fila]' value='".$porcentajeEvidencias[$i][4]."' readonly/>
										<input type='hidden' name='sumaese[$num_fila]' id='sumaese[$num_fila]' value='".$suma[$i][4]."' readonly/>
										<input type='hidden' name='fese[$num_fila]' id='fese[$num_fila]' value='".$porcentajeFinal[$i][4]."' readonly/>
										</tr> ";
									//aumentamos en uno el n\u00famero de filas 
									$num_fila++;
									$i++;
								} //cierro el while
								echo "</table>
									</center>
									<input type='hidden' name='filas' value='$num_fila'>
									</p>
									</form>
									</article>
									</div>";
							}
							else{
								if(count($datos) != 0){//ACTUALIZAR
									$con1= mysqli_query($conexion,"select distinct alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and ciclo.id = '".$_SESSION["ciclo"]."' ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 	
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
									$materia=array();
									while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
										$materia[]=$row[0];
									}
									
									$asistencia=array();
									$idMat=array();
									$evidencias=array();
									$asistencia=array();
									$porcentajeEvidencias=array();
									$knotion=array();
									$porcentajeKnotion=array();
									$suma=array();
									$porcentajeFinal=array();
									for($i=0;$i<count($alumno);$i++){
										for($j=0;$j<count($materia);$j++){
											$scce[$j]=0;
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
									
									$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
									$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
									echo "<table style='width: 10%;' width=500 align=center> 
										<tr bgcolor='A19F9F' align=center>
											<td colspan = '2'><center>N&Uacute;MERO DE CLASES</center></td>
											<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='clase' id='clase' value='".$noClases."' maxlength='5' size='5' onFocus='javascript:this.value=\"\"'/></center></td>
											<td colspan = '2' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
											<td colspan = '4' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
											<td colspan = '2' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
											<td style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
										</tr>
										<tr bgcolor='A19F9F' align=center> 
										<td style='border:1px solid white'><center>NO</center></td> 
										<td style='border:1px solid white'><center>NOMBRE</center></td>
										<td style='border:1px solid white'><center>ASIST._</center></td>
											
										<td style='border:1px solid white' bgcolor='4DC131' title='EVIDENCIA ESPA&Ntilde;OL'><center>ESP_DC</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='KNOTION'><center>ESP_KN</center></td>
										
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA MATEMATICAS'><center>MAT_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>MAT_KN</center></td>
											
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA CIENCIAS NATURALES'><center>C.N_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>C.N_KN</center></td>
											
										<td style='border:1px solid white' bgcolor='FCAA43' title='EVIDENCIA &Eacute;TICA, NATURALEZA Y SOCIEDADES'><center>E.N.S_DC</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='KNOTION'><center>E.N.S_KN</center></td>
										
										<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>E.S.E_DC</center></td>
										</tr>";
									
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1; 
									$i=0;
									$cont1=1;
									$cont2=100;
									$cont3=200;
									$cont4=300;
									$cont5=400;
									$cont6=500;
									$cont7=600;
									$cont8=700;
									$cont9=800;
									$cont10=900;
									//bucle para mostrar los resultados 
									while ($damefila=mysqli_fetch_object($result)){ 
										echo "<tr "; 
										if ($num_fila%2==0) 
											//si el resto de la divisi�n es 0 pongo un color 
											echo "bgcolor=#ADACAC";
										else 
											//si el resto de la divisi�n NO es 0 pongo otro color 
											echo "bgcolor=#E0DFDF";
										echo ">"; 
										
										$_SESSION["id"][$num_fila]=$damefila->id;
										//echo "<input type='hidden' name='ids' value='$damefila->id'>";
								
										echo"
											<td style='border:1px solid white'><font size='3'><center>$num_fila</center></font></td>  
											<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
											<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='asist[$num_fila]' id='asist[$num_fila]' value='".$asistencia[$i]."' ONCHANGE = 'calculate1(this.id)' maxlength='5' size='5' onFocus='javascript:this.value=\"\"' tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)' /></center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<input type='hidden' name='mat1[$num_fila]' id='mat1[$num_fila]' value='".$idMat[$i][0]."'>
											<center><input style='font-size:14px; font-family: arial' type='text' name='cesp[$num_fila]' id='cesp[$num_fila]' value='".$evidencias[$i][0]."' maxlength='5' size='5' ONCHANGE = 'calculate21(this.id)' onFocus = 'javascript:this.value=\"\"' tabindex='$cont2' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pesp[$num_fila]' id='pesp[$num_fila]' value='".$porcentajeEvidencias[$i][0]."' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kesp[$num_fila]' id='kesp[$num_fila]' value='".$knotion[$i][0]."' maxlength='5' size='5' ONCHANGE = 'calculate22(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont3' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkesp[$num_fila]' id='pkesp[$num_fila]' value='".$porcentajeKnotion[$i][0]."' readonly/>
											<input type='hidden' name='sumae[$num_fila]' id='sumae[$num_fila]' value='".$suma[$i][0]."' readonly/>
											<input type='hidden' name='fesp[$num_fila]' id='fesp[$num_fila]' value='".$porcentajeFinal[$i][0]."' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<input type='hidden' name='mat2[$num_fila]' id='mat2[$num_fila]' value='".$idMat[$i][1]."'>
											<center><input style='font-size:14px; font-family: arial' type='text' name='cmat[$num_fila]' id='cmat[$num_fila]' value='".$evidencias[$i][1]."' maxlength='5' size='5' ONCHANGE = 'calculate31(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont4' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pmat[$num_fila]' id='pmat[$num_fila]' value='".$porcentajeEvidencias[$i][1]."' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kmat[$num_fila]' id='kmat[$num_fila]' value='".$knotion[$i][1]."' maxlength='5' size='5' ONCHANGE = 'calculate32(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont5' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkmat[$num_fila]' id='pkmat[$num_fila]' value='".$porcentajeKnotion[$i][1]."' readonly/>
											<input type='hidden' name='sumam[$num_fila]' id='sumam[$num_fila]' value='".$suma[$i][1]."' readonly/>
											<input type='hidden' name='fmat[$num_fila]' id='fmat[$num_fila]' value='".$porcentajeFinal[$i][1]."' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<input type='hidden' name='mat3[$num_fila]' id='mat3[$num_fila]' value='".$idMat[$i][2]."'>
											<center><input style='font-size:14px; font-family: arial' type='text' name='ccn[$num_fila]' id='ccn[$num_fila]' value='".$evidencias[$i][2]."' maxlength='5' size='5' ONCHANGE = 'calculate41(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont6' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pcn[$num_fila]' id='pcn[$num_fila]' value='".$porcentajeEvidencias[$i][2]."' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kcn[$num_fila]' id='kcn[$num_fila]' value='".$knotion[$i][2]."' maxlength='5' size='5' ONCHANGE = 'calculate42(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont7' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkcn[$num_fila]' id='pkcn[$num_fila]' value='".$porcentajeKnotion[$i][2]."' readonly/>
											<input type='hidden' name='sumacn[$num_fila]' id='sumacn[$num_fila]' value='".$suma[$i][2]."' readonly/>
											<input type='hidden' name='fcn[$num_fila]' id='fcn[$num_fila]' value='".$porcentajeFinal[$i][2]."' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<input type='hidden' name='mat4[$num_fila]' id='mat4[$num_fila]' value='".$idMat[$i][3]."'>
											<center><input style='font-size:14px; font-family: arial' type='text' name='cens[$num_fila]' id='cens[$num_fila]' value='".$evidencias[$i][3]."' maxlength='5' size='5' ONCHANGE = 'calculate51(this.id)' onFocus='javascript:this.value=\"\"'/ tabindex='$cont8' onkeydown='return simularTab(event, this, 13,37,38,39,40)'></center></td>
											<input type='hidden' name='pens[$num_fila]' id='pens[$num_fila]' value='".$porcentajeEvidencias[$i][3]."' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kens[$num_fila]' id='kens[$num_fila]' value='".$knotion[$i][3]."' maxlength='5' size='5' ONCHANGE = 'calculate52(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont9' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkens[$num_fila]' id='pkens[$num_fila]' value='".$porcentajeKnotion[$i][3]."' readonly/>
											<input type='hidden' name='sumaens[$num_fila]' id='sumaens[$num_fila]' value='".$suma[$i][3]."' readonly/>
											<input type='hidden' name='fens[$num_fila]' id='fens[$num_fila]' value='".$porcentajeFinal[$i][3]."' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<input type='hidden' name='mat5[$num_fila]' id='mat5[$num_fila]' value='".$idMat[$i][4]."'>
											<center><input style='font-size:14px; font-family: arial' type='text' name='cese[$num_fila]' id='cese[$num_fila]' value='".$evidencias[$i][4]."' maxlength='5' size='5' ONCHANGE = 'calculate6(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont10' onkeydown='return simularTab(event, this, 13,37,38,39,40)'></center></td>
											<input type='hidden' name='pese[$num_fila]' id='pese[$num_fila]' value='".$porcentajeEvidencias[$i][4]."' readonly/>
											<input type='hidden' name='sumaese[$num_fila]' id='sumaese[$num_fila]' value='".$suma[$i][4]."' readonly/>
											<input type='hidden' name='fese[$num_fila]' id='fese[$num_fila]' value='".$porcentajeFinal[$i][4]."' readonly/>
											</tr> ";
										//aumentamos en uno el n\u00famero de filas 
										$num_fila++;
										$i++;
									} //cierro el while 
									echo "</table>
										</center>
										<center>
										<input type='submit' name='Capturar' id='Capturar' value='Actualizar' tabindex='1000'/>
										</center>
										<input type='hidden' name='filas' value='$num_fila'>
										</p>
										</form>
										</article>
										</div>";
								}
								else{//CAPTURA
									$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
									$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
									echo "<table style='width: 10%;' width=500 align=center>
										<tr bgcolor='A19F9F' align=center>
											<td colspan = '2'><center>N&Uacute;MERO DE CLASES</center></td>
											<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='clase' id='clase' value='0' maxlength='5' size='5' onFocus='javascript:this.value=\"\"'/></center></td>
											<td colspan = '2' style='border:1px solid white' bgcolor='2EBF0B'><center>LENGUAJES</center></td>
											<td colspan = '4' style='border:1px solid white' bgcolor='07B1F6'><center>SABERES</center></td>
											<td colspan = '2' style='border:1px solid white' bgcolor='FD9007'><center>ENyS</center></td>
											<td style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
										</tr>
										<tr bgcolor='A19F9F' align=center> 
										<td style='border:1px solid white'><center>NO</center></td> 
										<td style='border:1px solid white'><center>NOMBRE</center></td>
										<td style='border:1px solid white'><center>ASIST._</center></td>
											
										<td style='border:1px solid white' bgcolor='4DC131' title='EVIDENCIA ESPA&Ntilde;OL'><center>ESP_DC</center></td>
										<td style='border:1px solid white' bgcolor='4DC131' title='KNOTION'><center>ESP_KN</center></td>
										
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA MATEMATICAS'><center>MAT_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>MAT_KN</center></td>
											
										<td style='border:1px solid white' bgcolor='33C1FB' title='EVIDENCIA CIENCIAS NATURALES'><center>C.N_DC</center></td>
										<td style='border:1px solid white' bgcolor='33C1FB' title='KNOTION'><center>C.N_KN</center></td>
											
										<td style='border:1px solid white' bgcolor='FCAA43' title='EVIDENCIA &Eacute;TICA, NATURALEZA Y SOCIEDADES'><center>E.N.S_DC</center></td>
										<td style='border:1px solid white' bgcolor='FCAA43' title='KNOTION'><center>E.N.S_KN</center></td>
										
										<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA EDUCACI&Oacute;N SOCIO-EMOCIONAL'><center>E.S.E_DC</center></td>
										</tr>";

									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1; 
									$cont1=1;
									$cont2=100;
									$cont3=200;
									$cont4=300;
									$cont5=400;
									$cont6=500;
									$cont7=600;
									$cont8=700;
									$cont9=800;
									$cont10=900;
									//bucle para mostrar los resultados 
									while ($damefila=mysqli_fetch_object($result)){ 
										echo "<tr "; 
										if ($num_fila%2==0) 
											//si el resto de la divisi�n es 0 pongo un color 
											echo "bgcolor=#ADACAC";
										else 
											//si el resto de la divisi�n NO es 0 pongo otro color 
											echo "bgcolor=#E0DFDF";
										echo ">"; 
										
										$_SESSION["id"][$num_fila]=$damefila->id;
										//echo "<input type='hidden' name='ids' value='$damefila->id'>";
								
										echo"
											<td style='border:1px solid white'><font size='2'>$num_fila</font></td> 
											<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
											<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='asist[$num_fila]' id='asist[$num_fila]' value='0' ONCHANGE = 'calculate1(this.id)' maxlength='5' size='5' onFocus='javascript:this.value=\"\"' tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)' /></center></td>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='cesp[$num_fila]' id='cesp[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate21(this.id)' onFocus = 'javascript:this.value=\"\"' tabindex='$cont2' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pesp[$num_fila]' id='pesp[$num_fila]' value='0' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='4DC131'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='A7F4AC'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kesp[$num_fila]' id='kesp[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate22(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont3' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkesp[$num_fila]' id='pkesp[$num_fila]' value='0' readonly/>
											<input type='hidden' name='sumae[$num_fila]' id='sumae[$num_fila]' value='0' readonly/>
											<input type='hidden' name='fesp[$num_fila]' id='fesp[$num_fila]' value='0' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='cmat[$num_fila]' id='cmat[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate31(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont4' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pmat[$num_fila]' id='pmat[$num_fila]' value='0' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kmat[$num_fila]' id='kmat[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate32(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont5' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkmat[$num_fila]' id='pkmat[$num_fila]' value='0' readonly/>
											<input type='hidden' name='sumam[$num_fila]' id='sumam[$num_fila]' value='0' readonly/>
											<input type='hidden' name='fmat[$num_fila]' id='fmat[$num_fila]' value='0' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='ccn[$num_fila]' id='ccn[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate41(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont6' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pcn[$num_fila]' id='pcn[$num_fila]' value='0' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='33C1FB'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='8FDDFD'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kcn[$num_fila]' id='kcn[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate42(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont7' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkcn[$num_fila]' id='pkcn[$num_fila]' value='0' readonly/>
											<input type='hidden' name='sumacn[$num_fila]' id='sumacn[$num_fila]' value='0' readonly/>
											<input type='hidden' name='fcn[$num_fila]' id='fcn[$num_fila]' value='0' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='cens[$num_fila]' id='cens[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate51(this.id)' onFocus='javascript:this.value=\"\"'/ tabindex='$cont8' onkeydown='return simularTab(event, this, 13,37,38,39,40)'></center></td>
											<input type='hidden' name='pens[$num_fila]' id='pens[$num_fila]' value='0' readonly/>";
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='FCAA43'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='FBC98A'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='kens[$num_fila]' id='kens[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate52(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont9' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='pkens[$num_fila]' id='pkens[$num_fila]' value='0' readonly/>
											<input type='hidden' name='sumaens[$num_fila]' id='sumaens[$num_fila]' value='0' readonly/>
											<input type='hidden' name='fens[$num_fila]' id='fens[$num_fila]' value='0' readonly/>";
											
											if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='cese[$num_fila]' id='cese[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'calculate6(this.id)' onFocus='javascript:this.value=\"\"' tabindex='$cont10' onkeydown='return simularTab(event, this, 13,37,38,39,40)'></center></td>
											<input type='hidden' name='pese[$num_fila]' id='pese[$num_fila]' value='0' readonly/>
											<input type='hidden' name='sumaese[$num_fila]' id='sumaese[$num_fila]' value='0' readonly/>
											<input type='hidden' name='fese[$num_fila]' id='fese[$num_fila]' value='0' readonly/>
											</tr> ";
										//aumentamos en uno el n\u00famero de filas 
										$num_fila++;
									} //cierro el while 
									echo "</table>
										</center>
										<center>
										<input type='submit' name='Capturar' id='Capturar' value='Capturar' tabindex='1000'/>
										</center>
										<input type='hidden' name='filas' value='$num_fila'>
										</p>
										</form>
										</article>
										</div>";
								}
							}
						?>
					</div>
				</div>
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
		<!--script type="text/javascript" src="../../estilo/js/validCampoFranz.js"></script-->
		<!--Calculos automaticos-->
		<SCRIPT>
			//Asistencia
			function calculate1(id){
				var asist = document.getElementById(id);
				var inputNum = id.split("asist")[1];
				//var por = document.getElementById("por" + inputNum);
				//var ina = document.getElementById("ina" + inputNum);
				var clase = document.getElementById("clase");
				if(parseFloat(asist.value) <= clase.value){
					/*var otro1 = parseFloat((100/(claseI.value))*(asist.value)).toFixed(1);
					if (otro1 > 100)
						por.value = dp(100);
					else	
						//por.value = Math.round(otro1);
						por.value = otro1;
					
					var resta = claseI.value - asist.value;
					ina.value = resta;*/
				}
				else{
					alert("Debe ingresar un número menor o igual al que se muestra en el total de clases impartidas.")
					asist.value='0';
				}
			}
			//ESPA�OL
			//calificacion
			function calculate21(id){
				var cesp = document.getElementById(id);
				var inputNum = id.split("cesp")[1];
				var pesp = document.getElementById("pesp" + inputNum);
				var kesp = document.getElementById("kesp" + inputNum);
				var pkesp = document.getElementById("pkesp" + inputNum);
				var sumae = document.getElementById("sumae" + inputNum);
				var fesp = document.getElementById("fesp" + inputNum);
				if(parseFloat(cesp.value) > 0 && parseFloat(cesp.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo1 = parseFloat((parseFloat(cesp.value) * 50)/10).toFixed(2);
					var arr1 = calculo1.split(".");  // declaro el array 
					var entero1= arr1[0];
					var decimal1 = arr1[1];
					var uno1 = decimal1.substring(0,1);
					var dos1=entero1+'.'+uno1;
					pesp.value=dos1;
					//calificacion knotion
					var calculo2 = parseFloat((parseFloat(kesp.value) * 50)/10).toFixed(2);
					arr2 = calculo2.split(".");  // declaro el array 
					entero2= arr2[0];
					decimal2 = arr2[1];
					uno2 = decimal2.substring(0,1);
					dos2=entero2+'.'+uno2;
					pkesp.value=dos2;
					//suma porcentajes
					sumae.value=parseFloat(parseFloat(pesp.value) + parseFloat(pkesp.value));
					var calculo3 = parseFloat(((parseFloat(pesp.value) + parseFloat(pkesp.value))*50)/100).toFixed(2);
					var arr3 = calculo3.split(".");  // declaro el array 
					var entero3= arr3[0];
					var decimal3 = arr3[1];
					var uno3 = decimal3.substring(0,1);
					var dos3=entero3+'.'+uno3;
					fesp.value=dos3;
					
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en calificación Español.")
					cesp.value='0';
				}
			}
			//knotion
			function calculate22(id){
				var kesp = document.getElementById(id);
				var inputNum = id.split("kesp")[1];
				var pkesp = document.getElementById("pkesp" + inputNum);
				var cesp = document.getElementById("cesp" + inputNum);
				var pesp = document.getElementById("pesp" + inputNum);
				var sumae = document.getElementById("sumae" + inputNum);
				var fesp = document.getElementById("fesp" + inputNum);
				if(parseFloat(kesp.value) > 0 && parseFloat(kesp.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(kesp.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pkesp.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(cesp.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pesp.value=dos;
					//suma porcentajes
					sumae.value=parseFloat(parseFloat(pesp.value) + parseFloat(pkesp.value));
					var calculo4 = parseFloat(((parseFloat(pesp.value) + parseFloat(pkesp.value))*50)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fesp.value=dos;
					
				}
				else if(parseFloat(kesp.value) == 0){
					fesp.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en Knotion.")
					kesp.value='0';
				}
			}
			//MATEMATICAS
			//calificacion
			function calculate31(id){
				var cmat = document.getElementById(id);
				var inputNum = id.split("cmat")[1];
				var pmat = document.getElementById("pmat" + inputNum);
				var kmat = document.getElementById("kmat" + inputNum);
				var pkmat = document.getElementById("pkmat" + inputNum);
				var sumam = document.getElementById("sumam" + inputNum);
				var fmat = document.getElementById("fmat" + inputNum);
				if(parseFloat(cmat.value) > 0 && parseFloat(cmat.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(cmat.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pmat.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(kmat.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pkmat.value=dos;
					//suma porcentajes
					sumam.value=parseFloat(parseFloat(pmat.value) + parseFloat(pkmat.value));
					var calculo4 = parseFloat(((parseFloat(pmat.value) + parseFloat(pkmat.value))*60)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fmat.value=dos;
					
				}
				else if(parseFloat(cmat.value) == 0){
					fmat.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en calificación Matemáticas.")
					cmat.value='0';
				}
			}
			//knotion
			function calculate32(id){
				var kmat = document.getElementById(id);
				var inputNum = id.split("kmat")[1];
				var pkmat = document.getElementById("pkmat" + inputNum);
				var cmat = document.getElementById("cmat" + inputNum);
				var pmat = document.getElementById("pmat" + inputNum);
				var sumam = document.getElementById("sumam" + inputNum);
				var fmat = document.getElementById("fmat" + inputNum);
				if(parseFloat(kmat.value) > 0 && parseFloat(kmat.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(kmat.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pkmat.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(cmat.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pmat.value=dos;
					//suma porcentajes
					sumam.value=parseFloat(parseFloat(pmat.value) + parseFloat(pkmat.value));
					var calculo4 = parseFloat(((parseFloat(pmat.value) + parseFloat(pkmat.value))*60)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fmat.value=dos;
					
				}
				else if(parseFloat(kmat.value) == 0){
					fmat.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en Knotion.")
					kmat.value='0';
				}
			}
			//CIENCIAS NATURALES
			//calificacion
			function calculate41(id){
				var ccn = document.getElementById(id);
				var inputNum = id.split("ccn")[1];
				var pcn = document.getElementById("pcn" + inputNum);
				var kcn = document.getElementById("kcn" + inputNum);
				var pkcn = document.getElementById("pkcn" + inputNum);
				var sumacn = document.getElementById("sumacn" + inputNum);
				var fcn = document.getElementById("fcn" + inputNum);
				if(parseFloat(ccn.value) > 0 && parseFloat(ccn.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(ccn.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pcn.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(kcn.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pkcn.value=dos;
					//suma porcentajes
					sumacn.value=parseFloat(parseFloat(pcn.value) + parseFloat(pkcn.value));
					var calculo4 = parseFloat(((parseFloat(pcn.value) + parseFloat(pkcn.value))*30)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fcn.value=dos;
					
				}
				else if(parseFloat(ccn.value) == 0){
					fcn.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en calificación Ciencias Naturales.")
					ccn.value='0';
				}
			}
			//knotion
			function calculate42(id){
				var kcn = document.getElementById(id);
				var inputNum = id.split("kcn")[1];
				var pkcn = document.getElementById("pkcn" + inputNum);
				var ccn = document.getElementById("ccn" + inputNum);
				var pcn = document.getElementById("pcn" + inputNum);
				var sumacn = document.getElementById("sumacn" + inputNum);
				var fcn = document.getElementById("fcn" + inputNum);
				if(parseFloat(kcn.value) > 0 && parseFloat(kcn.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(kcn.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pkcn.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(ccn.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pcn.value=dos;
					//suma porcentajes
					sumacn.value=parseFloat(parseFloat(pcn.value) + parseFloat(pkcn.value));
					var calculo4 = parseFloat(((parseFloat(pcn.value) + parseFloat(pkcn.value))*30)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fcn.value=dos;
					
				}
				else if(parseFloat(kcn.value) == 0){
					fcn.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en Knotion.")
					kcn.value='0';
				}
			}
			//�TICA, NATURALEZA Y SOCIEDADES
			//calificacion
			function calculate51(id){
				var cens = document.getElementById(id);
				var inputNum = id.split("cens")[1];
				var pens = document.getElementById("pens" + inputNum);
				var kens = document.getElementById("kens" + inputNum);
				var pkens = document.getElementById("pkens" + inputNum);
				var sumaens = document.getElementById("sumaens" + inputNum);
				var fens = document.getElementById("fens" + inputNum);
				if(parseFloat(cens.value) > 0 && parseFloat(cens.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(cens.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pens.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(kens.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pkens.value=dos;
					//suma porcentajes
					sumaens.value=parseFloat(parseFloat(pens.value) + parseFloat(pkens.value));
					var calculo4 = parseFloat(((parseFloat(pens.value) + parseFloat(pkens.value))*70)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fens.value=dos;
					
				}
				else if(parseFloat(cens.value) == 0){
					fens.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en calificación Ética, Naturaleza y Sociedades.")
					cens.value='0';
				}
			}
			//knotion
			function calculate52(id){
				var kens = document.getElementById(id);
				var inputNum = id.split("kens")[1];
				var pkens = document.getElementById("pkens" + inputNum);
				var cens = document.getElementById("cens" + inputNum);
				var pens = document.getElementById("pens" + inputNum);
				var sumaens = document.getElementById("sumaens" + inputNum);
				var fens = document.getElementById("fens" + inputNum);
				if(parseFloat(kens.value) > 0 && parseFloat(kens.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(kens.value) * 50)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pkens.value=dos;
					//calificacion knotion
					var calculo3 = parseFloat((parseFloat(cens.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pens.value=dos;
					//suma porcentajes
					sumaens.value=parseFloat(parseFloat(pens.value) + parseFloat(pkens.value));
					var calculo4 = parseFloat(((parseFloat(pens.value) + parseFloat(pkens.value))*70)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fens.value=dos;
					
				}
				else if(parseFloat(kens.value) == 0){
					fens.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en Knotion.")
					kens.value='0';
				}
			}
			//Educaci�n SOCIO-EMOCIONAL
			//calificacion
			function calculate6(id){
				var cese = document.getElementById(id);
				var inputNum = id.split("cese")[1];
				var pese = document.getElementById("pese" + inputNum);
				var kens = document.getElementById("kens" + inputNum);
				var pkens = document.getElementById("pkens" + inputNum);
				var sumaese = document.getElementById("sumaese" + inputNum);
				var fese = document.getElementById("fese" + inputNum);
				if(parseFloat(cese.value) > 0 && parseFloat(cese.value) <= parseFloat(10)){
					//calificacion espa�ol
					var calculo = parseFloat((parseFloat(cese.value) * 100)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pese.value=dos;
					//calificacion knotion
					/*var calculo3 = parseFloat((parseFloat(kens.value) * 50)/10).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pkens.value=dos;*/
					//suma porcentajes
					//sumaese.value=parseFloat(parseFloat(pese.value) + parseFloat(pkens.value));
					sumaese.value=parseFloat(parseFloat(pese.value));
					var calculo4 = parseFloat(((parseFloat(pese.value))*20)/100).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					fese.value=dos;
					
				}
				else if(parseFloat(cese.value) == 0){
					fese.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en calificación Educación Socio-Emocional.")
					cese.value='0';
				}
			}
		</SCRIPT>
		<script>
			function simularTab(evento, obj, codigo){
				var key = (evento.which) ? evento.which : evento.keyCode;
				for (var i=2; i<arguments.length; ++i) {
					if (arguments[i]==key) {
						try {
							if (evento.which) { 
								evento.which = 9; 
							} 
							else { 
								evento.keyCode = 9; 
							}
						} 
						catch(err) { 
							alert(err.description); 
						}
						obj.onkeyup = function () {
							try {
								if (evento.which) {
									evento.which = key;
								}
								else {
									evento.keyCode = key;
								}
								return true;
							} 
							catch(err) { 
								alert(err.description); 
							}
						}
						return true;
					}	
				}
				return true;				
			}
		</script>
		
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