<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	
	$boton=$_POST['Capturar'];
	//ECHO $boton;
	IF($boton == 'Actualizar'){
		$no_filas = $_POST['filas'];
				
		if(isset($_POST['hexa'])){
			$idHab =  $_POST["hexa"];
		}
		
		if(isset($_POST['comentarios'])){
			$comentarios =  $_POST["comentarios"];
		}
		
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `comentarios` SET `comentario` = '".utf8_decode($comentarios[$j])."' WHERE `comentarios`.`id` = '".$idHab[$j]."'") or die (mysqli_error($conexion));
		}
	}
	IF($boton == 'Capturar'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		if(isset($_POST['comentarios'])){
			$comentarios =  $_POST["comentarios"];
		}
		for($i = 1; $i < $no_filas; $i++) {
			$sql = mysqli_query($conexion,"INSERT INTO comentarios (id, alumno, tipo, unidad, ciclo, comentario, bloqueo) values (NULL, '".$ids[$i]."', '".utf8_decode('Inglés')."', '".$_SESSION['bloque']."', '".$_SESSION["ciclo"]."', '".utf8_decode($comentarios[$i])."', '0')") or die ('Error: '.mysqli_error($conexion));
		}
	}
	
	if($sql == false) {
		echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_comentarios_ingles.php';</script>";
	}
	else{	
		echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_comentarios_ingles.php';</script>";
	}
?>
