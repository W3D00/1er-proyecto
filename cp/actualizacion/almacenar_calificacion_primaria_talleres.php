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
		if(isset($_POST['idart'])){
			$idart =  $_POST["idart"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionartes` SET `bloquear` = '0' WHERE `calificacionartes`.`id` = '".$idart[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_talleres.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_talleres.php';</script>";
		}
	}
	IF($boton == 'Bloquear'){
		$no_filas = $_POST['filas'];
		if(isset($_POST['idart'])){
			$idart =  $_POST["idart"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionartes` SET `bloquear` = '1' WHERE `calificacionartes`.`id` = '".$idart[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_talleres.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_talleres.php';</script>";
		}
	}
	IF($boton == 'Actualizar'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		if(isset($_POST['idart'])){
			$idart =  $_POST["idart"];
		}
		if(isset($_POST['arte'])){
			$arte =  $_POST["arte"];
		}
		if(isset($_POST['part'])){
			$part =  $_POST["part"];
		}
		if(isset($_POST['sumaart'])){
			$sumaart =  $_POST["sumaart"];
		}
		if(isset($_POST['fart'])){
			$fart =  $_POST["fart"];
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionartes` SET `evidencias` = '".$arte[$j]."', `porcentajeEvidencias` = '".$part[$j]."', `suma` = '".$sumaart[$j]."', `porcentajeFinal` = '".$part[$j]."' WHERE `calificacionartes`.`id` = '".$idart[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_talleres.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_talleres.php';</script>";
		}
	}
?>
