<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');

	session_start();
	include "../../conexion/conexion.php";
	error_reporting(0);
	$boton=$_POST['Capturar'];
	IF($boton == 'Desbloquear'){
		$no_filas = $_POST['filas'];
		if(isset($_POST['idClub'])){
			$idClub =  $_POST["idClub"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionclub` SET `bloquear` = '0' WHERE `calificacionclub`.`id` = '".$idClub[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_club.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_club.php';</script>";
		}
	}
	IF($boton == 'Bloquear'){
		$no_filas = $_POST['filas'];
		if(isset($_POST['idClub'])){
			$idClub =  $_POST["idClub"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionclub` SET `bloquear` = '1' WHERE `calificacionclub`.`id` = '".$idClub[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_club.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_club.php';</script>";
		}
	}IF($boton == 'Actualizar'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
	
		if(isset($_POST['idClub'])){
			$idClub =  $_POST["idClub"];
		}
		if(isset($_POST['tec'])){
			$tec =  $_POST["tec"];
		}
		else{
			$tec = 0;
		}
		if(isset($_POST['ptec'])){
			$ptec =  $_POST["ptec"];
		}
		else{
			$ptec = 0;
		}
		if(isset($_POST['sumatec'])){
			$sumatec =  $_POST["sumatec"];
		}
		else{
			$sumatec = 0;
		}
		if(isset($_POST['ftec'])){
			$ftec =  $_POST["ftec"];
		}
		else{
			$ftec = 0;
		}
		
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionclub` SET `evidencias` = '".$tec[$j]."', `porcentajeEvidencias` = '".$ptec[$j]."', `suma` = '".$sumatec[$j]."', `porcentajeFinal` = '".$ftec[$j]."' WHERE `calificacionclub`.`id` = '".$idClub[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_club.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_club.php';</script>";
		}
	}
?>
