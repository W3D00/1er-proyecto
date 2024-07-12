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
		<title>CESXXI - BACHILLERATO</title>
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
						<h1><a id="logo">BACHILLERATO</a></h1>
					</header>
				</div>
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="../../index.php"><img src="../../estilo/images/home.png" width="20px" height="20px"/></a></li>
						<li><a>CONSULTA DE CALIFICACIONES</a>
							<ul>
								<li><a href='../consultas/Inicio_consulta_calificaciones_campo.php'>CAMPO FORMATIVO</a></li>
								<li><a href='../consultas/Inicio_comentarios.php'>COMENTARIOS</a></li>
								<li><a href='../consultas/Inicio_consulta_promedio_escolta.php'>ESCOLTA</a></li>
							</ul>
						</li>
						<li><a href='../pdf/Inicio_reporte.php'>IMPRESI&Oacute;N DE BOLETA</a></li>
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
									<h3><a>COMENTARIOS</a></h3>
								</header>
							</section>
						</div>
						<div class="col-7 col-12-mobile imp-mobile" id="content">
							<article id="main">
								<form id="form1" name="form1" method="post" action="consulta_comentarios.php" onSubmit = "return validar(this)" enctype='multipart/form-data'>
									<?php
										// Consultar la base de datos
										$con2= mysqli_query($conexion,"SELECT periodocalificacion.id FROM periodocalificacion WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN fecha_inicio and fecha_fin") or die(mysqli_error($conexion)); 
										$unidad=array();
										while ($row = mysqli_fetch_array($con2,MYSQLI_NUM)){ 
											$calificacion=$row[0];
										}
										if(isset($calificacion)){
											echo "<center>
												<table>
												<tr>
												<td>
													<label>GRUPO</label>
												</td>
												<td>";
											// Consultar la base de datos
											$consulta_mysql="SELECT grado.id, concat(grado.grado,'', grupo.descripcion) as gg FROM nivel, nivelgrado, grado, grupo WHERE (nivel.id = 3) and (nivel.id = nivelgrado.nivel) and (nivelgrado.grado = grado.id) and (grado.grupo = grupo.id) and (grupo.descripcion <> 'U') order by gg ASC";
											$resultado_consulta_mysql=mysqli_query($conexion,$consulta_mysql);
											//mysql_close($conexion);
											echo "<select name='Grado' id='Grado' style='width: auto;'>";
											echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
											while($fila=mysqli_fetch_array($resultado_consulta_mysql,MYSQLI_ASSOC)){
												echo '<option value="'.$fila['id'].'"> '.$fila['gg'].'</option>';
											}
											echo "</select>
												</td>
												</tr>
												</table>
												</center>
												<center>
													<input type='submit' name='Inicio_Sesion' id='Inicio_Sesion' value='Cargar' />
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script language="JavaScript" type="text/JavaScript">
			$(document).ready(function(){
				$("#Grado").change(function(event){
					var id = $("#Grado").find(':selected').val();
					$("#Taller").load('../../genera/genera-select08.php?id='+id);
				});
			});
		</script>
		<!----------------------------------scrip validaciones-------------------->
		<script type="text/javascript"> 
			function validar(form1) {
				if (form1.Grado.selectedIndex=='0'){
					alert("Debe seleccionar un grado.") 
					form1.Grado.focus() 
					return (false); 
				}	
				if (form1.Taller.selectedIndex=='0'){
					alert("Debe seleccionar una materia.") 
					form1.Taller.focus() 
					return (false); 
				}
				return (true); 
			}
		</script>
	</body>
</html>