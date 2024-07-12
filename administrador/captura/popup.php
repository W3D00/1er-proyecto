<?php 
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	error_reporting(0);
	include "../../conexion/conexion.php";
	mysqli_set_charset($conexion,'utf8');
	
	if(isset($_POST['Capturar'])){
		$boton=$_POST['Capturar'];
	}
	else
		$boton='';
	
	if($boton == 'Capturar'){
		//echo "captura";
		if(isset($_POST['nivel'])){
			$nivel = $_POST['nivel'];
		}
		$no_filas=$_POST['filas'];
		$ids = $_SESSION['id'];
		for($j = 1; $j < $no_filas; $j++) {
			//echo $nivel[$j];
			$sql = mysqli_query($conexion,"INSERT INTO calificacionclub (id, alumno, club, unidad, ciclo, inasistencia, asistencia, calAsis, noTarea, calTarea, participacion, calParti, conducta, calCondu, total, examen, calExa, promedio, final, comentario, bloquear) values ('', '".$ids[$j]."','3','".$_SESSION['bloque']."','".$_SESSION["ciclo"]."','', '', '','','','','','','','','','','','".$nivel[$j]."','','')") or die ('Error: '.mysqli_error($conexion));
		}
		
		echo "<script>opener.location.reload();window.close();</script>";
	}
	if($boton == 'Actualizar'){
		//echo "Actualizar";
		if(isset($_POST['idMat'])){
			$idMat = $_POST['idMat'];
		}
		if(isset($_POST['nivel'])){
			$nivel = $_POST['nivel'];
		}
		$no_filas=$_POST['filas'];
		//echo $contador1;
		
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionclub` SET `final` = '".$nivel[$j]."' WHERE `calificacionclub`.`id` = '".$idMat[$j]."'") or die (mysqli_error($conexion));
		}
		echo "<script>opener.location.reload();window.close();</script>";
		$_SESSION["ne"]='';
		$ne='';
	}
	
	if(isset($_SESSION['username'])){
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
	<body class="no-sidebar" onLoad="adicionarFila();adicionarFila()">
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
								<form name="detalle" action="popup.php" method="POST"  onSubmit = "return validation(this)" autocomplete="off"> 
									<?php
										$alumno=array();
										$sq="select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
										//echo $sq;
										$con1= mysqli_query($conexion,$sq) or die(mysqli_error($conexion)); 
										$alumno=array();
										while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
											$alumno[]=$row['id'];
										}
										$contador=0;
										for($i=0;$i<count($alumno);$i++){
											$cons="select calificacionclub.bloquear from calificacionclub where (calificacionclub.club = '3') and (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."') and (calificacionclub.bloquear = '1')";
											//echo $cons."<br>";
											$con1= mysqli_query($conexion,$cons) or die("Error 1 :".mysqli_error($conexion)); 
											while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
												if($row[0]!='')
												$contador++;
											}
										}
										$contador1=0;
										for($i=0;$i<count($alumno);$i++){
											$Con = "select calificacionclub.id from calificacionclub where calificacionclub.club = '3' AND (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."')";
											//echo $Con."<br>";
											$con1= mysqli_query($conexion,$Con) or die("Error 1 :".mysqli_error($conexion)); 
											while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
												if($row[0]!='')
												$contador1++;
											}
										}
										if($contador!=0){
											echo "<script languaje='javascript'>alert('Ya se encuentra bloqueado');window.close();</script>";
										}
										else{
											if($contador1 != 0){//actualizar
												$con1= mysqli_query($conexion,"select distinct alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and ciclo.id = '".$_SESSION["ciclo"]."' ORDER BY nombre_completo ASC") or die(mysqli_error($conexion)); 	
												$alumno=array();
												$matricula=array();
												$nombre=array();
												while ($row = mysqli_fetch_array($con1,MYSQLI_ASSOC)){ 
													$alumno[] = $row['id'];
													$matricula[] = $row['matricula'];
													$nombre[] = utf8_encode($row['nombre_completo']);
												}
												
												for($i=0;$i<count($alumno);$i++){
													$Con = mysqli_query($conexion,"select calificacionclub.id, calificacionclub.final from calificacionclub where calificacionclub.club = '3' AND (calificacionclub.alumno = '".$alumno[$i]."') and (calificacionclub.unidad = '".$_SESSION["bloque"]."') and (calificacionclub.ciclo = '".$_SESSION["ciclo"]."')") or die(mysqli_error($conexion));
													$row = mysqli_fetch_array($Con,MYSQLI_ASSOC);
													//valores de las consultas
													$idMat[$i]=$row['id'];
													$final[$i]=$row['final'];
												}
													
												
												echo "<table width=500 align=center border='2'> 
													<tr bgcolor='bbbbbb' align=center> 
													<td><center>NO</center></td> 
													<td><center>NOMBRE</center></td>
													<td><center>NIVEL</center></td>";
												echo "<tr bgcolor='bbbbbb' align=center> 
													<td colspan = '2'><center>MAXIMOS</center></td>
													<td><center>1 - 4</center></td>
													</tr>";
												//creo e inicializo la variable para contar el número de filas 
												$num_fila = 1; 
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
													
													//$_SESSION["id"][$num_fila]=$damefila->id;
													//echo "<input type='hidden' name='ids' value='$damefila->id'>";
											
													echo"
														<input type='hidden' name='idMat[$num_fila]' id='idMat[$num_fila]' value='".$idMat[$i]."'>
														<td><font size='2'>$num_fila</font></td> 
														<td nowrap>".utf8_decode($nombre[$i])."</td>
														<td><center><input style='font-size:14px; font-family: arial' type='text' name='nivel[$num_fila]' id='nivel[$num_fila]' value='".$final[$i]."' maxlength='5' size='5' ONCHANGE = 'verificar(this.id)' onkeypress='return soloLetras(event)' onblur='limpia()' onFocus = 'javascript:this.value=\"\"' tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
														</tr>";
													//aumentamos en uno el número de filas 
													$num_fila++;
												} //cierro el while 
												echo "</table>";
												echo "
													<center>
													<input type='submit' name='Capturar' id='Capturar' value='Actualizar' tabindex='1000'/>
													</center>
												";
												echo "<input type='hidden' name='filas' value='$num_fila'>";
											}
											else{//captura
												$sql = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_SESSION["grado"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='".$_SESSION["ciclo"]."') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
												$result = mysqli_query($conexion,$sql)or die ("ERROR AL BUSCAR ".mysqli_error($conexion));
												echo "<table width=500 align=center border='2'> 
													<tr bgcolor='bbbbbb' align=center> 
													<td><center>NO</center></td> 
													<td><center>NOMBRE</center></td>
													<td><center>NIVEL</center></td>
													</tr>";
												echo "<tr bgcolor='bbbbbb' align=center> 
													<td colspan = '2'><center>MAXIMOS</center></td>
													<td><center>1 - 4</center></td>
													</tr>";
												//creo e inicializo la variable para contar el número de filas 
												$num_fila = 1; 
												$cont1=1;
												//bucle para mostrar los resultados 
												while ($damefila=mysqli_fetch_object($result)){ 
													echo "<tr "; 
													if ($num_fila%2==0) 
														//si el resto de la división es 0 pongo un color 
														echo "bgcolor=#81DAF5";
													else 
														//si el resto de la división NO es 0 pongo otro color 
														echo "bgcolor=#58D3F7";
													echo ">"; 
													
													$_SESSION["id"][$num_fila]=$damefila->id;
													//echo "<input type='hidden' name='ids' value='$damefila->id'>";
											
													echo"<td><font size='2'>$num_fila</font></td> 
														<td nowrap>$damefila->nombre_completo</td>
														<td><center><input style='font-size:14px; font-family: arial' type='text' name='nivel[$num_fila]' id='nivel[$num_fila]' value='0' maxlength='5' size='5' ONCHANGE = 'verificar(this.id)' onkeypress='return soloLetras(event)' onblur='limpia()' onFocus = 'javascript:this.value=\"\"' tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)'/></center></td>
														</tr> ";
													//aumentamos en uno el número de filas 
													$num_fila++;
												} //cierro el while 
												echo "</table>";
												echo "
													<center>
													<input type='submit' name='Capturar' id='Capturar' value='Capturar' tabindex='1000'/>
													</center>
												";
												echo "<input type='hidden' name='filas' value='$num_fila'>";
											}
										}
										
									?>
								</form>
							</article>
						</div>
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
		<!------------------------autocompletamiento en campos de localidad------->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!--********ESCRIBIR SOLO NUMEROS***********-->
		<script>
			function justNumbers(e)
				{
					var keynum = window.event ? window.event.keyCode : e.which;
						if ((keynum == 8) || (keynum == 46))
							return true;
								return /\d/.test(String.fromCharCode(keynum));
				}
			function verificar(id){
				var nivel = document.getElementById(id);
				var inputNum = id.split("nivel")[1];
				//var tc = document.getElementById("tc");
				if((parseFloat(nivel.value) > parseInt(0))&&(parseFloat(nivel.value) <= parseInt(4))){
				}
				else{
					alert("Debe ingresar un numero entre 1 y 4.")
					nivel.value='';
				}
			}
		</script>
	</body>
</html>
<?php
	}
	else {
		header("location:../../index.php");
	}
?>