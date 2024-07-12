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
									<h3><a>GENERAR BOLETA</a></h3>
								</header>
							</section>
						</div>
						<div class="col-7 col-12-mobile imp-mobile" id="content">
							<article id="main">
								<form id="form1" name="form1" method="post" action="generar_boleta.php?var1=x&amp;var2=y&amp;var3=z" target="_blanc">
									<center>
										<table>
											<?php
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
												echo "<tr>
													<td><label>REPORTE</label></td>
													<td><select name='Lado' id='Lado' style='width: auto;' type='text'>
														<option value='0'>Selecciona opci&oacute;n...</option>
														<option value='SEGUIMIENTO'>SEGUIMIENTO</option>
													</select></td></tr>";
												
												echo "<tr>
													<td>
														<label id='Nunidad'>FECHA</label>
													</td>
													<td><input type='date' name='fecha' class='fecha' value=".date("Y-m-d")."></td>
													</td>
												</tr>";
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
				$("#Nivel").change(function(event){
					var id = $("#Nivel").find(':selected').val();
					$("#Ciclo").load('../../genera/genera-select01.php?id='+id);
				});
			});
			$(document).ready(function(){
				$("#Nivel").change(function(event){
					var id = $("#Nivel").find(':selected').val();
					$("#Periodo").load('../../genera/genera-select02.php?id='+id);
				});
			});
			$(document).ready(function(){
				$("#Nivel").change(function(event){
					var id = $("#Nivel").find(':selected').val();
					$("#Grado").load('../../genera/genera-select03.php?id='+id);
				});
			});
			$(document).ready(function(){
				$("#Grado").change(function(event){
					var id = $("#Grado").find(':selected').val();
					$("#Bloque").load('../../genera/genera-select06.php?id='+id);
				});
			});
		</script>
		<!---------------------Bloquear select----------------------------------->
		<script type="text/javascript"> 
			function activar1(elemento){ 
				if(elemento.Nivel.options[elemento.Nivel.selectedIndex].text=='BACHILLERATO' || elemento.Nivel.options[elemento.Nivel.selectedIndex].text=='LICENCIATURA'){
					document.getElementById("Periodo").style.display = "inline"; 
					document.getElementById("Periodon").style.display = "inline"; 
				}
				else{ 
					document.getElementById("Periodo").style.display = "none";
					document.getElementById("Periodon").style.display = "none";
				}
			} 
			function activar2(elemento){
				if(elemento.Taller.options[elemento.Taller.selectedIndex].text=="EDUCACIÓN ARTÍSTICA"){
					document.getElementById("Artes").style.display = "inline";
				}
				else {
					document.getElementById("Artes").style.display = "none";
				}
			} 
		</script>
	</body>
</html>