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
						?>		
						<li><a href="../../conexion/logout.php"><img src="../../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
					</ul>
				</nav>
			</div>
			<!-- Main -->
			<div class="wrapper style1">
				<div class="container">
					<div class="row gtr-200">
						<div class="col-3 col-12-mobile" id="sidebar">
							<hr class="first" />
							<section>
								<header>
									<h3><a>CONSULTA DE CALIFICACIONES</a></h3>
								</header>
							</section>
						</div>
						<div class="col-7 col-12-mobile imp-mobile" id="content">
							<article id="main">
								<form id="form1" name="form1" method="GET" action="consulta_calificacion_campo.php" onSubmit = "return validar(this)" enctype='multipart/form-data'>
									<center>
										<table>
											<?php
												if($_SESSION['puesto']=='ASESOR TECNICO DE TALLERES' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO' || $_SESSION['puesto']=='APOYO TECNICO PEDAGOGICO INGLES' || $_SESSION['puesto']=='COORDINADOR'){
													$consulta_mysql="SELECT grado.id, concat(grado.grado,'', grupo.descripcion) as gg FROM nivel, nivelgrado, grado, grupo WHERE (nivel.id = 3) and (nivel.id = nivelgrado.nivel) and (nivelgrado.grado = grado.id) and (grado.grupo = grupo.id) and (grupo.descripcion <> 'U') order by gg ASC";
													$resultado_consulta_mysql=mysqli_query($conexion,$consulta_mysql);
													//mysql_close($conexion);
													echo "<tr><td><label>GRUPO</label></td><td><select name='Grado' id='Grado' onChange='activar1(this.form)' style='width: auto;' type='text'>";
													echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
													while($fila=mysqli_fetch_array($resultado_consulta_mysql,MYSQLI_ASSOC)){
														echo "<option value='".$fila['id']."'>".$fila['gg']."</option>";
													}
													echo "</select></td></tr>
														<tr>
														<td><label>BLOQUE</label></td>
														<td><select name='Bloque' id='Bloque' style='width: auto;' type='text'>
														<option value='0'>Selecciona opci&oacute;n...</option>
														</select></td></tr>";
												}
												if($_SESSION['puesto']=='CONTROL ESCOLAR'){
													$consulta_mysql="SELECT ciclo.id, DATE_FORMAT(ciclo.fecha_inicio,'%Y') as fechainicio, DATE_FORMAT(ciclo.fecha_fin,'%Y') as fechafin FROM nivel, nivelciclo, ciclo WHERE (nivel.id = 3) and (nivel.id = nivelciclo.nivel) and (nivelciclo.ciclo = ciclo.id) ORDER BY ciclo DESC";
													$resultado_consulta_mysql=mysqli_query($conexion,$consulta_mysql);
													echo "<tr><td><label>CICLO</label></td><td><select name='Ciclo' id='Ciclo' onChange='activar1(this.form)' style='width: auto;' type='text'>";
													echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
													while($fila=mysqli_fetch_array($resultado_consulta_mysql,MYSQLI_ASSOC)){
														echo '<option value="'.$fila['id'].'"> CICLO '.$fila['fechainicio'].'-'.$fila['fechafin'].'</option>';
													}
													echo "</select></td></tr>";
													$consulta_mysql="SELECT grado.id, concat(grado.grado,'', grupo.descripcion) as gg FROM nivel, nivelgrado, grado, grupo WHERE (nivel.id = 3) and (nivel.id = nivelgrado.nivel) and (nivelgrado.grado = grado.id) and (grado.grupo = grupo.id) and (grupo.descripcion <> 'U') order by gg ASC";
													$resultado_consulta_mysql=mysqli_query($conexion,$consulta_mysql);
													mysqli_close($conexion);
													echo "<tr><td><label>GRUPO</label></td><td><select name='Grado' id='Grado' onChange='activar1(this.form)' style='width: auto;' type='text'>";
													echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
													while($fila=mysqli_fetch_array($resultado_consulta_mysql,MYSQLI_ASSOC)){
														echo "<option value='".$fila['id']."'>".$fila['gg']."</option>";
													}
													echo "</select></td></tr>
														<tr>
														<td><label>BLOQUE</label></td>
														<td><select name='Bloque' id='Bloque' style='width: auto;' type='text'>
														<option value='0'>Selecciona opci&oacute;n...</option>
														</select></td></tr>";
												}
											?>
										</table>
									</center>
									<center>
										<input type="submit" name="Inicio_Sesion" id="Inicio_Sesion" value="Cargar" />
									</center>
								</form>
							</article>
						</div>
					</div>
				</div>
			</div>
        </div>
		<?php
			}else {
				header("location:../../index.php");
			}
		?>
		<!-- Scripts -->
		<script src="../../estilo/js/jquery.min.js"></script>
		<script src="../../estilo/js/jquery.dropotron.min.js"></script>
		<script src="../../estilo/js/jquery.scrolly.min.js"></script>
		<script src="../../estilo/js/jquery.scrollex.min.js"></script>
		<script src="../../estilo/js/browser.min.js"></script>
		<script src="../../estilo/js/breakpoints.min.js"></script>
		<script src="../../estilo/js/util.js"></script>
		<script src="../../estilo/js/main.js"></script>
		<!------------------------autocompletamiento en campos de localidad------->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script language="JavaScript" type="text/JavaScript">
			$(document).ready(function(){
				$("#Grado").change(function(event){
					var id = $("#Grado").find(':selected').val();
					$("#Bloque").load('../../genera/genera-select06.php?id='+id);
				});
			});
		</script>
		<!----------------------------------scrip validaciones-------------------->
		<script type="text/javascript"> 
			function validar(form1) {
				if (form1.Ciclo.selectedIndex==0){ 
					alert("Debe seleccionar un ciclo.") 
					form1.Ciclo.focus() 
					return (false); 
				} 
				if (form1.Grado.selectedIndex=='0'){
					alert("Debe seleccionar un grado.") 
					form1.Grado.focus() 
					return (false); 
				}
				if (form1.Bloque.selectedIndex=='0'){
					alert("Debe seleccionar un bloque.") 
					form1.Bloque.focus() 
					return (false); 
				}	
				return (true); 
			}
		</script>
	</body>
</html>