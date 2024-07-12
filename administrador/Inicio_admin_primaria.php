<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	error_reporting(0);
	
	if(isset($_SESSION['userid'])){
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Captura de calificaciones</title>
		<style type="text/css">
			.Fuente1 {
				font-family: Arial, Helvetica, sans-serif;
				text-align: center;
			}
			body {
				background-image: url(../../Pictures/simple-blue-ii.jpg);
			}
			.Fuente1 h1 center table tr th {
				font-size: 16px;
			}
			.Fuente1 h1 center #form1 label {
				font-size: 14px;
			}
			.Fuente1 h1 center #form1 .Fuente1 {
				font-size: 14px;
			}
			.Fuente1 h1 center #form1 {
				font-size: 14px;
			}
			.Fuente1 h1 center #form2 label {
				font-size: 14px;
			}
			
			#menu ul li:first-child a:after { 
				content: ''; 
				position: absolute; 
				left: 30px; 
				top: -8px; 
				width: 0; 
				height: 0; 
				border-left: 5px solid transparent; 
				border-right: 5px solid transparent; 
				border-bottom: 8px solid #444; 
			} 
			#menu ul li:first-child a:hover:after { 
				border-bottom-color: #009; 
			} 
		</style>
	</head>
	<body class="Fuente1">
		<h1><center>
			<p>BIENVENIDO</p>
			<center>
				Administrador: <?php echo $_SESSION['username']; ?></th>
			</center><br>
			<form id="form1" name="form1" method="post" action="">
			  <table width="483" height="1018" border="1" align="center">
                <tr>
						<th colspan="2" align="center" valign="middle">Administrador</th>
</tr>
				  <tr>
				    <th width="288" scope="row">CAPTURA CICLO ESCOLAR</th>
				    <td width="144" align="center" valign="middle"><button type="button" onclick="location.href = 'captura/captura_ciclo.php'" >Entrar</button></td>
			      </tr>
				  <tr>
				    <th width="288" scope="row">Captura de Periodo a Evaluar</th>
				    <td width="144" align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_periodo_calificacion.php'" >Entrar</button></td>
			      </tr>
				  <tr>
				    <th width="288" scope="row">Registro de alumnos nuevos</th>
				    <td width="144" align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_registro_alumno.php'" >Entrar</button></td>
			      </tr>
				  <tr>
				    <th width="288" scope="row">PROMOVER ALUMNOS</th>
				    <td width="144" align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_promover_alumno.php'" >Entrar</button></td>
			      </tr>
				  <!--tr>
				    <th rowspan="5">Captura de Calificaciones</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_calificaciones.php'" >Espa&ntilde;ol</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_calificaciones_ingles.php'" >Ingl&eacute;s</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_calificaciones_deportes.php'" >Educaci&oacute;n</button></td>
			      </tr>
				  <tr>
				   	<td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_calificaciones_computacion.php'" >Computaci&oacute;n</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_calificaciones_talleres.php'" >Educaci&oacute;n Art&iacute;stica</button></td>
			      </tr>
				  <tr>
				    <th rowspan="5">Modificaci&oacute;n de Calificaciones</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'actualizacion/Inicio_actualizar_calificaciones.php'" >Espa&ntilde;ol</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'actualizacion/Inicio_actualizar_calificaciones_ingles.php'" >Ingl&eacute;s</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'actualizacion/Inicio_actualizar_calificaciones_deportes.php'" >Educaci&oacute;n f&iacute;sica</button></td>
			      </tr>
				  <tr>
				   <td align="center" valign="middle"><button type="button" onclick="location.href = 'actualizacion/Inicio_actualizar_calificaciones_computacion.php'" >Computaci&oacute;n</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'actualizacion/Inicio_actualizar_calificaciones_talleres.php'" >Educaci&oacute;n Art&iacute;stica</button></td>
			      </tr>
				  
				   <tr>
				    <th rowspan="5">Consulta de Calificaciones</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'consultas/Inicio_consulta_calificaciones.php'" >Espa&ntilde;ol</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'consultas/Inicio_consulta_calificaciones_ingles.php'" >Ingl&eacute;s</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'consultas/Inicio_consulta_calificaciones_deportes.php'" >Educaci&oacute;n f&iacute;sica</button></td>
			      </tr>
				  <tr>
				   <td align="center" valign="middle"><button type="button" onclick="location.href = 'consultas/Inicio_consulta_calificaciones_computacion.php'" >Computaci&oacute;n</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'consultas/Inicio_consulta_calificaciones_talleres.php'" >Educaci&oacute;n Art&iacute;stica</button></td>
			      </tr>
				  
				  <tr>
				    <th rowspan="5">Captura de Comentarios</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_comentarios.php'" > Espa&ntilde;ol</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_comentarios_ingles.php'" >Ingl&eacute;s</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_comentarios_deportes.php'" >Educaci&oacute;n f&iacute;sica </button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_comentarios_computacion.php'" >Computaci&oacute;n</button></td>
			      </tr>
				  <tr>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_comentarios_talleres.php'" >Educaci&oacute;n Art&iacute;stica</button></td>
			      </tr>
				  <tr>
				    <th scope="row">Bloquear Calificaciones</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'bloquear/Inicio_bloqueo_calificaciones.php'" >Entrar</button></td>
			      </tr>
				  <tr>
				    <th scope="row">Captura de Competencia Lectora</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'captura/Inicio_captura_competencia_lectora.php'" >Entrar</button></td>
			      </tr>
				  <tr>
				    <th scope="row">Boleta</th>
				    <td align="center" valign="middle"><button type="button" onclick="location.href = 'pdf/Inicio_reporte_1o.php'" >Entrar</button></td>
			      </tr-->
			  </table>
			  </form>
			<form id="form2" name="form2" method="post" action="conexion/logout.php">
				<input type="submit" value="Salir" />
			</form>
			<p>&nbsp;</p>
		</center></h1>
		<p>&nbsp;</p>
	</body>
</html>
<?php
	}
	else{
		 header('location: index.php');
	}
?>