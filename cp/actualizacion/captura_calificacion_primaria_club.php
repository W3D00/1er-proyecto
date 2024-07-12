<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	mysqli_set_charset($conexion,'utf8');
	
	if(isset($_SESSION['userid'])){
		
		$_SESSION["grado"]=$_POST['Grado'];
		$_SESSION["club"]=$_POST['Taller'];
		
		$con1= mysqli_query($conexion,"SELECT club.club FROM club WHERE club.id = '".$_SESSION["club"]."'") or die(mysqli_error($conexion));							
		$row = mysqli_fetch_array($con1,MYSQLI_ASSOC);
		$nombreclub = $row['club'];	
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
						<li><a>CONSULTA DE CALIFICACIONES</a>
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
						</li>
						<li><a href="../../conexion/logout.php"><img src="../../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
					</ul>
				</nav>
			</div>
			<!-- Main -->
			<!--div class="wrapper style1">
				<div class="container"-->
					<div class="row gtr-200">
						<?php
							//Variables
							$_SESSION["grado"]=$_POST['Grado'];
							$_SESSION["club"]=$_POST['Taller'];
							$con1= mysqli_query($conexion,"SELECT unidad.id FROM unidad ,unidadperiodo ,periodocalificacion WHERE unidad.id = unidadperiodo.unidad AND unidadperiodo.periodoCalificacion = periodocalificacion.id AND DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN periodocalificacion.fecha_inicio and periodocalificacion.fecha_fin AND periodocalificacion.nivel=3") or die(mysqli_error($conexion)); 
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["bloque"]=$row[0];
							}
							$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["ciclo"]=$row[0];
							}
							$con1= mysqli_query($conexion,"SELECT club.club FROM club  WHERE club.id = '".$_SESSION['club']."'") or die(mysqli_error($conexion)); 
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["nombreclub"]=$row[0];
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
										<header>
											<h3>ASIGNATURA: ".$_SESSION["nombreclub"]."</h3>
										</header>
										<p>GRUPO:".$grupo." BLOQUE:".$unidad."</p>
									</section>
								</div>";*/
							echo '<div class="col-8 col-12-mobile imp-mobile" id="content">
									<article id="main">
										<form id="form1" name="form1" method="post" onSubmit = "return validation(this)" action="almacenar_calificacion_primaria_club.php" autocomplete="off">
											<section>
												<header>
													<h3>ASIGNATURA: '.$_SESSION["nombreclub"].'</h3>
												</header>
												<p>GRUPO:'.$grupo.' BLOQUE:'.$unidad.'</p>
											</section>
											<p>
											<center>';
		
							$con1= mysqli_query($conexion,"select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 
							$alumno=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
								$alumno[]=$row['id'];
							}
							//Consulta de terminos a evaluar
							$bloqueo=array();
							$datos=array();
							$j=0;
							for($i=0;$i<count($alumno);$i++){
								$Con = mysqli_query($conexion,"select calificacionclub.bloquear from calificacionclub where calificacionclub.club = '".$_SESSION["club"]."' AND (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."') and (calificacionclub.bloquear = '1')") or die(mysqli_error($conexion));
								$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
								//valores de las consultas
								if(is_array($row)){
									$bloqueo[$i]=$row['bloquear'];
								}
							}
							for($i=0;$i<count($alumno);$i++){
								$Con = mysqli_query($conexion,"select calificacionclub.id from calificacionclub where calificacionclub.club = '".$_SESSION["club"]."' AND (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
								$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
								//valores de las consultas
								if(is_array($row)){
									$datos[$i]=$row['id'];
								}
							}
							if(count($bloqueo) != 0){
								for($i=0;$i<count($alumno);$i++){
										$Con = mysqli_query($conexion,"SELECT calificacionclub.id, calificacionclub.evidencias, calificacionclub.porcentajeEvidencias, calificacionclub.suma, calificacionclub.porcentajeFinal from calificacionclub where calificacionclub.club = '".$_SESSION["club"]."' AND (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."') ") or die(mysqli_error($conexion));
										$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
										//valores de las consultas
										$idClub[$i]=$row['id'];
										$evidencias[$i]=$row['evidencias'];
										$porcentajeEvidencias[$i]=$row['porcentajeEvidencias'];
										$suma[$i]=$row['suma'];
										$porcentajeFinal[$i]=$row['porcentajeFinal'];
									}
									////AQUI LA SENTENCIA SQL////////
									$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
									$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
									echo "<table style='width: 50%;' width=300 align=center> 
											<tr bgcolor='A19F9F' align=center>
											<td colspan = '2'></td>
											<td style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
											</tr>
											<tr bgcolor='A19F9F' align=center>
											<td style='border:1px solid white'><center>NO</center></td> 
											<td style='border:1px solid white'><center>NOMBRE</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA TECNOLOG&Iacute;A'><center>TEC_DC</center></td>
											</tr>";
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1;
									$j = 0;					
									$cont1=1;
									$cont2=100;
									$cont3=200;
									//bucle para mostrar los resultados 
									while ($damefila=mysqli_fetch_object($result)){ 
										echo "<tr "; 
											if ($num_fila%2==0) 
												//si el resto de la división es 0 pongo un color 
												echo "bgcolor=#ADACAC";
											else 
												//si el resto de la división NO es 0 pongo otro color 
												echo "bgcolor=#E0DFDF";
											echo ">"; 
											
											$_SESSION["id"][$num_fila]=$damefila->id;
											$_SESSION["fila"]=$num_fila;
											
											echo"
												<td style='border:1px solid white'><center>$num_fila</center></td> 
												<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
												<input type='hidden' name='idClub[$num_fila]' id='idClub[$num_fila]' value='".$idClub[$j]."'>";
										if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='tec[$num_fila]' id='tec[$num_fila]' value='".$evidencias[$j]."' maxlength='5' size='5' ONCHANGE = 'calculate(this.id)' readonly/></center></td>
											<input type='hidden' name='ptec[$num_fila]' id='ptec[$num_fila]' value='".$porcentajeEvidencias[$j]."' readonly/>
											<input type='hidden' name='sumatec[$num_fila]' id='sumatec[$num_fila]' value='".$suma[$j]."' readonly/>
											<input type='hidden' name='ftec[$num_fila]' id='ftec[$num_fila]' value='".$porcentajeFinal[$j]."' readonly/>
											</tr> ";
										//aumentamos en uno el n\u00famero de filas 
						
										$num_fila++;
										$j++;
									} //cierro el while 
									echo "</table>
										</center>
										<center>
										<input type='submit' name='Capturar' id='Capturar' value='Desbloquear'/>
										</center>
										<input type='hidden' name='filas' value='$num_fila'>
										</p>
										</form>
										</article>
										</div>";
							}
							else{
								if(count($datos) != 0){
									for($i=0;$i<count($alumno);$i++){
										$Con = mysqli_query($conexion,"SELECT calificacionclub.id, calificacionclub.evidencias, calificacionclub.porcentajeEvidencias, calificacionclub.suma, calificacionclub.porcentajeFinal from calificacionclub where calificacionclub.club = '".$_SESSION["club"]."' AND (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."') ") or die(mysqli_error($conexion));
										$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
										//valores de las consultas
										$idClub[$i]=$row['id'];
										$evidencias[$i]=$row['evidencias'];
										$porcentajeEvidencias[$i]=$row['porcentajeEvidencias'];
										$suma[$i]=$row['suma'];
										$porcentajeFinal[$i]=$row['porcentajeFinal'];
									}
									////AQUI LA SENTENCIA SQL////////
									$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
									$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
									echo "<table style='width: 50%;' width=300 align=center> 
											<tr bgcolor='A19F9F' align=center>
											<td colspan = '2'></td>
											<td style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
											</tr>
											<tr bgcolor='A19F9F' align=center>
											<td style='border:1px solid white'><center>NO</center></td> 
											<td style='border:1px solid white'><center>NOMBRE</center></td>
											<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA TECNOLOG&Iacute;A'><center>TEC_DC</center></td>
											</tr>";
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1;
									$j = 0;					
									$cont1=1;
									$cont2=100;
									$cont3=200;
									//bucle para mostrar los resultados 
									while ($damefila=mysqli_fetch_object($result)){ 
										echo "<tr "; 
											if ($num_fila%2==0) 
												//si el resto de la división es 0 pongo un color 
												echo "bgcolor=#ADACAC";
											else 
												//si el resto de la división NO es 0 pongo otro color 
												echo "bgcolor=#E0DFDF";
											echo ">"; 
											
											$_SESSION["id"][$num_fila]=$damefila->id;
											$_SESSION["fila"]=$num_fila;
											
											echo"
												<td style='border:1px solid white'><center>$num_fila</center></td> 
												<td nowrap style='border:1px solid white'>$damefila->nombre_completo</td>
												<input type='hidden' name='idClub[$num_fila]' id='idClub[$num_fila]' value='".$idClub[$j]."'>";
										if ($num_fila%2==0)
												echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
											else 
												echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
											echo "<center><input style='font-size:14px; font-family: arial' type='text' name='tec[$num_fila]' id='tec[$num_fila]' value='".$evidencias[$j]."' maxlength='5' size='5' ONCHANGE = 'calculate(this.id)' onkeypress='return'  onFocus='javascript:this.value=\"\"' tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
											<input type='hidden' name='ptec[$num_fila]' id='ptec[$num_fila]' value='".$porcentajeEvidencias[$j]."' readonly/>
											<input type='hidden' name='sumatec[$num_fila]' id='sumatec[$num_fila]' value='".$suma[$j]."' readonly/>
											<input type='hidden' name='ftec[$num_fila]' id='ftec[$num_fila]' value='".$porcentajeFinal[$j]."' readonly/>
											</tr> ";
										//aumentamos en uno el n\u00famero de filas 
						
										$num_fila++;
										$j++;
									} //cierro el while 
									echo "</table>
										</center>
										<center>
										<input type='submit' name='Capturar' id='Capturar' value='Actualizar'/>
										<input type='submit' name='Capturar' id='Capturar' value='Bloquear'/>
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
		<!--Validar datos numericos-->
		<script>
			function calculate(id){
				var tec = document.getElementById(id);
				var inputNum = id.split("tec")[1];
				var ptec = document.getElementById("ptec" + inputNum);
				var sumatec = document.getElementById("sumatec" + inputNum);
				var ftec = document.getElementById("ftec" + inputNum);
				if(parseFloat(tec.value) > 0 && parseFloat(tec.value) <= parseFloat(10)){
					var calculo = parseFloat((parseFloat(tec.value) * 30)/10).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptec.value=dos;
					sumatec.value=dos;
					ftec.value=dos;
				}
				//calculo de desarrollo personal y social
				else if(parseFloat(tec.value) == 0){
					ftec.value = '0';
				}
				else{
					alert("Debe ingresar un número menor o igual a 10 en la calificación de Educación Física.")
					tec.value='0';
				}
			}
		</script>
		<script>
			function simularTab(evento, obj, codigo){
				var key = (evento.which) ? evento.which : evento.keyCode;
				for (var i=2; i<arguments.length; ++i) {
					if (arguments[i]==key) {
						try {
							if (evento.which) { evento.which = 9; } else { evento.keyCode = 9; }
						} catch(err) { alert(err.description); }
						obj.onkeyup = function () {
							try {
								if (evento.which) {
									evento.which = key;
								}
								else {
									evento.keyCode = key;
								}
								return true;
							} catch(err) { alert(err.description); }
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