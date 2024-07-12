<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	//datos de acceso
	error_reporting(0);
	include_once "conexion/conexion.php";
	$valido=true;
	mysqli_set_charset($conexion,'utf8');
	if(isset($_POST['entrar'])){
		/*Entra solo si se presiona el boton entrar*/
        $nombre=$_POST['name'];
		$contrasena=$_POST['Password'];
		$_SESSION['usuario']=$_POST['name'];
		//Consulta de usuario
		if($nombre=='admin' || $nombre=='ADMIN'){
			$consulta = "SELECT personal.id, concat (personal.nombre, ' ', personal.paterno, ' ', personal.materno) AS nombre_completo, personal.usuario, puesto.puesto, areatrabajo.area FROM personal , puestopersonal , puesto , areapuesto , areatrabajo WHERE (personal.usuario LIKE '$nombre' AND personal.contrasenia LIKE md5('$contrasena')) AND (personal.id = puestopersonal.personal) AND (puestopersonal.puesto = puesto.id) AND (puesto.id = areapuesto.puesto) AND (areapuesto.areaTrabajo = areatrabajo.id)";
		}
		else if($nombre=='CEP' || $nombre=='ADD' || $nombre=='ATT' || $nombre=='ATPE' || $nombre=='ATPI' || $nombre=='SDI' || $nombre=='CP'){
			$consulta = "SELECT personal.id, concat (personal.nombre, ' ', personal.paterno, ' ', personal.materno) as nombre_completo, personal.usuario, puesto.puesto, areatrabajo.area FROM personal, puestopersonal, puesto, areapuesto, areatrabajo WHERE (personal.usuario like '$nombre' and personal.contrasenia like md5('$contrasena')) and (personal.id = puestopersonal.personal) and (puestopersonal.puesto = puesto.id) and (puesto.id = areapuesto.puesto) and (areapuesto.areaTrabajo = areatrabajo.id)";
		}
		else if($nombre=='ESP1' || $nombre=='ESP2' || $nombre=='ESP3' || $nombre=='ESP4' || $nombre=='ESP5' || $nombre=='ESP6' || $nombre=='ING1' || $nombre=='ING2' || $nombre=='ING3' || $nombre=='ING4' || $nombre=='ING5' || $nombre=='ING6' || $nombre=='TECNOLOGIA' || $nombre=='FISICA' || $nombre=='PLASTICA' || $nombre=='MUSICA' || $nombre=='ESCENICAS' || $nombre=='ROBOTICA' || $nombre=='CIENCIAS'){
			$consulta="SELECT personal.id, maestro.clave, concat (personal.nombre, ' ', personal.paterno, ' ', personal.materno) as nombre_completo, personal.usuario, puesto.puesto, areatrabajo.area FROM personal, puestopersonal, puesto, areapuesto, areatrabajo, maestro WHERE (personal.usuario like '$nombre' and personal.contrasenia like md5('$contrasena')) and (personal.id = puestopersonal.personal) and (puestopersonal.puesto = puesto.id) and (puesto.id = areapuesto.puesto) and (areapuesto.areaTrabajo = areatrabajo.id) AND maestro.usuario LIKE personal.usuario";
		}
		else if($nombre <> 'admin' || $nombre <> 'ADMIN' || $nombre <> 'CEP' || $nombre <> 'ADD' || $nombre <> 'ATT' || $nombre <> 'ATPE' || $nombre <> 'ATPI' || $nombre <> 'SDI' || $nombre <> 'CP' || $nombre <> 'ESP1' || $nombre <> 'ESP2' || $nombre <> 'ESP3' || $nombre <> 'ESP4' || $nombre <> 'ESP5' || $nombre <> 'ESP6' || $nombre <> 'ING1' || $nombre <> 'ING2' || $nombre <> 'ING3' || $nombre <> 'ING4' || $nombre <> 'ING5' || $nombre <> 'ING6' || $nombre <> 'TECNOLOGIA' || $nombre <> 'FISICA' || $nombre <> 'PLASTICA' || $nombre <> 'MUSICA' || $nombre <> 'ESCENICAS' || $nombre <> 'ROBOTICA' || $nombre <> 'CIENCIAS'){
			$consulta="SELECT personal.id, maestro.clave, concat (personal.nombre, ' ', personal.paterno, ' ', personal.materno) as nombre_completo, personal.usuario, puesto.puesto, areatrabajo.area FROM personal, puestopersonal, puesto, areapuesto, areatrabajo, maestro WHERE (personal.usuario like '$nombre' and personal.contrasenia like md5('$contrasena')) and (personal.id = puestopersonal.personal) and (puestopersonal.puesto = puesto.id) and (puesto.id = areapuesto.puesto) and (areapuesto.areaTrabajo = areatrabajo.id) AND maestro.usuario LIKE personal.usuario";
		}
		//echo $consulta;
		$result=mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
		$filasn= mysqli_num_rows($result);
		//echo $filasn;
		if ($filasn<=0 || isset($_GET['nologin']) ){
			$valido=false;
		}else{
			$rowsresult=mysqli_fetch_array($result,MYSQLI_ASSOC);          
			//guardamos en sesion el nombre del usuario 
			$_SESSION['userid']= $rowsresult['id'];
			$_SESSION['clave']= $rowsresult['clave'];
			$_SESSION['username']= $rowsresult['nombre_completo'];
			$_SESSION['puesto']= $rowsresult['puesto'];
			$_SESSION['area']= $rowsresult['area'];
			$valido=true;
		}
	}
	if(isset($_SESSION['userid'])){
		if(isset($_SESSION['puesto'])){
			$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo WHERE DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin") or die(mysqli_error($conexion)); 
			while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
				$ciclo=$row[0];
			}
			//echo $ciclo;
			switch($_SESSION['puesto']){
				case 'DOCENTE':
					//ESPAÑOL
					if($_SESSION['usuario']=='ESP1' || $_SESSION['usuario']=='ESP2' || $_SESSION['usuario']=='ESP3' || $_SESSION['usuario']=='ESP4' || $_SESSION['usuario']=='ESP5' || $_SESSION['usuario']=='ESP6'){
						$sql = "SELECT materia.clave, materia.nombreMateria, grado.id FROM maestro ,maestroespanol ,materia ,materiagrado ,grado WHERE maestro.clave = maestroespanol.maestro AND maestroespanol.materia = materia.clave AND materia.clave = materiagrado.materia AND materiagrado.grado = grado.id AND maestro.usuario = '".$_SESSION['usuario']."' AND (materia.nombreMateria LIKE 'ESP%' OR materia.nombreMateria LIKE 'LEN%')";
						$rec = mysqli_query($conexion,$sql) or die (mysqli_error($conexion));
						$numero1 = mysqli_num_rows($rec);
						if($numero1 > 0){
							while($row = mysqli_fetch_object($rec)){
								$_SESSION['materia'] = $row->nombreMateria;
								$_SESSION['grado'] = $row->id;
							}
							header("location:espanol/Inicio_maestro_espanol.php?login=true");
						}
					}
					//INGLES
					if($_SESSION['usuario']=='ING1' || $_SESSION['usuario']=='ING2' || $_SESSION['usuario']=='ING3' || $_SESSION['usuario']=='ING4' || $_SESSION['usuario']=='ING5' || $_SESSION['usuario']=='ING6'){
						$sql = "SELECT DISTINCT ingles.nombre, ingles.id AS clave, grado.id AS grado FROM maestro , maestroingles ,ingles ,grado ,gradoingles WHERE maestro.usuario = '".$_SESSION['usuario']."' AND maestro.clave = maestroingles.maestro AND maestroingles.ingles = ingles.id AND ingles.id = gradoingles.ingles AND gradoingles.grado = grado.id and maestroingles.ciclo = '".$ciclo."'";
						//Echo $sql;
						$rec = mysqli_query($conexion,$sql) or die (mysqli_error($conexion));
						$numero1 = mysqli_num_rows($rec);
						if($numero1 > 0){
							while($row = mysqli_fetch_object($rec)){
								$_SESSION['materia'] = $row->nombre;
								$_SESSION['grado'] = $row->grado;
							}
							header("location:ingles/Inicio_maestro_ingles.php?login=true");
						}
					}
					//EDUCACION FISICA
					if($_SESSION['usuario']=='FISICA'){
						$sql = "SELECT educacionfisica.id AS idFisica, educacionfisica.deporte, grado.id AS idGrado FROM maestro ,maestrodeporte ,educacionfisica ,gradoeducacionfisica ,grado WHERE maestro.clave = maestrodeporte.maestro AND maestrodeporte.deportes = educacionfisica.id AND educacionfisica.id = gradoeducacionfisica.educacionFisica AND gradoeducacionfisica.grado = grado.id AND maestro.usuario = '".$_SESSION['usuario']."'";
						$rec = mysqli_query($conexion,$sql) or die (mysqli_error($conexion));
						$numero1 = mysqli_num_rows($rec);
						if($numero1 > 0){
							while($row = mysqli_fetch_object($rec)){
								$_SESSION['materia'] = $row->deporte;
							}
							header("location:deporte/Inicio_maestro_fisica.php?login=true");
						}
					}
					//ARTES
					if($_SESSION['usuario']=='PLASTICA' || $_SESSION['usuario']=='MUSICA' || $_SESSION['usuario']=='ESCENICAS'){
						$sql = "SELECT artes.id AS idArtes,artes.nombre FROM maestro ,maestroartes ,artes WHERE maestro.clave = maestroartes.maestro AND maestroartes.artes = artes.id AND maestro.usuario = '".$_SESSION['usuario']."'";
						$rec = mysqli_query($conexion,$sql) or die (mysqli_error($conexion));
						$numero1 = mysqli_num_rows($rec);
						if($numero1 > 0){
							while($row = mysqli_fetch_object($rec)){
								$_SESSION['materia'] = $row->nombre;
							}
							header("location:taller/Inicio_maestro_artes.php?login=true");
						}
					}
					//CLUB
					if($_SESSION['usuario']=='ROBOTICA' || $_SESSION['usuario']=='CIENCIAS'){
						$sql = "SELECT club.id , club.club, grado.id AS idGrado FROM maestro ,maestroclub ,club ,gradoclub ,grado WHERE maestro.clave = maestroclub.maestro AND maestroclub.club = club.id AND club.id = gradoclub.club AND gradoclub.grado = grado.id AND maestro.usuario = '".$_SESSION['usuario']."'";
						$rec = mysqli_query($conexion,$sql) or die (mysqli_error($conexion));
						$numero1 = mysqli_num_rows($rec);
						if($numero1 > 0){
							while($row = mysqli_fetch_object($rec)){
								$_SESSION['materia'] = $row->club;
							}
							header("location:club/Inicio_maestro_club.php?login=true");
						}
					}
				break;
				case 'COORDINADOR':
					header("location:cp/Inicio_coordinador.php?login=true");
				break;
				case 'APOYO TECNICO PEDAGOGICO':
					header("location:cp/Inicio_maestro_atp.php?login=true");
				break;
				case 'APOYO TECNICO PEDAGOGICO INGLES':
					header("location:cp/Inicio_maestro_atp.php?login=true");
				break;
				case 'ASESOR TECNICO DE TALLERES':
					header("location:cp/Inicio_maestro_atp.php?login=true");
				break;
				case 'CONTROL ESCOLAR':
					header("location:cp/Inicio_control_escolar.php?login=true");
				break;
				case 'ADMINISTRADOR':
					header("location:administrador/Inicio_admin_primaria.php?login=true");
				break;
			}
			//header("location:pagina.php?login=true"); 
		}
	}
?>

<html>
	<head>
		<title>CESXXI - PRIMARIA</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="estilo/images/icono.png">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="estilo/css/main.css" />
		<noscript><link rel="stylesheet" href="estilo/css/noscript.css" /></noscript>
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">
			<!-- Header -->
			<div id="header">
				<!-- Inner -->
				<div class="inner">
					<header>
						<h1><a id="logo"><img id="imagen_corp" src="estilo/images/cesxxi.png" width="150px" height="90px"></a></h1>
						<h1><a id="logo">PRIMARIA</a></h1>
					</header>
				</div>
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="../../../index.html"><img src="estilo/images/home.png" width="30px" height="30px"/></a></li>
						<li><a href="#"><img src="estilo/images/admisiones.png" width="30px" height="30px"/></a></li>
						<li><a><img src="estilo/images/calificaciones.png" width="30px" height="30px"/></a>
							<ul>
								<li><a href="../primaria/index.php">PRIMARIA</a></li>
								<li><a href="../secundaria/index.php">SECUNDARIA</a></li>
								<li><a href="../bachillerato/index.php">BACHILLERATO</a></li>
								<li><a href="../normal/index.php">NORMAL</a></li>
								<li><a href="../maestria/index.php">MAESTRIA</a></li>
							</ul>
						</li>
						<li><a href="../../biblioteca/index.php"><img src="estilo/images/biblioteca.png" width="30px" height="30px"/></a></li>
						<li><a href="https://intranet.cesigloxxi.edu.mx/"><img src="estilo/images/intranet.png" width="30px" height="30px"/></a></li>
					</ul>
				</nav>
			</div>
			<!-- Main -->
			<div class="wrapper style1">
				<div class="container">
					<div class="row gtr-200">
						<div class="col-3 col-12-mobile" id="sidebar">
							<section>
								
							</section>
						</div>
						<div class="col-5 col-12-mobile imp-mobile" id="content">
							<article id="main">
								<form action="index.php" method="post" autocomplete="off">
									<header>
										<h3><a>Inicio de sesión</a></h3>
									</header>
									<p>
										<table>
											<tbody>
												<tr>
													<th><label for="name"><strong><img src="estilo/images/user.png" width="35" height="35" style="vertical-align: middle; text-align: center;"></strong></label></th>
													<td><input class="inp-text" name="name" id="name" type="text" size="30" style="text-transform:uppercase;" value=""  onkeyup="javascript:this.value=this.value.toUpperCase();"/></td>
												</tr>
												<tr>
													<th><label for="name"><strong><img src="estilo/images/key.png" width="35" height="35" style="vertical-align: middle; text-align: center;"></strong></label></th>
													<td><div class="input-group">
															<input ID="txtPassword" type="Password" name="Password" Class="form-control">
															<div class="input-group-append">
																<button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye"></span></button>
															</div>
														</div>
													</td>
												</tr>
												<tr>
												<td></td>
													<td class="submit-button-right">
														<input class="send_btn" type="submit" name="entrar" value="Iniciar Sesión" alt="Submit" title="Submit" />
														<input class="send_btn" type="reset" value="Restablecer" alt="Reset" title="Reset" />
													</td>
													
												</tr>
											</tbody>
										</table>
									</p>
									<?php
										if ($valido==false) {
											echo "<img src='estilo/images/bad_user_login.png' height='82' width='82'>";
											echo "<p style='text-align: center;'>Datos incorrectos <br/><a href='index.php'>Intenta de nuevo</a></p>";
										}
									?>
								</form>
							</article>
						</div>
					</div>
				</div>
			</div>
			<!-- Footer -->
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Copyright -->
							<div class="copyright">
								<ul class="menu">
									<li>Centro Educativo Siglo XXI, Las &Aacute;nimas.</li><li>Versi&oacute;n: <a>2.0</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Scripts -->
		<script src="estilo/js/jquery.min.js"></script>
		<script src="estilo/js/jquery.dropotron.min.js"></script>
		<script src="estilo/js/jquery.scrolly.min.js"></script>
		<script src="estilo/js/jquery.scrollex.min.js"></script>
		<script src="estilo/js/browser.min.js"></script>
		<script src="estilo/js/breakpoints.min.js"></script>
		<script src="estilo/js/util.js"></script>
		<script src="estilo/js/main.js"></script>
		<!--Mostrar/ocultar contraseña-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			function mostrarPassword(){
				var cambio = document.getElementById("txtPassword");
				if(cambio.type == "password"){
					cambio.type = "text";
					$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
				}else{
					cambio.type = "password";
					$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
				}
			} 
				
			$(document).ready(function () {
				//CheckBox mostrar contraseña
				$('#ShowPassword').click(function () {
					$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
				});
			});
		</script>
		<link href="estilo/css/sticky-footer-navbar.css" rel="stylesheet">
	</body>
</html>