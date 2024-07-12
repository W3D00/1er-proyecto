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
		$ids = $_SESSION['id'];
		
		if(isset($_POST['idFis'])){
			$idFis =  $_POST["idFis"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionfisica` SET `bloquear` = '0' WHERE `calificacionfisica`.`id` = '".$idFis[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_deportes.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_deportes.php';</script>";
		}
	}
	IF($boton == 'Bloquear'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		if(isset($_POST['idFis'])){
			$idFis =  $_POST["idFis"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionfisica` SET `bloquear` = '1' WHERE `calificacionfisica`.`id` = '".$idFis[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_deportes.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_deportes.php';</script>";
		}
	}
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
			$sql = mysqli_query($conexion,"UPDATE `calificacionfisica` SET `evidencias` = '".$fisica[$j]."', `porcentajeEvidencias` = '".$pfisica[$j]."', `suma` = '".$sumafisica[$j]."', `porcentajeFinal` = '".$ffisica[$j]."' WHERE `calificacionfisica`.`id` = '".$idFis[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_deportes.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_deportes.php';</script>";
		}
	}
?>
