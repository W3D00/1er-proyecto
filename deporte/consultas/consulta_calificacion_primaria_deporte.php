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
						<li><a href='../captura/Inicio_captura_calificaciones_deportes.php'>CAPTURA DE CALIFICACIONES</a></li>
						<li><a href='../captura/Inicio_captura_comentarios_deportes.php'>CAPTURA DE COMENTARIOS</a></li>
						<li><a href='../consultas/Inicio_consulta_calificaciones_deportes.php'>CONSULTA DE CALIFICACIONES</a></li>
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
							$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
							$unidad=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
								$_SESSION["ciclo"]=$row[0];
							}
							if($_SESSION["grado"]<18){
								$con1= mysqli_query($conexion,"SELECT DISTINCT gradoeducacionfisica.educacionFisica FROM gradoeducacionfisica WHERE gradoeducacionfisica.grado = '".$_SESSION["grado"]."'") or die(mysqli_error($conexion)); 
								$unidad=array();
								while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
									$_SESSION["deporte"]=$row[0];
								}
							}
							if($_SESSION["grado"]>18){
								$_SESSION["deporte"]=$_GET['Deporte'];
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
								case 14:
									$grupo = "3o. B";
								break;
								case 16://4o
									$grupo = "4o. A";
								break;
								case 17:
									$grupo = "4o. B";
								break;
								case 19://5o
									$grupo = "5o. A";
								break;
								case 20:
									$grupo = "5o. B";
								break;
								case 22://6o
									$grupo = "6o. A";
								break;
								case 23:
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
							if($_SESSION["grado"]<=17)
								echo '<div class="col-8 col-12-mobile imp-mobile" id="content">
									<article id="main">
										<form id="form1" name="form1" method="post" onSubmit = "return validation(this)" autocomplete="off">
											<section>
												<header>
													<h3>ASIGNATURA: EDUCACI&Oacute;N F&Iacute;SICA</h3>
												</header>
												<p>GRUPO:'.$grupo.' BLOQUE:'.$unidad.'</p>
											</section>
											<p>
											<center>';
							else{
								$con1= mysqli_query($conexion,"SELECT educacionfisica.deporte FROM educacionfisica WHERE educacionfisica.id = '".$_SESSION["deporte"]."'") or die(mysqli_error($conexion));							
								$row = mysqli_fetch_array($con1,MYSQLI_ASSOC);
								$ef = $row['deporte'];	
								echo '<div class="col-8 col-12-mobile imp-mobile" id="content">
									<article id="main">
										<form id="form1" name="form1" method="post" onSubmit = "return validation(this)" autocomplete="off">
											<section>
												<header>
													<h3>ASIGNATURA: '.$ef.'</h3>
												</header>
												<p>GRUPO:'.$grupo.' BLOQUE:'.$unidad.'</p>
											</section>
											<p>
											<center>';
							}
							if($_SESSION["grado"]>18)
								$con1= mysqli_query($conexion,"select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo, alumnofisica where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) and alumno.id = alumnofisica.alumno and alumnofisica.educacionFisica = '".$_SESSION["deporte"]."' and alumnofisica.ciclo = '".$_SESSION["ciclo"]."' ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 	
							else
								$con1= mysqli_query($conexion,"select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 	
							$alumno=array();
							$matricula=array();
							$nombre=array();
							while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
								$alumno[] = $row['id'];
								$matricula[] = $row['matricula'];
								$nombre[] = $row['nombre_completo'];
							}
							
							for($i=0;$i<count($alumno);$i++){
								$Con = mysqli_query($conexion,"SELECT calificacionfisica.id, calificacionfisica.evidencias, calificacionfisica.porcentajeEvidencias, calificacionfisica.suma, calificacionfisica.porcentajeFinal from calificacionfisica where calificacionfisica.educacionFisica = '".$_SESSION["deporte"]."' AND (calificacionfisica.alumno = '".$alumno[$i]."') and (calificacionfisica.unidad = '".$_SESSION["bloque"]."') and (calificacionfisica.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
								$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
								//valores de las consultas
								$idFis[$i]=$row['id'];
								$evidencias[$i]=$row['evidencias'];
								$porcentajeEvidencias[$i]=$row['porcentajeEvidencias'];
								$suma[$i]=$row['suma'];
								$porcentajeFinal[$i]=$row['porcentajeFinal'];
							}
							echo "<table style='width: 50%;' width=300 align=center> 
								<tr bgcolor='A19F9F' align=center>
								<td colspan = '2'></td>
								<td colspan = '2' style='border:1px solid white' bgcolor='F1CA05'><center>DHC</center></td>
								</tr>
								<tr bgcolor='A19F9F' align=center>
								<td style='border:1px solid white'><center>NO</center></td> 
								<td style='border:1px solid white'><center>NOMBRE</center></td>
								<td style='border:1px solid white' bgcolor='F5D84A' title='EVIDENCIA EDUCACI&Oacute;N F&Iacute;SICA'><center>E.FIS_DC</center></td>
								<td style='border:1px solid white' bgcolor='F5D84A' title='% EVIDENCIA EDUCACI&Oacute;N F&Iacute;SICA'><center>%_E.FIS_DC</center></td>
								</tr>
								</tr>
								<tr bgcolor='A19F9F' align=center>
								<td colspan = '2' style='border:1px solid white'><center>M&Aacute;XIMOS</center></td> 
								<td style='border:1px solid white' bgcolor='F5D84A'><center>10</center></td>
								<td style='border:1px solid white' bgcolor='F5D84A'><center>30</center></td>
								</tr>";
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
									<td style='border:1px solid white'><center>".$num_fila."</center></td> 
									<td nowrap style='border:1px solid white'>".$nombre[$i]."</td>";
								if ($num_fila%2==0)
									echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
								else 
									echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
								echo "<center>".$evidencias[$i]."</center></td>";
																	if ($num_fila%2==0)
									echo "<td style='border:1px solid white' bgcolor='F5D84A'>";
								else 
									echo "<td style='border:1px solid white' bgcolor='F8E68B'>";
								echo "<center>".$porcentajeEvidencias[$i]."</center></td>
								</tr> ";
								//aumentamos en uno el número de filas 
								$num_fila++;
							} //cierro el for
							echo "</table>
								</center>
								</p>
								</form>
								</article>
								</div>";
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
	</body>
</html>
<?php
	}
	else{
		 header('location:../../index.php');
	}
?>