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
		for($i=1;$i< $no_filas;$i++){
			if (empty($arte[$i])) {$arte[$i]=0;}
			if (empty($part[$i])) {$part[$i]=0;}
			if (empty($sumaart[$i])) {$sumaart[$i]=0;}
			if (empty($fart[$i])) {$fart[$i]=0;}
		}
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `calificacionartes` SET `evidencias` = '".$arte[$j]."', `porcentajeEvidencias` = '".$part[$j]."', `suma` = '".$sumaart[$j]."', `porcentajeFinal` = '".$part[$j]."' WHERE `calificacionartes`.`id` = '".$idart[$j]."'") or die (mysqli_error($conexion));
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_talleres.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_calificaciones_talleres.php';</script>";
		}
	}
	IF($boton == 'Capturar'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
	
		if(isset($_POST['arte'])){
			$arte =  $_POST["arte"];
		}
		else{
			$arte = 0;
		}
		if(isset($_POST['part'])){
			$part =  $_POST["part"];
		}
		else{
			$part = 0;
		}
		if(isset($_POST['sumaart'])){
			$sumaart =  $_POST["sumaart"];
		}
		else{
			$sumaart = 0;
		}
		if(isset($_POST['fart'])){
			$fart =  $_POST["fart"];
		}
		else{
			$fart = 0;
		}
		for($i=1;$i< $no_filas;$i++){
			if (empty($arte[$i])) {$arte[$i]=0;}
			if (empty($part[$i])) {$part[$i]=0;}
			if (empty($sumaart[$i])) {$sumaart[$i]=0;}
			if (empty($fart[$i])) {$fart[$i]=0;}
		}
		if(isset($_SESSION['id'])){
			for($i = 1; $i < $no_filas; $i++) {
				$sql = mysqli_query($conexion,"INSERT INTO calificacionartes (id, alumno, artes, unidad, ciclo, evidencias, porcentajeEvidencias, suma, porcentajeFinal, bloquear) values (NULL, '".$ids[$i]."', '".$_SESSION['artes']."', '".$_SESSION['bloque']."','".$_SESSION['ciclo']."', '".$arte[$i]."', '".$part[$i]."', '".$sumaart[$i]."', '".$fart[$i]."', '0')") or die ("Error 1: ".mysqli_error($conexion));
			}
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_talleres.php';</script>";
		}
		else{
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_calificaciones_talleres.php';</script>";
		}
	}
?>
