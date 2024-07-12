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
						<li><a href="../captura/Inicio_captura_calificaciones_club.php">CAPTURA DE CALIFICACIONES</a></li>
						<li><a href="../captura/Inicio_captura_comentarios_club.php">CAPTURA DE COMENTARIOS</a></li>
						<li><a href="../consultas/Inicio_consulta_calificaciones_club.php">CONSULTA DE CALIFICACIONES</a></li>
						<li><a href="../../conexion/logout.php"><img src="../../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
					</ul>
				</nav>
			</div>
			<!-- Main -->
			<div class="wrapper style1">
				<div class="container">
					<div class="row gtr-200">
						<?php
							//Variables 
							$_SESSION["grado"]=$_POST['Grado'];
		
							$con1= mysqli_query($conexion,"SELECT unidad.id FROM unidad ,unidadperiodo ,periodocalificacion WHERE unidad.id = unidadperiodo.unidad AND unidadperiodo.periodoCalificacion = periodocalificacion.id AND DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN periodocalificacion.fecha_inicio and periodocalificacion.fecha_fin AND periodocalificacion.nivel=3") or die(mysqli_error($conexion)); 
							$unidad=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["bloque"]=$row[0];
							}
							$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["ciclo"]=$row[0];
							}
							$con1= mysqli_query($conexion,"select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 
							$alumno=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
								$alumno[] = $row['id'];
								$matricula[] = $row['matricula'];
								//$nombre[] = utf8_encode($row['nombre_completo']);
								$nombre[] = $row['nombre_completo'];
							}
							//-----------------------------//
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
							echo "<div class='col-3 col-12-mobile' id='sidebar'>
									<hr class='first' />
									<section>
										<header>
											<h3>ASIGNATURA: TALLER</h3>
										</header>
										<p>GRUPO:".$grupo." BLOQUE:".$unidad."</p>
									</section>
								</div>";
		
							$bloqueo=array();
							$datos=array();
							$j=0;
							for($i=0;$i<count($alumno);$i++){
								$Con = mysqli_query($conexion,"select comentarios.bloqueo from comentarios where (comentarios.alumno = '".$alumno[$i]."') and (comentarios.unidad = '".$_SESSION["bloque"]."') and (comentarios.ciclo = '".$_SESSION["ciclo"]."') and (comentarios.tipo = 'Taller') and (comentarios.bloqueo = '1')") or die(mysqli_error($conexion));
								$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
								if($row['bloqueo'] == 1)
									$bloqueo[$i]=$row['bloqueo'];
							}
							for($i=0;$i<count($alumno);$i++){
								$Con = mysqli_query($conexion,"select comentarios.id from comentarios where (comentarios.alumno = '".$alumno[$i]."') and (comentarios.unidad = '".$_SESSION["bloque"]."') and (comentarios.ciclo = '".$_SESSION["ciclo"]."') and (comentarios.tipo = 'Taller')") or die(mysqli_error($conexion));
								$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
								if($row['id'] != 0 ){
									$datos[$i]=$row['id'];
								}
							}
							if(count($bloqueo) != 0){
								echo "<script languaje='javascript'>alert('Ya se encuentra bloqueado');window.close();</script>";
							}
							else{
								if(count($datos) != 0){//ACTUALIZAR
									for($i=0;$i<count($alumno);$i++){
										$Con = mysqli_query($conexion,"select comentarios.id, comentarios.comentario from comentarios where comentarios.tipo = '".utf8_encode('Taller')."' AND (comentarios.alumno = '".$alumno[$i]."') and (comentarios.unidad = '".$_SESSION["bloque"]."') and (comentarios.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
										$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
										$idMat[$i]=$row['id'];
										$comentarios[$i]=$row['comentario'];
									}
									echo "<div class='col-8 col-12-mobile imp-mobile' id='content'>
											<article id='main'>
												<form id='form1' name='form1' method='post' onSubmit = 'return validation(this)' action='almacenar_comentarios_club.php' autocomplete='off'>
													<p>
													<center>";
									echo "<table width=500 align=center border='2'> 
										<tr bgcolor='bbbbbb' align=center> 
										<td style='border:1px solid white'><center>NO</center></td> 
										<td style='border:1px solid white'><center>NOMBRE</center></td>
										<td style='border:1px solid white'><center>COMENTARIO</center></td>
										</tr>";
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1; 
									$i=0;
									$cont1=1;
									//bucle para mostrar los resultados 
									for($i=0;$i<count($alumno);$i++){
										echo "<tr "; 
										if ($num_fila%2==0) 
											//si el resto de la división es 0 pongo un color 
											echo "bgcolor=#81DAF5";
										else 
											//si el resto de la división NO es 0 pongo otro color 
											echo "bgcolor=#58D3F7";
										echo ">"; 
										
										echo"
											<td style='border:1px solid white'><font size='2'>$num_fila</font></td> 
											<td nowrap style='border:1px solid white'>".$nombre[$i]."</td>
											<input type='hidden' name='h[$num_fila]' id='h[$num_fila]' value='".$idMat[$i]."'>
											<td><center><textarea name='comentarios[$num_fila]' id='comentarios[$num_fila]' MAXLENGTH='600' style='margin: 0px; width: 454px; height: 168px;'>".$comentarios[$i]."</textarea></center></td>
											</tr>";
										//aumentamos en uno el n\u00famero de filas 
										$num_fila++;
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
								else{
									echo "<div class='col-8 col-12-mobile imp-mobile' id='content'>
											<article id='main'>
												<form id='form1' name='form1' method='post' onSubmit = 'return validation(this)' action='almacenar_comentarios_club.php' autocomplete='off'>
													<p>
													<center>";
									echo "<table width=500 align=center border='2'> 
										<tr bgcolor='bbbbbb' align=center> 
										<td style='border:1px solid white'><center>NO</center></td> 
										<td style='border:1px solid white'><center>NOMBRE</center></td>
										<td style='border:1px solid white'><center>COMENTARIO</center></td>
										</tr>";
									//creo e inicializo la variable para contar el n\u00famero de filas 
									$num_fila = 1; 
									$i=0;
									$cont1=1;
									//bucle para mostrar los resultados 
									for($i=0;$i<count($alumno);$i++){
										echo "<tr "; 
										if ($num_fila%2==0) 
											//si el resto de la división es 0 pongo un color 
											echo "bgcolor=#81DAF5";
										else 
											//si el resto de la división NO es 0 pongo otro color 
											echo "bgcolor=#58D3F7";
										echo ">"; 
										$_SESSION["id"][$num_fila]=$alumno[$i];
										echo"
											<td style='border:1px solid white'><font size='2'>$num_fila</font></td> 
											<td nowrap style='border:1px solid white'>".$nombre[$i]."</td>
											<td><center><textarea name='comentarios[$num_fila]' id='comentarios[$num_fila]' MAXLENGTH='600' style='margin: 0px; width: 454px; height: 168px;'></textarea></center></td>
											</tr>";
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
		<script>
			function soloLetras(e) {
				key = e.keyCode || e.which;
				tecla = String.fromCharCode(key).toLowerCase();
				letras = "0123456789.";
				especiales = [8, 9, 37, 39, 46, 9];
				tecla_especial = false
				for(var i in especiales) {
					if(key == especiales[i]) {
						tecla_especial = true;
						break;
					}
				}
				if(letras.indexOf(tecla) == -1 && !tecla_especial)
					return false;
			}

			function limpia() {
				var val = document.getElementById("noAsistencia").value;
				var tam = val.length;
				for(i = 0; i < tam; i++) {
					if(!isNaN(val[i]))
						document.getElementById("noAsistencia").value = '';
				}
			}
		</script>  
		<!--Calculos automaticos-->
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
	</body>
</html>
<?php
	}
	else{
		 header('location:../../index.php');
	}
?>