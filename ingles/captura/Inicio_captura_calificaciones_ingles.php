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
						<li><a href="../captura/Inicio_captura_calificaciones_ingles.php">CAPTURA DE CALIFICACIONES</a></li>
						<li><a href="../captura/Inicio_captura_comentarios_ingles.php">CAPTURA DE COMENTARIOS</a></li>
						<li><a href="../consultas/Inicio_consulta_calificaciones_ingles_general.php">CONSULTA DE CALIFICACIONES</a></li>
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
									<h3><a>CAPTURA DE CALIFICACIONES</a></h3>
								</header>
							</section>
						</div>
						<div class="col-7 col-12-mobile imp-mobile" id="content">
							<article id="main">
								<form id="form1" name="form1" method="post" action="captura_calificacion_primaria_ingles.php" onSubmit = "return validar(this)" enctype='multipart/form-data'>
								<?php
									// Consultar la base de datos
									$con2= mysqli_query($conexion,"SELECT periodocalificacion.id FROM periodocalificacion WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN fecha_inicio and fecha_fin") or die(mysqli_error($conexion)); 
									while ($row = mysqli_fetch_array($con2,MYSQLI_NUM)){ 
										$calificacion=$row[0];
									}
									if(isset($calificacion)){
										echo "<center>
											<table>";
										$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
										$unidad=array();
										while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
											$ciclo=$row[0];
										}
										echo "<tr>";
										$consulta_mysql="SELECT MAX(grado.id) AS id, grupo.descripcion FROM maestro, maestroingles, ingles, gradoingles, grado, grupo WHERE maestro.clave like '".$_SESSION['clave']."' AND maestro.clave = maestroingles.maestro AND maestroingles.ingles = ingles.id AND ingles.id = gradoingles.ingles AND gradoingles.grado = grado.id AND grado.grupo = grupo.id AND (grupo.descripcion != 'U') and maestroingles.ciclo = '".$ciclo."' GROUP BY descripcion";
										$resultado_consulta_mysql=mysqli_query($conexion,$consulta_mysql);
										mysqli_close($conexion);
										echo "<td><label>GRUPO</label></td><td><select name='Grado' id='Grado' onChange='activar1(this.form)' style='width: auto;'>";
										echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
										while($fila=mysqlI_fetch_array($resultado_consulta_mysql, MYSQLI_ASSOC)){
											echo "<option value='".$fila['id']."'>".$fila['descripcion']."</option>";
										}
										echo "</select>
											</td>
											</tr>
											</table>
											</center>
											<center>
												<input type='submit' name='Inicio_Sesion' id='Inicio_Sesion' value='Cargar'/>
											</center>";
									}
									else{
										Echo "Por el momento se encuentra fuera del periodo de captura";
									}
								?>
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
		<script type="text/javascript"> 
			function validar(form1) {
				if (form1.Grado.selectedIndex=='0'){
					alert("Debe seleccionar un grado.") 
					form1.Grado.focus() 
					return (false); 
				}
				return (true); 
			}
		</script>
	</body>
</html>