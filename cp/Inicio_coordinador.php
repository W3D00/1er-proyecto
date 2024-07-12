<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	error_reporting(0);
	include_once "../conexion/conexion.php";
	
	if(isset($_SESSION['userid'])){
?>
<html>
	<head>
		<title>CESXXI - PRIMARIA</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="../estilo/images/icono.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../estilo/css/main.css" />
		<noscript><link rel="stylesheet" href="../estilo/css/noscript.css" /></noscript>
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">
			<!-- Header -->
			<div id="header">
				<!-- Inner -->
				<div class="inner">
					<header>
						<h1><a id="logo"><img id="imagen_corp" src="../estilo/images/cesxxi.png" width="150px" height="90px"></a></h1>
						<h1><a id="logo">PRIMARIA</a></h1>
					</header>
				</div>
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="../index.php"><img src="../estilo/images/home.png" width="20px" height="20px"/></a></li>
						<li><a>CONSULTA DE CALIFICACIONES</a>
							<ul>
								<li><a href="consultas/Inicio_consulta_calificaciones_general.php">ESPA&Ntilde;OL</a></li>
								<li><a href="consultas/Inicio_consulta_calificaciones_ingles_general.php">INGL&Eacute;S</a></li>
								<li><a href='consultas/Inicio_consulta_calificaciones_campo.php'>CAMPO FORMATIVO</a></li>
							</ul>
						</li>
						<li><a>ACTUALIZAR CALIFICACIONES</a>
							<ul>
								<li><a href='actualizacion/Inicio_actualizar_calificaciones.php'>ESPA&Ntilde;OL</a></li>
								<li><a href='actualizacion/Inicio_actualizar_calificaciones_ingles.php'>INGL&Eacute;S</a></li>
							</ul>
						</li>
						<li><a>COMENTARIOS</a>
							<ul>
								<li><a href='actualizacion/Inicio_actualizar_comentarios.php'>ESPA&Ntilde;OL</a></li>
								<li><a href='actualizacion/Inicio_actualizar_comentarios_ingles.php'>INGL&Eacute;S</a></li>
							</ul>
						</li>
						<li><a href="pdf/Inicio_reporte.php">IMPRESI&Oacute;N DE BOLETA</a></li>
						<li><a href="../conexion/logout.php"><img src="../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
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
									<h3>BIENVENIDO MAESTRO (A):</h3>
								</header>
							</section>
						</div>
						<div class="col-7 col-12-mobile imp-mobile" id="content">
							<article id="main">
								<header>
									<h2><?php echo $_SESSION['username']; ?></h2>
								</header>
							</article>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			}else {
				header("location:../index.php");
			}
		?>
		<!-- Scripts -->
		<script src="../estilo/js/jquery.min.js"></script>
		<script src="../estilo/js/jquery.dropotron.min.js"></script>
		<script src="../estilo/js/jquery.scrolly.min.js"></script>
		<script src="../estilo/js/jquery.scrollex.min.js"></script>
		<script src="../estilo/js/browser.min.js"></script>
		<script src="../estilo/js/breakpoints.min.js"></script>
		<script src="../estilo/js/util.js"></script>
		<script src="../estilo/js/main.js"></script>
	</body>
</html>