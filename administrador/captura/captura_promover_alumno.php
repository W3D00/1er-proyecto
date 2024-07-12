<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	//error_reporting(0);
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
						<li><a href="../captura/Inicio_captura_calificaciones.php">CAPTURA DE CALIFICACIONES</a></li>
						<li><a href="../captura/Inicio_captura_comentarios_calificaciones.php">CAPTURA DE COMENTARIOS</a></li>
						<li><a href="../consultas/Inicio_consulta_calificaciones_general.php">CONSULTA DE CALIFICACIONES</a></li>
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
								$stringSeparado = explode('-', $_POST['ciclo']);
								$ciclo=$stringSeparado[0];
								$anio=$stringSeparado[1];
								
								$matriculas=array();
								$paternos=array();
								$maternos=array();
								$nombres=array();
								$grados=array();
								
								//echo "SELECT alumno.id, alumno.paterno, alumno.materno, alumno.nombre, alumnogrado.grado FROM alumno INNER JOIN alumnosituacion ON  alumno.id = alumnosituacion.alumno INNER JOIN alumnogrado ON alumno.id = alumnogrado.alumno WHERE alumnosituacion.situacion = '3' AND alumnosituacion.ciclo = '".$ciclo."' AND alumnosituacion.nivel = '3' AND alumnogrado.activo = '1' AND alumnogrado.ciclo = '".$ciclo."'"; 
								$consulta= mysqli_query($conexion,"SELECT 	alumno.id, alumno.paterno, alumno.materno, alumno.nombre, alumnogrado.grado FROM alumno INNER JOIN alumnosituacion ON  alumno.id = alumnosituacion.alumno INNER JOIN alumnogrado ON alumno.id = alumnogrado.alumno WHERE alumnosituacion.situacion = '3' AND alumnosituacion.ciclo = '".$ciclo."' AND alumnosituacion.nivel = '3' AND alumnogrado.activo = '1' AND alumnogrado.ciclo = '".$ciclo."' AND alumnogrado.grado < '22' ORDER BY alumnogrado.grado ASC") or die(mysqli_error($conexion)); 
								while ($row = mysqli_fetch_array($consulta,MYSQLI_NUM)){ 
									$matriculas[]=$row[0];
									$paternos[]=$row[1];
									$maternos[]=$row[2];
									$nombres[]=$row[3];
									$grados[]=$row[4];
								}
								$con1= mysqli_query($conexion,"SELECT ciclo.id FROM ciclo ORDER BY ciclo.id DESC LIMIT 0, 1 ") or die(mysqli_error($conexion)); 
								while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
									$_SESSION["ciclo"]=$row[0];
								}
								$j=0;
								$matricula=array();
								$paterno=array();
								$materno=array();
								$nombre=array();
								$grado=array();
								for($i=0;$i<count($matriculas);$i++){
									//echo "SELECT alumnogrado.alumno FROM alumnogrado WHERE alumnogrado.ciclo = '".$_SESSION["ciclo"]."' AND alumnogrado.alumno = '".$matriculas[$i]."'<br>";
									$consulta1= mysqli_query($conexion,"SELECT 	alumnogrado.alumno FROM alumnogrado WHERE alumnogrado.ciclo = '".$_SESSION["ciclo"]."' AND alumnogrado.alumno = '".$matriculas[$i]."'") or die(mysqli_error($conexion));
									//$totalFilas = mysql_num_rows($consulta1);
									$p=mysqli_fetch_array($consulta1,MYSQLI_NUM);
									if (empty($p[0])) {
										//echo "aqui me encuentro";
										$matricula[$j]=$matriculas[$i];
										$paterno[$j]=$paternos[$i];
										$materno[$j]=$maternos[$i];
										$nombre[$j]=$nombres[$i];
										$grado[$j]=$grados[$i];
										$j++;
									}
								}
								//echo count ($matricula);
								echo "
								<div class='col-8 col-12-mobile imp-mobile' id='content'>
									<article id='main'>
										<form id='form1' name='form1' method='post' onSubmit = 'return validation(this)' action='almacenar_promover_alumno.php' autocomplete='off'>
											<header>
												<h3>PROMOVER ALUMNOS</h3>
											</header>
											<p>
											<center>"; 
											
										
										echo "<table align=center border='2'> 
											<tr bgcolor='bbbbbb' align=center> 
											<td style='border:1px solid white'><center>NO.</center></td> 
											<td style='border:1px solid white'><center>REGISTRAR</center></td> 
											<td style='border:1px solid white'><center>MARTRICULA</center></td>
											<td style='border:1px solid white'><center>PATERNO</center></td>
											<td style='border:1px solid white'><center>MATERNO</center></td>
											<td style='border:1px solid white'><center>NOMBRE</center></td>
											<td style='border:1px solid white'><center>GRADO_Y_GRUPO</center></td>
											<td style='border:1px solid white'><center>ARTES</center></td>
											<td style='border:1px solid white'><center>DEPORTE</center></td>
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
										$cont11=1000;
										$cont12=1100;
										$cont13=1200;
										//bucle para mostrar los resultados 
										for($i=0;$i<count($matricula);$i++){
											echo "<tr "; 
											if ($num_fila%2==0) 
												//si el resto de la división es 0 pongo un color 
												echo "bgcolor=#81DAF5";
											else 
												//si el resto de la división NO es 0 pongo otro color 
												echo "bgcolor=#58D3F7";
											echo ">"; 
											
											echo"
												<td style='border:1px solid white'><CENTER>$num_fila</CENTER></td> 
												<td style='border:1px solid white'><CENTER><label class='container'>$num_fila<input type='checkbox' name='cuadro[$num_fila]'><span class='checkmark'></span></label></CENTER></td> 
												<td nowrap style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='matricula[$num_fila]' id='matricula[$num_fila]' value='".$matricula[$i]."' readonly/></center></td>
												<td nowrap style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='paterno[$num_fila]' id='paterno[$num_fila]' value='".$paterno[$i]."' /></center></td>
												<td nowrap style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='materno[$num_fila]' id='materno[$num_fila]' value='".$materno[$i]."' /></center></td>
												<td nowrap style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='text' name='nombre[$num_fila]' id='nombre[$num_fila]' value='".$nombre[$i]."' /></center></td>";
												if($grado[$i]==7){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>1A</option><option value='10'>2A</option>	<option value='11'>2B</option></select></center></td>
													<td></td>
													<td></td>";
												}
												if($grado[$i]==8){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>1B</option><option value='10'>2A</option>	<option value='11'>2B</option></select></center></td>
													<td></td>
													<td></td>";
												}
												if($grado[$i]==10){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>2A</option><option value='13'>3A</option><option value='14'>3B</option></select></center></td>
													<td></td>
													<td></td>";
												}
												if($grado[$i]=='11'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>2B</option><option value='13'>3A</option><option value='14'>3B</option></select></center></td>
													<td></td>
													<td></td>";
												}
												if($grado[$i]=='13'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>3A</option><option value='16'>4A</option><option value='17'>4B</option></select></center></td>
													<td></td>
													<td></td>";
												}
												if($grado[$i]=='14'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>3B</option><option value='16'>4A</option><option value='17'>4B</option></select></center></td>
													<td></td>
													<td></td>";
												}
												if($grado[$i]=='16'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>4A</option><option value='19'>5A</option><option value='20'>5B</option></select></center></td>
													<td style='border:1px solid white'><center><select name='arte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='3'>ARTES ESCÉNICAS</option><option value='2'>ARTES VISUALES</option><option value='5'>ORQUESTA</option></select></center></td>
													<td style='border:1px solid white'><center><select name='deporte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='11'>VOLEIBOL</option><option value='13'>BASQUETBOL</option><option value='15'>FUTBOL</option></select></center></td>";
												}
												if($grado[$i]=='17'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>4B</option><option value='19'>5A</option><option value='20'>5B</option></select></center></td>
													<td style='border:1px solid white'><center><select name='arte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='3'>ARTES ESCÉNICAS</option><option value='2'>ARTES VISUALES</option><option value='5'>ORQUESTA</option></select></center></td>
													<td style='border:1px solid white'><center><select name='deporte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='11'>VOLEIBOL</option><option value='13'>BASQUETBOL</option><option value='15'>FUTBOL</option></select></center></td>";
												}
												if($grado[$i]=='19'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>5A</option><option value='22'>6A</option><option value='23'>6B</option></select></center></td>
													<td style='border:1px solid white'><center><select name='arte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='17'>ARTES ESCÉNICAS</option><option value='10'>ARTES VISUALES</option><option value='18'>ORQUESTA</option></select></center></td>
													<td style='border:1px solid white'><center><select name='deporte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='12'>VOLEIBOL</option><option value='14'>BASQUETBOL</option><option value='16'>FUTBOL</option></select></center></td>";
												}
												if($grado[$i]=='20'){
													echo "<td style='border:1px solid white'><center><select name='grado[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>5B</option><option value='22'>6A</option><option value='23'>6B</option></select></center></td>
													<td style='border:1px solid white'><center><select name='arte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='17'>ARTES ESCÉNICAS</option><option value='10'>ARTES VISUALES</option><option value='18'>ORQUESTA</option></select></center></td>
													<td style='border:1px solid white'><center><select name='deporte[$num_fila]' style='font-size:14px; font-family: arial' ><option value=''>Seleccione:</option><option value='12'>VOLEIBOL</option><option value='14'>BASQUETBOL</option><option value='16'>FUTBOL</option></select></center></td>";
												}
											ECHO "</tr> ";
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
			function resizeInput() {
  
			  var valueLength = $(this).prop('value').length;
			  
				// Para que no arroje error si el input se vacía
				if (valueLength > 0) {
				  
				  $(this).prop('size', valueLength);
				}
			}

			$('input[type="text"]').on('keyup', resizeInput).each(resizeInput);
		</script>
	</body>
</html>
<?php
	}
	else{
		 header('location:../../index.php');
	}
?>