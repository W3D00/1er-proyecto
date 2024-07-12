<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	session_start();
	include "../../conexion/conexion.php";
	error_reporting(0);

	$boton=$_POST['Capturar'];
	IF($boton == 'Actualizar'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		if(isset($_POST['idFis'])){
			$idFis =  $_POST["idFis"];
		}
		if(isset($_POST['fisica'])){
			$fisica =  $_POST["fisica"];
		}
		else{
			$fisica = 0;
		}
		if(isset($_POST['pfisica'])){
			$pfisica =  $_POST["pfisica"];
		}
		else{
			$pfisica = 0;
		}
		if(isset($_POST['sumafisica'])){
			$sumafisica =  $_POST["sumafisica"];
		}
		else{
			$sumafisica = 0;
		}
		if(isset($_POST['ffisica'])){
			$ffisica =  $_POST["ffisica"];
		}
		else{
			$ffisica = 0;
		}
		
		for($j = 1; $j < $no_filas; $j++) {
			if (empty($fisica[$j])) {$fisica[$j]=0;}
			if (empty($pfisica[$j])) {$pfisica[$j]=0;}
			if (empty($sumafisica[$j])) {$sumafisica[$j]=0;}
			if (empty($ffisica[$j])) {$ffisica[$j]=0;}
		}
		
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionfisica` SET `evidencias` = '".$fisica[$j]."', `porcentajeEvidencias` = '".$pfisica[$j]."', `suma` = '".$sumafisica[$j]."', `porcentajeFinal` = '".$ffisica[$j]."' WHERE `calificacionfisica`.`id` = '".$idFis[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_deportes.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_calificaciones_deportes.php';</script>";
		}
	}
	IF($boton == 'Capturar'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		if(isset($_POST['fisica'])){
			$fisica =  $_POST["fisica"];
		}
		else{
			$fisica = 0;
		}
		if(isset($_POST['pfisica'])){
			$pfisica =  $_POST["pfisica"];
		}
		else{
			$pfisica = 0;
		}
		if(isset($_POST['sumafisica'])){
			$sumafisica =  $_POST["sumafisica"];
		}
		else{
			$sumafisica = 0;
		}
		if(isset($_POST['ffisica'])){
			$ffisica =  $_POST["ffisica"];
		}
		else{
			$ffisica = 0;
		}
		
		for($j = 1; $j < $no_filas; $j++) {
			if (empty($fisica[$j])) {$fisica[$j]=0;}
			if (empty($pfisica[$j])) {$pfisica[$j]=0;}
			if (empty($sumafisica[$j])) {$sumafisica[$j]=0;}
			if (empty($ffisica[$j])) {$ffisica[$j]=0;}
		}
		
		if(isset($_SESSION['id'])){
			for($i = 1; $i < $no_filas; $i++) {
				$sql = mysqli_query($conexion,"INSERT INTO calificacionfisica (id, alumno, educacionFisica, unidad, ciclo, evidencias, porcentajeEvidencias, suma, porcentajeFinal, bloquear) values (NULL, '".$ids[$i]."', '".$_SESSION['deporte']."', '".$_SESSION['bloque']."','".$_SESSION['ciclo']."', '".$fisica[$i]."', '".$pfisica[$i]."', '".$sumafisica[$i]."', '".$ffisica[$i]."', '0')") or die ("Error 1: ".mysqli_error($conexion));
			}
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_deportes.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_calificaciones_deportes.php';</script>";
		}
	}
?>
