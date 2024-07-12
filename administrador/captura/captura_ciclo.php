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
				<!--nav id="nav">
					<ul>
						<li><a href="../../index.php"><img src="../../estilo/images/home.png" width="20px" height="20px"/></a></li>
						<li><a href="../captura/Inicio_captura_calificaciones.php">CAPTURA DE CALIFICACIONES</a></li>
						<li><a href="../captura/Inicio_captura_comentarios_calificaciones.php">CAPTURA DE COMENTARIOS</a></li>
						<li><a href="../consultas/Inicio_consulta_calificaciones_general.php">CONSULTA DE CALIFICACIONES</a></li>
						<li><a href="../../conexion/logout.php"><img src="../../estilo/images/salir.png" width="20px"  height="20px" class="cerrarsesion"/></a></li>
					</ul>
				</nav-->
			</div>
			<!-- Main -->
			<div class="wrapper style1">
				<div class="container">
					<div class="row gtr-200">
						<?php
								echo "<div class='col-3 col-12-mobile' id='sidebar'>
									<hr class='first' />
									<section>
										<header>
											<h3>CICLO</h3>
										</header>
									</section>
								</div>";
								
									echo "<div class='col-8 col-12-mobile imp-mobile' id='content'>
											<article id='main'>
												<form id='form1' name='form1' method='post' onSubmit = 'return validation(this)' action='almacenar_ciclo.php' autocomplete='off'>";
										
										echo "<table width=500 align=center border='2'> 
											<tr bgcolor='bbbbbb' align=center> 
											<td style='border:1px solid white'><center>FECHA INICIO</center></td>
											<td style='border:1px solid white'><center>FECHA FIN</center></td>
											</tr>";
										ECHO "</tr>";
										//creo e inicializo la variable para contar el n\u00famero de filas 
										$num_fila = 1; 
										//$i=0;
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
										for($i=0;$i<1;$i++){ 
											echo "<tr "; 
											if ($num_fila%2==0) 
												//si el resto de la división es 0 pongo un color 
												echo "bgcolor=#81DAF5";
											else 
												//si el resto de la división NO es 0 pongo otro color 
												echo "bgcolor=#58D3F7";
											echo ">"; 
											
											$_SESSION["id"][$num_fila]=$_SESSION["id1"];
											//echo "<input type='hidden' name='ids' value='$damefila->id'>";
								
											echo"
												<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='date' name='fechai[$num_fila]' id='fechai[$num_fila]' value='' onkeypress='return soloLetras(event)' maxlength='5' size='5'  tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)' /></center></td>
												<td style='border:1px solid white'><center><input style='font-size:14px; font-family: arial' type='date' name='fechaf[$num_fila]' id='fechaf[$num_fila]' value='' onkeypress='return soloLetras(event)' maxlength='5' size='5'  tabindex='$cont1' onkeydown='return simularTab(event, this, 13,37,38,39,40)' /></center></td>";
											
											
											ECHO "</tr> ";
											//aumentamos en uno el n\u00famero de filas 
											$num_fila++;
											//$i++;
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
			$(document).ready(function () {
				$("#t").keyup(function () {
					var value = $(this).val();
					$("#copiat").text(value);
				});
			});
		</script>
		<SCRIPT>//Verificar y calcular
			function verificar5_2(id){//Verificar actitud
				var t = document.getElementById("t");
				var copiat = document.getElementById("copiat");
				if(t.value != copiat.value){
					if(copiat.value==''){
						copiat.value=t.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiat.value=t.value;
					}
				}
				else if(t.value == copiat.value){
				}
			}
			
			function verificar4_2_1(id){//Knotion 1
				var tc1 = document.getElementById("tc1");
				var copiatc1 = document.getElementById("copiatc1");
				if(tc1.value != copiatc1.value){
					if(copiatc1.value==''){
						copiatc1.value=tc1.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiatc1.value=tc1.value;
					}
				}
				else if(tc1.value == copiatc1.value){
				}
			}
			
			function verificar4_2_2(id){//Knotion 2
				var tc2 = document.getElementById("tc2");
				var copiatc2 = document.getElementById("copiatc2");
				if(tc2.value != copiatc2.value){
					if(copiatc2.value==''){
						copiatc2.value=tc2.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiatc2.value=tc2.value;
					}
				}
				else if(tc2.value == copiatc2.value){
				}
			}
			
			function verificar4_2_3(id){//Knotion 3
				var tc3 = document.getElementById("tc3");
				var copiatc3 = document.getElementById("copiatc3");
				if(tc3.value != copiatc3.value){
					if(copiatc3.value==''){
						copiatc3.value=tc3.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiatc3.value=tc3.value;
					}
				}
				else if(tc3.value == copiatc3.value){
				}
			}
			
			function verificar4_2_4(id){//Knotion 4
				var tc4 = document.getElementById("tc4");
				var copiatc4 = document.getElementById("copiatc4");
				if(tc4.value != copiatc4.value){
					if(copiatc4.value==''){
						copiatc4.value=tc4.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiatc4.value=tc4.value;
					}
				}
				else if(tc4.value == copiatc4.value){
				}
			}
			
			function verificar4_2_5(id){//Knotion 5
				var tc5 = document.getElementById("tc5");
				var copiatc5 = document.getElementById("copiatc5");
				if(tc5.value != copiatc5.value){
					if(copiatc5.value==''){
						copiatc5.value=tc5.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiatc5.value=tc5.value;
					}
				}
				else if(tc5.value == copiatc5.value){
				}
			}
			
			function verificar4_2_6(id){//Knotion 6
				var tc6 = document.getElementById("tc6");
				var copiatc6 = document.getElementById("copiatc6");
				if(tc6.value != copiatc6.value){
					if(copiatc6.value==''){
						copiatc6.value=tc6.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiatc6.value=tc6.value;
					}
				}
				else if(tc6.value == copiatc6.value){
				}
			}
			
			function verificar6_2(id){//Verifica español
				var esp = document.getElementById("esp");
				var copiaesp = document.getElementById("copiaesp");
				if(esp.value != copiaesp.value){
					if(copiaesp.value==''){
						copiaesp.value=esp.value;
					}
					else{
						alert("Ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiaesp.value=esp.value;
					}
				}
				else if(esp.value == copiaesp.value){
				}
			}
			
			function verificar7_2(id){//Verifica Matematicas
				var mat = document.getElementById("mat");
				var copiamat = document.getElementById("copiamat");
				if(mat.value != copiamat.value){
					if(copiamat.value==''){
						copiamat.value=mat.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiamat.value=mat.value;
					}
				}
				else if(mat.value == copiamat.value){
				}
			}
			
			function verificar8_2(id){//Verifica Conocimiento del mundo
				var ens = document.getElementById("ens");
				var copiaens = document.getElementById("copiaens");
				if(ens.value != copiaens.value){
					if(copiaens.value==''){
						copiaens.value=ens.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiaens.value=ens.value;
					}
				}
				else if(ens.value == copiaens.value){
				}
			}
			
			function verificar9_2(id){//Verificar ciencias naturales
				var cn = document.getElementById("cn");
				var copiacn = document.getElementById("copiacn");
				if(cn.value != copiacn.value){
					if(copiacn.value==''){
						copiacn.value=cn.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiacn.value=cn.value;
					}
				}
				else if(cn.value == copiacn.value){
				}
			}
			
			function verificar10_2(id){//Verificar Entidad donde vivo
				var edv = document.getElementById("edv");
				var copiaedv = document.getElementById("copiaedv");
				if(edv.value != copiaedv.value){
					if(copiaedv.value==''){
						copiaedv.value=edv.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiaedv.value=edv.value;
					}
				}
				else if(edv.value == copiaedv.value){
				}
			}
			
			function verificar11_2(id){//Verificar Formacion civica y etica
				var fce = document.getElementById("fce");
				var copiafce = document.getElementById("copiafce");
				if(fce.value != copiafce.value){
					if(copiafce.value==''){
						copiafce.value=fce.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiafce.value=fce.value;
					}
				}
				else if(fce.value == copiafce.value){
				}
			}
			
			function verificar12_2(id){//Verificar Historia
				var his = document.getElementById("his");
				var copiahis = document.getElementById("copiahis");
				if(his.value != copiahis.value){
					if(copiahis.value==''){
						copiahis.value=his.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiahis.value=his.value;
					}
				}
				else if(his.value == copiahis.value){
				}
			}
			
			function verificar13_2(id){//Verificar Geografia
				var geo = document.getElementById("geo");
				var copiageo = document.getElementById("copiageo");
				if(geo.value != copiageo.value){
					if(copiageo.value==''){
						copiageo.value=geo.value;
					}
					else{
						alert("ha realizado un cambio en los m\u00e1ximos, debe volver a capturar toda la columna de nuevo.")
						copiageo.value=geo.value;
					}
				}
				else if(geo.value == copiageo.value){
				}
			}
			
			function calculate10_1(id){//Calculo Knotion 1
				var ctc1 = document.getElementById(id);
				var inputNum = id.split("ctc1")[1];
				var ptc1 = document.getElementById("ptc1" + inputNum);
				var tc1 = document.getElementById("tc1");
				if(parseFloat(ctc1.value) > 0 && parseFloat(ctc1.value) <= tc1.value){
					var calculo = parseFloat((parseFloat(ctc1.value) * 70)/parseFloat(tc1.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc1.value=dos;
					var cesp = document.getElementById("cesp" + inputNum);
					var pesp = document.getElementById("pesp" + inputNum);
					var fesp = document.getElementById("fesp" + inputNum);
					var esp = document.getElementById("esp");
					if(parseFloat(cesp.value) >= 0){
						var calculo3 = parseFloat((parseFloat(cesp.value) * 30)/parseFloat(esp.value)).toFixed(2);
						arr = calculo3.split(".");  // declaro el array 
						entero= arr[0];
						decimal = arr[1];
						uno = decimal.substring(0,1);
						dos=entero+'.'+uno;
						pesp.value=dos;
						var calculo4 = parseFloat((parseFloat(ptc1.value) + parseFloat(pesp.value))/10).toFixed(2);
						if(parseFloat(cesp.value) <= esp.value){
							var arr = calculo4.split(".");  // declaro el array 
							var entero= arr[0];
							var decimal = arr[1];
							var uno = decimal.substring(0,1);
							var dos=entero+'.'+uno;
							otro=(dos);
							if (otro < 6){
								fesp.value = Math.round(5);
							}
							else{
								fesp.value = Math.round(dos);
							}
						}
					}
				}
				else if(parseFloat(ctc1.value) == 0){
					ptc1.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc1.value='0';
				}
			}
			
			function calculate10_2(id){//Calculo Knotion 2
				var ctc2 = document.getElementById(id);
				var inputNum = id.split("ctc2")[1];
				var ptc2 = document.getElementById("ptc2" + inputNum);
				var tc2 = document.getElementById("tc2");
				if(parseFloat(ctc2.value) > 0 && parseFloat(ctc2.value) <= tc2.value){
					var calculo = parseFloat((parseFloat(ctc2.value) * 70)/parseFloat(tc2.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc2.value=dos;
					var cmat = document.getElementById("cmat" + inputNum);
					var pmat = document.getElementById("pmat" + inputNum);
					var fmat = document.getElementById("fmat" + inputNum);
					var mat = document.getElementById("mat");
					if(parseFloat(cmat.value) >= 0){
						var calculo8 = parseFloat((parseFloat(cmat.value) * 30)/mat.value).toFixed(2);
						var arr = calculo8.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pmat.value=dos;
						var calculo9 = parseFloat((parseFloat(ptc2.value) + parseFloat(pmat.value))/10).toFixed(2);
						if( parseFloat(cmat.value) <= mat.value){
							var arr1 = calculo9.split(".");  // declaro el array 
							var entero1= arr1[0];
							var decimal1 = arr1[1];
							var uno1 = decimal1.substring(0,1);
							var dos1=entero1+'.'+uno1;
							otro1=(dos1);
							if (otro1 < 6){
								fmat.value = Math.round(5);
							}
							else{
								fmat.value = Math.round(dos1);
							}
						}
					}
				}
				else if(parseFloat(ctc2.value) == 0){
					ptc2.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc2.value='0';
				}
			}

			function calculate10_3(id){//Calculo knotion 3
				var ctc3 = document.getElementById(id);
				var inputNum = id.split("ctc3")[1];
				var ptc3 = document.getElementById("ptc3" + inputNum);
				var tc3 = document.getElementById("tc3");
				if(parseFloat(ctc3.value) > 0 && parseFloat(ctc3.value) <= tc3.value){
					var calculo = parseFloat((parseFloat(ctc3.value) * 70)/parseFloat(tc3.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc3.value=dos;
					var cens = document.getElementById("cens" + inputNum);
					var pens = document.getElementById("pens" + inputNum);
					var fens = document.getElementById("fens" + inputNum);
					var ens = document.getElementById("ens");
					if(parseFloat(cens.value) >= 0){
						var calculo13 = parseFloat((parseFloat(cens.value) * 30)/ens.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pens.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc3.value) + parseFloat(pens.value))/10).toFixed(2);
						if( parseFloat(cens.value) <= ens.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6){
								fens.value = Math.round(5);
							}
							else{
								fens.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc3.value) == 0){
					ptc3.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc3.value='0';
				}
			}
			
			function calculate10_4(id){//Calculo Knotion 4
				var ctc4 = document.getElementById(id);
				var inputNum = id.split("ctc4")[1];
				var ptc4 = document.getElementById("ptc4" + inputNum);
				var tc4 = document.getElementById("tc4");
				if(parseFloat(ctc4.value) > 0 && parseFloat(ctc4.value) <= tc4.value){
					var calculo = parseFloat((parseFloat(ctc4.value) * 70)/parseFloat(tc4.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc4.value=dos;
					var cfce = document.getElementById("cfce" + inputNum);
					var pfce = document.getElementById("pfce" + inputNum);
					var ffce = document.getElementById("ffce" + inputNum);
					var fce = document.getElementById("fce");
					if(parseFloat(cfce.value) >= 0){
						var calculo13 = parseFloat((parseFloat(cfce.value) * 30)/fce.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pfce.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc4.value) + parseFloat(pfce.value))/10).toFixed(2);
						if( parseFloat(cfce.value) <= fce.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6){
								ffce.value = Math.round(5);
							}
							else{
								ffce.value = Math.round(dos2);
							}
						}
					}
					
				}
				else if(parseFloat(ctc4.value) == 0){
					ptc4.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc4.value='0';
				}
			}
			
			function calculate10_5(id){//calculo knotion 5
				var ctc3 = document.getElementById(id);
				var inputNum = id.split("ctc3")[1];
				var ptc3 = document.getElementById("ptc3" + inputNum);
				var tc3 = document.getElementById("tc3");
				
				if(parseFloat(ctc3.value) > 0 && parseFloat(ctc3.value) <= tc3.value){
					var calculo = parseFloat((parseFloat(ctc3.value) * 70)/parseFloat(tc3.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc3.value=dos;
					var ccn = document.getElementById("ccn" + inputNum);
					var pcn = document.getElementById("pcn" + inputNum);
					var fcn = document.getElementById("fcn" + inputNum);
					var cn = document.getElementById("cn");
					if(parseFloat(ccn.value) >= 0){
						var calculo13 = parseFloat((parseFloat(ccn.value) * 30)/cn.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pcn.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc3.value) + parseFloat(pcn.value))/10).toFixed(2);
						if( parseFloat(ccn.value) <= cn.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6)
								fcn.value = Math.round(5);
							else{
								fcn.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc3.value) == 0){
					ptc3.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc3.value='0';
				}
			}
			
			function calculate10_6(id){//calculo Knotion 6
				var ctc4 = document.getElementById(id);
				var inputNum = id.split("ctc4")[1];
				var ptc4 = document.getElementById("ptc4" + inputNum);
				var tc4 = document.getElementById("tc4");
				
				if(parseFloat(ctc4.value) > 0 && parseFloat(ctc4.value) <= tc4.value){
					var calculo = parseFloat((parseFloat(ctc4.value) * 70)/parseFloat(tc4.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc4.value=dos;
					var cedv = document.getElementById("cedv" + inputNum);
					var pedv = document.getElementById("pedv" + inputNum);
					var fedv = document.getElementById("fedv" + inputNum);
					var edv = document.getElementById("edv");
					if(parseFloat(cedv.value) >= 0){
						var calculo13 = parseFloat((parseFloat(cedv.value) * 30)/edv.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pedv.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc4.value) + parseFloat(pedv.value))/10).toFixed(2);
						if( parseFloat(cedv.value) <= edv.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6)
								fedv.value = Math.round(5);
							else{
								fedv.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc4.value) == 0){
					ptc4.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc4.value='0';
				}
			}
			
			function calculate10_7(id){
				var ctc5 = document.getElementById(id);
				var inputNum = id.split("ctc5")[1];
				var ptc5 = document.getElementById("ptc5" + inputNum);
				var tc5 = document.getElementById("tc5");
				
				if(parseFloat(ctc5.value) > 0 && parseFloat(ctc5.value) <= tc5.value){
					var calculo = parseFloat((parseFloat(ctc5.value) * 70)/parseFloat(tc5.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc5.value=dos;
					var cfce = document.getElementById("cfce" + inputNum);
					var pfce = document.getElementById("pfce" + inputNum);
					var ffce = document.getElementById("ffce" + inputNum);
					var fce = document.getElementById("fce");
					if(parseFloat(cfce.value) >= 0){
						var calculo13 = parseFloat((parseFloat(cfce.value) * 30)/fce.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pfce.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc5.value) + parseFloat(pfce.value))/10).toFixed(2);
						if( parseFloat(cfce.value) <= fce.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6)
								ffce.value = Math.round(5);
							else{
								ffce.value = Math.round(dos2);
							}
						}
					}
					
				}
				else if(parseFloat(ctc5.value) == 0){
					ptc5.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc5.value='0';
				}
			}
			
			function calculate10_8(id){
				var ctc3 = document.getElementById(id);
				var inputNum = id.split("ctc3")[1];
				var ptc3 = document.getElementById("ptc3" + inputNum);
				var tc3 = document.getElementById("tc3");
				
				if(parseFloat(ctc3.value) > 0 && parseFloat(ctc3.value) <= tc3.value){
					var calculo = parseFloat((parseFloat(ctc3.value) * 70)/parseFloat(tc3.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc3.value=dos;
					var ccn = document.getElementById("ccn" + inputNum);
					var pcn = document.getElementById("pcn" + inputNum);
					var fcn = document.getElementById("fcn" + inputNum);
					var cn = document.getElementById("cn");
					if(parseFloat(ccn.value) >= 0){
						var calculo13 = parseFloat((parseFloat(ccn.value) * 30)/cn.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pcn.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc3.value) + parseFloat(pcn.value))/10).toFixed(2);
						if( parseFloat(ccn.value) <= cn.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6){
								fcn.value = Math.round(5);
							}
							else{
								fcn.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc3.value) == 0){
					ptc3.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc3.value='0';
				}
			}
			
			function calculate10_9(id){
				var ctc4 = document.getElementById(id);
				var inputNum = id.split("ctc4")[1];
				var ptc4 = document.getElementById("ptc4" + inputNum);
				var tc4 = document.getElementById("tc4");
				
				if(parseFloat(ctc4.value) > 0 && parseFloat(ctc4.value) <= tc4.value){
					var calculo = parseFloat((parseFloat(ctc4.value) * 70)/parseFloat(tc4.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc4.value=dos;
					var cgeo = document.getElementById("cgeo" + inputNum);
					var pgeo = document.getElementById("pgeo" + inputNum);
					var fgeo = document.getElementById("fgeo" + inputNum);
					var geo = document.getElementById("geo");
					if(parseFloat(cgeo.value) >= 0){
						var calculo13 = parseFloat((parseFloat(cgeo.value) * 30)/geo.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pgeo.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc4.value) + parseFloat(pgeo.value))/10).toFixed(2);
						if( parseFloat(cgeo.value) <= geo.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6)
								fgeo.value = Math.round(5);
							else{
								fgeo.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc4.value) == 0){
					ptc4.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc4.value='0';
				}
			}
			
			function calculate10_10(id){
				var ctc5 = document.getElementById(id);
				var inputNum = id.split("ctc5")[1];
				var ptc5 = document.getElementById("ptc5" + inputNum);
				var tc5 = document.getElementById("tc5");
				
				if(parseFloat(ctc3.value) > 0 && parseFloat(ctc5.value) <= tc5.value){
					var calculo = parseFloat((parseFloat(ctc5.value) * 70)/parseFloat(tc5.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc5.value=dos;
					var chis = document.getElementById("chis" + inputNum);
					var phis = document.getElementById("phis" + inputNum);
					var fhis = document.getElementById("fhis" + inputNum);
					var his = document.getElementById("his");
					if(parseFloat(chis.value) >= 0){
						var calculo13 = parseFloat((parseFloat(chis.value) * 30)/his.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						phis.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc5.value) + parseFloat(pt.value) + parseFloat(phis.value))/10).toFixed(2);
						if( parseFloat(chis.value) <= his.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6)
								fhis.value = Math.round(5);
							else{
								fhis.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc5.value) == 0){
					ptc5.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc5.value='0';
				}
			}
			
			function calculate10_11(id){
				var ctc6 = document.getElementById(id);
				var inputNum = id.split("ctc6")[1];
				var ptc6 = document.getElementById("ptc6" + inputNum);
				var tc6 = document.getElementById("tc6");
				
				if(parseFloat(ctc6.value) > 0 && parseFloat(ctc6.value) <= tc6.value){
					var calculo = parseFloat((parseFloat(ctc6.value) * 70)/parseFloat(tc6.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc6.value=dos;
					var cfce = document.getElementById("cfce" + inputNum);
					var pfce = document.getElementById("pfce" + inputNum);
					var ffce = document.getElementById("ffce" + inputNum);
					var fce = document.getElementById("fce");
					if(parseFloat(cfce.value) >= 0){
						var calculo13 = parseFloat((parseFloat(cfce.value) * 30)/fce.value).toFixed(2);
						var arr = calculo13.split(".");  // declaro el array 
						var entero= arr[0];
						var decimal = arr[1];
						var uno = decimal.substring(0,1);
						var dos=entero+'.'+uno;
						pfce.value=dos;
						var calculo14 = parseFloat((parseFloat(ptc6.value) + parseFloat(pfce.value))/10).toFixed(2);
						if( parseFloat(cfce.value) <= fce.value){
							var arr2 = calculo14.split(".");  // declaro el array 
							var entero2= arr2[0];
							var decimal2 = arr2[1];
							var uno2 = decimal2.substring(0,1);
							var dos2=entero2+'.'+uno2;
							otro2=(dos2);
							if (otro2 < 6)
								ffce.value = Math.round(5);
							else{
								ffce.value = Math.round(dos2);
							}
						}
					}
				}
				else if(parseFloat(ctc6.value) == 0){
					ptc6.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo establecido en Tareas.")
					ctc6.value='0';
				}
			}
			
			function calculate12(id){//Calculo Español
				var cesp = document.getElementById(id);
				var inputNum = id.split("cesp")[1];
				var pesp = document.getElementById("pesp" + inputNum);
				var fesp = document.getElementById("fesp" + inputNum);
				var esp = document.getElementById("esp");
				if(parseFloat(cesp.value) > 0 && parseFloat(cesp.value) <= esp.value){
					var ptc1 = document.getElementById("ptc1" + inputNum);
					var ctc1 = document.getElementById("ctc1" + inputNum);
					var tc1 = document.getElementById("tc1");
					var calculo = parseFloat((parseFloat(ctc1.value) * 70)/parseFloat(tc1.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc1.value=dos;
					var calculo3 = parseFloat((parseFloat(cesp.value) * 30)/parseFloat(esp.value)).toFixed(2);
					arr = calculo3.split(".");  // declaro el array 
					entero= arr[0];
					decimal = arr[1];
					uno = decimal.substring(0,1);
					dos=entero+'.'+uno;
					pesp.value=dos;
					var calculo4 = parseFloat((parseFloat(ptc1.value) + parseFloat(pesp.value))/10).toFixed(2);
					var arr = calculo4.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					otro=(dos);
					if (otro < 6){
						fesp.value = Math.round(5);
					}
					else{
						fesp.value = Math.round(dos);
					}
					
				}
				else if(parseFloat(cesp.value) == 0){
					fesp.value = '0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Lengua Materna.")
					cesp.value='0';
				}
			}
			
			function calculate13(id){//Calculo Matematicas
				var cmat = document.getElementById(id);
				var inputNum = id.split("cmat")[1];
				var pmat = document.getElementById("pmat" + inputNum);
				var fmat = document.getElementById("fmat" + inputNum);
				var mat = document.getElementById("mat");
				
				if(parseFloat(cmat.value) > 0 && parseFloat(cmat.value) <= mat.value){
					var ptc2 = document.getElementById("ptc2" + inputNum);
					var ctc2 = document.getElementById("ctc2" + inputNum);
					var tc2 = document.getElementById("tc2");
					var calculo = parseFloat((parseFloat(ctc2.value) * 70)/parseFloat(tc2.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc2.value=dos;
					var calculo8 = parseFloat((parseFloat(cmat.value) * 30)/mat.value).toFixed(2);
					var arr = calculo8.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pmat.value=dos;
					var calculo9 = parseFloat((parseFloat(ptc2.value) + parseFloat(pmat.value))/10).toFixed(2);
					var arr1 = calculo9.split(".");  // declaro el array 
					var entero1= arr1[0];
					var decimal1 = arr1[1];
					var uno1 = decimal1.substring(0,1);
					var dos1=entero1+'.'+uno1;
					otro1=(dos1);
					if (otro1 < 6){
						fmat.value = Math.round(5);
					}
					else{
						fmat.value = Math.round(dos1);
					}
				}
				else if(parseFloat(cmat.value) == 0){
					fmat.value = '0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Matem\u00e1ticas.")
					cmat.value='0';
				}
			}
			function calculate14(id){//Calculo Entidad Donde vivo
				var cens = document.getElementById(id);
				var inputNum = id.split("cens")[1];
				var pens = document.getElementById("pens" + inputNum);
				var fens = document.getElementById("fens" + inputNum);
				var ens = document.getElementById("ens");
				if(parseFloat(cens.value) > 0 && parseFloat(cens.value) <= ens.value){
					var ptc3 = document.getElementById("ptc3" + inputNum);
					var ctc3 = document.getElementById("ctc3" + inputNum);
					var tc3 = document.getElementById("tc3");
					var calculo = parseFloat((parseFloat(ctc3.value) * 70)/parseFloat(tc3.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc3.value=dos;
					var calculo13 = parseFloat((parseFloat(cens.value) * 30)/ens.value).toFixed(2);
					var arr = calculo13.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pens.value=dos;
					var calculo14 = parseFloat((parseFloat(ptc3.value) + parseFloat(pens.value))/10).toFixed(2);
					var arr2 = calculo14.split(".");  // declaro el array 
					var entero2= arr2[0];
					var decimal2 = arr2[1];
					var uno2 = decimal2.substring(0,1);
					var dos2=entero2+'.'+uno2;
					otro2=(dos2);
					if (otro2 < 6){
						fens.value = Math.round(5);
					}
					else{
						fens.value = Math.round(dos2);
					}
				}
				else if(parseFloat(cens.value) == 0){
					fens.value = '0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Conocimiento del Medio.")
					cens.value='0';
				}
			}
			
			function calculate8(id){//Calculo Formacion Civica y etica
				var cfce = document.getElementById(id);
				var inputNum = id.split("cfce")[1];
				var pfce = document.getElementById("pfce" + inputNum);
				var ffce = document.getElementById("ffce" + inputNum);
				var fce = document.getElementById("fce");
				if(parseFloat(cfce.value) > 0 && parseFloat(cfce.value) <= fce.value){
					var ptc4 = document.getElementById("ptc4" + inputNum);
					var ctc4 = document.getElementById("ctc4" + inputNum);
					var tc4 = document.getElementById("tc4");
					var calculo = parseFloat((parseFloat(ctc4.value) * 70)/parseFloat(tc4.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc4.value=dos;
					var calculo38 = parseFloat((parseFloat(cfce.value) * 30)/fce.value).toFixed(2);
					var arr = calculo38.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pfce.value=dos;
					var calculo39 = parseFloat((parseFloat(ptc4.value) + parseFloat(pfce.value))/10).toFixed(2);
					var arr7 = calculo39.split(".");  // declaro el array 
					var entero7= arr7[0];
					var decimal7 = arr7[1];
					var uno7 = decimal7.substring(0,1);
					var dos7=entero7+'.'+uno7;
					otro7=(dos7);
					if (otro7 < 6){
						ffce.value = Math.round(5);
					}
					else{
						ffce.value = Math.round(dos7);
					}
				}
				else if(parseFloat(cfce.value) == 0){
					ffce.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Formación C\u00edvica y \u00c9tica.")
					cfce.value='0';
				}
			}
			
			function calculate4(id){//Calculo Ciencias naturales
				var ccn = document.getElementById(id);
				var inputNum = id.split("ccn")[1];
				var pcn = document.getElementById("pcn" + inputNum);
				var fcn = document.getElementById("fcn" + inputNum);
				var cn = document.getElementById("cn");
				if(parseFloat(ccn.value) > 0 && parseFloat(ccn.value) <= cn.value){
					var ptc3 = document.getElementById("ptc3" + inputNum);
					var ctc3 = document.getElementById("ctc3" + inputNum);
					var tc3 = document.getElementById("tc3");
					var calculo = parseFloat((parseFloat(ctc3.value) * 70)/parseFloat(tc3.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc3.value=dos;
					var calculo18 = parseFloat((parseFloat(ccn.value) * 30)/cn.value).toFixed(2);
					var arr = calculo18.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pcn.value=dos;
					var calculo19 = parseFloat((parseFloat(ptc3.value) + parseFloat(pcn.value))/10).toFixed(2);
					var arr3 = calculo19.split(".");  // declaro el array 
					var entero3= arr3[0];
					var decimal3 = arr3[1];
					var uno3 = decimal3.substring(0,1);
					var dos3=entero3+'.'+uno3;
					otro3=(dos3);
					if (otro3 < 6){
						fcn.value = Math.round(5);
					}
					else{
						fcn.value = Math.round(dos3);
					}	
				}
				else if(parseFloat(ccn.value) == 0){
					fcn.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Ciencias Naturales.")
					ccn.value='0';
				}
			}
			
			function calculate5(id){//Calculo entidad donde vivo
				var cedv = document.getElementById(id);
				var inputNum = id.split("cedv")[1];
				var pedv = document.getElementById("pedv" + inputNum);
				var fedv = document.getElementById("fedv" + inputNum);
				var edv = document.getElementById("edv");
				if(parseFloat(cedv.value) > 0 && parseFloat(cedv.value) <= edv.value){
					var ptc4 = document.getElementById("ptc4" + inputNum);
					var ctc4 = document.getElementById("ctc4" + inputNum);
					var tc4 = document.getElementById("tc4");
					var calculo = parseFloat((parseFloat(ctc4.value) * 70)/parseFloat(tc4.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc4.value=dos;
					var calculo23 = parseFloat((parseFloat(cedv.value) * 30)/edv.value).toFixed(2);
					var arr = calculo23.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pedv.value=dos;
					var calculo24 = parseFloat((parseFloat(ptc4.value) + parseFloat(pedv.value))/10).toFixed(2);
					var arr4 = calculo24.split(".");  // declaro el array 
					var entero4= arr4[0];
					var decimal4 = arr4[1];
					var uno4 = decimal4.substring(0,1);
					var dos4=entero4+'.'+uno4;
					otro4=(dos4);
					if (otro4 < 6)
						fedv.value = Math.round(5);
					else{
						fedv.value = Math.round(dos4);
					}
				}
				else if(parseFloat(cedv.value) == 0){
					fedv.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI La Entidad Donde Vivo.")
					cedv.value='0';
				}
			}
			
			function calculate8_1(id){//Calculo Formacion Civica y etica
				var cfce = document.getElementById(id);
				var inputNum = id.split("cfce")[1];
				var pfce = document.getElementById("pfce" + inputNum);
				var ffce = document.getElementById("ffce" + inputNum);
				var fce = document.getElementById("fce");
				if(parseFloat(cfce.value) > 0 && parseFloat(cfce.value) <= fce.value){
					var ptc5 = document.getElementById("ptc5" + inputNum);
					var ctc5 = document.getElementById("ctc5" + inputNum);
					var tc5 = document.getElementById("tc5");
					var calculo = parseFloat((parseFloat(ctc5.value) * 70)/parseFloat(tc5.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc5.value=dos;
					var calculo38 = parseFloat((parseFloat(cfce.value) * 30)/fce.value).toFixed(2);
					var arr = calculo38.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pfce.value=dos;
					var calculo39 = parseFloat((parseFloat(ptc5.value) + parseFloat(pfce.value))/10).toFixed(2);
					var arr7 = calculo39.split(".");  // declaro el array 
					var entero7= arr7[0];
					var decimal7 = arr7[1];
					var uno7 = decimal7.substring(0,1);
					var dos7=entero7+'.'+uno7;
					otro7=(dos7);
					if (otro7 < 6){
						ffce.value = Math.round(5);
					}
					else{
						ffce.value = Math.round(dos7);
					}
				}
				else if(parseFloat(cfce.value) == 0){
					ffce.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Formación C\u00edvica y \u00c9tica.")
					cfce.value='0';
				}
			}
			
			function calculate6(id){
				var cgeo = document.getElementById(id);
				var inputNum = id.split("cgeo")[1];
				var pgeo = document.getElementById("pgeo" + inputNum);
				var fgeo = document.getElementById("fgeo" + inputNum);
				var geo = document.getElementById("geo");
				if(parseFloat(cgeo.value) > 0 && parseFloat(cgeo.value) <= geo.value){
					var ptc4 = document.getElementById("ptc4" + inputNum);
					var ctc4 = document.getElementById("ctc4" + inputNum);
					var tc4 = document.getElementById("tc4");
					var calculo = parseFloat((parseFloat(ctc4.value) * 70)/parseFloat(tc4.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc4.value=dos;
					var calculo23 = parseFloat((parseFloat(cgeo.value) * 30)/geo.value).toFixed(2);
					var arr = calculo23.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pgeo.value=dos;
					var calculo24 = parseFloat((parseFloat(ptc4.value) + parseFloat(pgeo.value))/10).toFixed(2);
					var arr4 = calculo24.split(".");  // declaro el array 
					var entero4= arr4[0];
					var decimal4 = arr4[1];
					var uno4 = decimal4.substring(0,1);
					var dos4=entero4+'.'+uno4;
					otro4=(dos4);
					if (otro4 < 6)
						fgeo.value = Math.round(5);
					else{
						fgeo.value = Math.round(dos4);
					}
				}
				else if(parseFloat(cgeo.value) == 0){
					fgeo.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI La Entidad Donde Vivo.")
					cedv.value='0';
				}
			}
			
			function calculate7(id){
				var chis = document.getElementById(id);
				var inputNum = id.split("chis")[1];
				/*var ptc = document.getElementById("ptc" + inputNum);
				var pt = document.getElementById("pt" + inputNum);
				//var pdps = document.getElementById("pdps" + inputNum);*/
				var phis = document.getElementById("phis" + inputNum);
				var fhis = document.getElementById("fhis" + inputNum);
				var his = document.getElementById("his");
				if(parseFloat(chis.value) > 0 && parseFloat(chis.value) <= his.value){
					var ptc5 = document.getElementById("ptc5" + inputNum);
					var ctc5 = document.getElementById("ctc5" + inputNum);
					var tc5 = document.getElementById("tc5");
					var calculo = parseFloat((parseFloat(ctc5.value) * 70)/parseFloat(tc5.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc5.value=dos;
					var calculo33 = parseFloat((parseFloat(chis.value) * 30)/his.value).toFixed(2);
					var arr = calculo33.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					phis.value=dos;
					var calculo34 = parseFloat((parseFloat(ptc5.value) + parseFloat(phis.value))/10).toFixed(2);
					var arr6 = calculo34.split(".");  // declaro el array 
					var entero6= arr6[0];
					var decimal6 = arr6[1];
					var uno6 = decimal6.substring(0,1);
					var dos6 = entero6+'.'+uno6;
					otro6=(dos6);
					if (otro6 < 6)
						fhis.value = Math.round(5);
					else{
						fhis.value = Math.round(dos6);
					}
				}
				else if(parseFloat(chis.value) == 0){
					fhis.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Historia.")
					chis.value='0';
				}
			}
			
			function calculate8_2(id){//Calculo Formacion Civica y etica
				var cfce = document.getElementById(id);
				var inputNum = id.split("cfce")[1];
				var pfce = document.getElementById("pfce" + inputNum);
				var ffce = document.getElementById("ffce" + inputNum);
				var fce = document.getElementById("fce");
				if(parseFloat(cfce.value) > 0 && parseFloat(cfce.value) <= fce.value){
					var ptc6 = document.getElementById("ptc6" + inputNum);
					var ctc6 = document.getElementById("ctc6" + inputNum);
					var tc6 = document.getElementById("tc6");
					var calculo = parseFloat((parseFloat(ctc6.value) * 70)/parseFloat(tc6.value)).toFixed(2);
					var arr = calculo.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					ptc6.value=dos;
					var calculo38 = parseFloat((parseFloat(cfce.value) * 30)/fce.value).toFixed(2);
					var arr = calculo38.split(".");  // declaro el array 
					var entero= arr[0];
					var decimal = arr[1];
					var uno = decimal.substring(0,1);
					var dos=entero+'.'+uno;
					pfce.value=dos;
					var calculo39 = parseFloat((parseFloat(ptc6.value) + parseFloat(pfce.value))/10).toFixed(2);
					var arr7 = calculo39.split(".");  // declaro el array 
					var entero7= arr7[0];
					var decimal7 = arr7[1];
					var uno7 = decimal7.substring(0,1);
					var dos7=entero7+'.'+uno7;
					otro7=(dos7);
					if (otro7 < 6){
						ffce.value = Math.round(5);
					}
					else{
						ffce.value = Math.round(dos7);
					}
				}
				else if(parseFloat(cfce.value) == 0){
					ffce.value='0';
				}
				else{
					alert("Debe ingresar un n\u00famero menor o igual al m\u00e1ximo que se ingreso en MCFI Formación C\u00edvica y \u00c9tica.")
					cfce.value='0';
				}
			}
		</SCRIPT>
		<script>
			function simularTab(evento, obj, codigo){
				var key = (evento.which) ? evento.which : evento.keyCode;
				for (var i=2; i<arguments.length; ++i) {
					if (arguments[i]==key) {
						try {
							if (evento.which) { 
								evento.which = 9; 
							} 
							else { 
								evento.keyCode = 9; 
							}
						} 
						catch(err) { 
							alert(err.description); 
						}
						obj.onkeyup = function () {
							try {
								if (evento.which) {
									evento.which = key;
								}
								else {
									evento.keyCode = key;
								}
								return true;
							} 
							catch(err) { 
								alert(err.description); 
							}
						}
						return true;
					}	
				}
				return true;				
			}
		</script>
		<script language="JavaScript"> 
			function abrir(pagina,titulo){
				window.open(pagina,titulo,'width=800,height=500,menubar=no,scrollbars=no,toolbar=no,location=no,directories=no,resizable=yes,top=0,left=0');
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