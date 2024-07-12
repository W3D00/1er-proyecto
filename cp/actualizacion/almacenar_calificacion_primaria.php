<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	include "../../conexion/conexion.php";
	//error_reporting(0);
	
	//Guardar los terminos a evaluar
	$boton=$_POST['Capturar'];
	IF($boton == 'Actualizar'){
		//Guardar calificacion del alumno
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		$clase = $_POST["clase"];
		
		if(isset($_POST['asist'])){
			$asist =  $_POST["asist"];
		}
		else{
			$asist = 0;
		}
		//español
		if(isset($_POST['mat1'])){
			$idMat[0] =  $_POST["mat1"];
		}
		if(isset($_POST['cesp'])){
			$calificacion[0] =  $_POST["cesp"];
		}
		else{
			$calificacion[0] = 0;
		}
		if(isset($_POST['pesp'])){
			$porcentajeCalificacion[0] =  $_POST["pesp"];
		}
		else{
			$porcentajeCalificacion[0] = 0;
		}
		if(isset($_POST['kesp'])){
			$knotion[0] =  $_POST["kesp"];
		}
		else{
			$knotion[0] = 0;
		}
		if(isset($_POST['pkesp'])){
			$porcentajeKnotion[0] =  $_POST["pkesp"];
		}
		else{
			$porcentajeKnotion[0] = 0;
		}
		if(isset($_POST['sumae'])){
			$suma[0] =  $_POST["sumae"];
		}
		else{
			$suma[0] = 0;
		}
		if(isset($_POST['fesp'])){
			$final[0] =  $_POST["fesp"];
		}
		else{
			$final[0] = 0;
		}
		//matematicas
		if(isset($_POST['mat2'])){
			$idMat[1] =  $_POST["mat2"];
		}
		if(isset($_POST['cmat'])){
			$calificacion[1] =  $_POST["cmat"];
		}
		else{
			$calificacion[1] = 0;
		}
		if(isset($_POST['pmat'])){
			$porcentajeCalificacion[1] =  $_POST["pmat"];
		}
		else{
			$porcentajeCalificacion[1] = 0;
		}
		if(isset($_POST['kmat'])){
			$knotion[1] =  $_POST["kmat"];
		}
		else{
			$knotion[1] = 0;
		}
		if(isset($_POST['pkmat'])){
			$porcentajeKnotion[1] =  $_POST["pkmat"];
		}
		else{
			$porcentajeKnotion[1] = 0;
		}
		if(isset($_POST['sumam'])){
			$suma[1] =  $_POST["sumam"];
		}
		else{
			$suma[1] = 0;
		}
		if(isset($_POST['fmat'])){
			$final[1] =  $_POST["fmat"];
		}
		else{
			$final[1] = 0;
		}
		//Ciencias naturales
		if(isset($_POST['mat3'])){
			$idMat[2] =  $_POST["mat3"];
		}
		if(isset($_POST['ccn'])){
			$calificacion[2] =  $_POST["ccn"];
		}
		else{
			$calificacion[2] = 0;
		}
		if(isset($_POST['pcn'])){
			$porcentajeCalificacion[2] =  $_POST["pcn"];
		}
		else{
			$porcentajeCalificacion[2] = 0;
		}
		if(isset($_POST['kcn'])){
			$knotion[2] =  $_POST["kcn"];
		}
		else{
			$knotion[2] = 0;
		}
		if(isset($_POST['pkcn'])){
			$porcentajeKnotion[2] =  $_POST["pkcn"];
		}
		else{
			$porcentajeKnotion[2] = 0;
		}
		if(isset($_POST['sumacn'])){
			$suma[2] =  $_POST["sumacn"];
		}
		else{
			$suma[2] = 0;
		}
		if(isset($_POST['fcn'])){
			$final[2] =  $_POST["fcn"];
		}
		else{
			$final[2] = 0;
		}
		//ens
		if(isset($_POST['mat4'])){
			$idMat[3] =  $_POST["mat4"];
		}
		if(isset($_POST['cens'])){
			$calificacion[3] =  $_POST["cens"];
		}
		else{
			$calificacion[3] = 0;
		}
		if(isset($_POST['pens'])){
			$porcentajeCalificacion[3] =  $_POST["pens"];
		}
		else{
			$porcentajeCalificacion[3] = 0;
		}
		if(isset($_POST['kens'])){
			$knotion[3] =  $_POST["kens"];
		}
		else{
			$knotion[3] = 0;
		}
		if(isset($_POST['pkens'])){
			$porcentajeKnotion[3] =  $_POST["pkens"];
		}
		else{
			$porcentajeKnotion[3] = 0;
		}
		if(isset($_POST['sumaens'])){
			$suma[3] =  $_POST["sumaens"];
		}
		else{
			$suma[3] = 0;
		}
		if(isset($_POST['fens'])){
			$final[3] =  $_POST["fens"];
		}
		else{
			$final[3] = 0;
		}
		//ese
		if(isset($_POST['mat5'])){
			$idMat[4] =  $_POST["mat5"];
		}
		if(isset($_POST['cese'])){
			$calificacion[4] =  $_POST["cese"];
		}
		else{
			$calificacion[4] = 0;
		}
		if(isset($_POST['pese'])){
			$porcentajeCalificacion[4] =  $_POST["pese"];
		}
		else{
			$porcentajeCalificacion[4] = 0;
		}
		if(isset($_POST['kens'])){
			$knotion[4] =  $_POST["kens"];
		}
		if(isset($_POST['sumaese'])){
			$suma[4] =  $_POST["sumaese"];
		}
		else{
			$suma[4] = 0;
		}
		if(isset($_POST['fese'])){
			$final[4] =  $_POST["fese"];
		}
		else{
			$final[4] = 0;
		}
		
		$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE grado.id = '".$_SESSION['grado']."' and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '3'") or die(mysqli_error($conexion)); 
		$materia=array();
		while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
			$materia[]=$row[0];
		}
		for($i=0;$i<count($materia);$i++){
			for($j = 1; $j < $no_filas; $j++) {
				if($materia[$i]=='ESP001' || $materia[$i]=='ESP002' || $materia[$i]=='ESP003' || $materia[$i]=='ESP004' || $materia[$i]=='ESP005' || $materia[$i]=='ESP006'){
					$sql = mysqli_query($conexion,"UPDATE `calificacionmateria` SET `noClases` = '".$clase."', `asistencia` = '".$asist[$j]."', `evidencias` = '".$calificacion[$i][$j]."', `porcentajeEvidencias` = '".$porcentajeCalificacion[$i][$j]."', `knotion` = '".$knotion[$i][$j]."', `porcentajeKnotion` = '".$porcentajeKnotion[$i][$j]."', `suma` = '".$suma[$i][$j]."', `porcentajeFinal` = '".$final[$i][$j]."' WHERE `calificacionmateria`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
				}
				else if($materia[$i]=='ESE001' || $materia[$i]=='ESE002' || $materia[$i]=='ESE003' || $materia[$i]=='ESE004' || $materia[$i]=='ESE005' || $materia[$i]=='ESE006'){
					$sql = mysqli_query($conexion,"UPDATE `calificacionmateria` SET `evidencias` = '".$calificacion[$i][$j]."', `porcentajeEvidencias` = '".$porcentajeCalificacion[$i][$j]."', `suma` = '".$suma[$i][$j]."', `porcentajeFinal` = '".$final[$i][$j]."' WHERE `calificacionmateria`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
				}
				else{
					$sql = mysqli_query($conexion,"UPDATE `calificacionmateria` SET `evidencias` = '".$calificacion[$i][$j]."', `porcentajeEvidencias` = '".$porcentajeCalificacion[$i][$j]."', `knotion` = '".$knotion[$i][$j]."', `porcentajeKnotion` = '".$porcentajeKnotion[$i][$j]."', `suma` = '".$suma[$i][$j]."', `porcentajeFinal` = '".$final[$i][$j]."' WHERE `calificacionmateria`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
				}
			}
		}
		
	}
	IF($boton == 'Bloquear'){
		//Guardar calificacion del alumno
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		$clase = $_POST["clase"];
		
		if(isset($_POST['asist'])){
			$asist =  $_POST["asist"];
		}
		else{
			$asist = 0;
		}
		//español
		if(isset($_POST['mat1'])){
			$idMat[0] =  $_POST["mat1"];
		}
		//matematicas
		if(isset($_POST['mat2'])){
			$idMat[1] =  $_POST["mat2"];
		}
		//Ciencias naturales
		if(isset($_POST['mat3'])){
			$idMat[2] =  $_POST["mat3"];
		}
		//ens
		if(isset($_POST['mat4'])){
			$idMat[3] =  $_POST["mat4"];
		}
		//ese
		if(isset($_POST['mat5'])){
			$idMat[4] =  $_POST["mat5"];
		}
		
		$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE grado.id = '".$_SESSION['grado']."' and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '3'") or die(mysqli_error($conexion)); 
		$materia=array();
		while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
			$materia[]=$row[0];
		}
		for($i=0;$i<count($materia);$i++){
			for($j = 1; $j < $no_filas; $j++) {
				$sql = mysqli_query($conexion,"UPDATE `calificacionmateria` SET `bloquear` = '1' WHERE `calificacionmateria`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
			}
		}
		
	}
	IF($boton == 'Desbloquear'){
		//Guardar calificacion del alumno
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		$clase = $_POST["clase"];
		
		if(isset($_POST['asist'])){
			$asist =  $_POST["asist"];
		}
		else{
			$asist = 0;
		}
		//español
		if(isset($_POST['mat1'])){
			$idMat[0] =  $_POST["mat1"];
		}
		//matematicas
		if(isset($_POST['mat2'])){
			$idMat[1] =  $_POST["mat2"];
		}
		//Ciencias naturales
		if(isset($_POST['mat3'])){
			$idMat[2] =  $_POST["mat3"];
		}
		//ens
		if(isset($_POST['mat4'])){
			$idMat[3] =  $_POST["mat4"];
		}
		//ese
		if(isset($_POST['mat5'])){
			$idMat[4] =  $_POST["mat5"];
		}
		
		$con1= mysqli_query($conexion,"SELECT clave FROM grado, materiagrado, materia WHERE grado.id = '".$_SESSION['grado']."' and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '3'") or die(mysqli_error($conexion)); 
		$materia=array();
		while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
			$materia[]=$row[0];
		}
		for($i=0;$i<count($materia);$i++){
			for($j = 1; $j < $no_filas; $j++) {
				$sql = mysqli_query($conexion,"UPDATE `calificacionmateria` SET `bloquear` = '0' WHERE `calificacionmateria`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
			}
		}
		
	}
	
	if($sql == false) {
		echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones.php';</script>";
	}
	else{
		echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones.php';</script>";
	}
?>
