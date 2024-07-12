<?php	
	//error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	
	//Guardar los terminos a evaluar
	$boton=$_POST['Capturar'];
	IF($boton == 'Actualizar'){
		//Guardar calificacion del alumno
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
	
		if(isset($_POST['idp'])){
			$idp =  $_POST["idp"];
		}
		if(isset($_POST['fechai'])){
			$fechai =  $_POST["fechai"];
		}
		if(isset($_POST['fechaf'])){
			$fechaf =  $_POST["fechaf"];
		}
			
		for($j = 1; $j < $no_filas; $j++) {
			$sql = mysqli_query($conexion,"UPDATE `periodocalificacion` SET `fecha_inicio` = '".$fechai[$j]."', `fecha_fin` = '".$fechaf[$j]."' WHERE `periodocalificacion`.`id` = '".$idp[$j]."'") or die (mysqli_error($conexion));
		}
		
	}
	IF($boton == 'Capturar'){
		
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
	
		if(isset($_POST['fechai'])){
			$fechai =  $_POST["fechai"];
		}
		if(isset($_POST['fechaf'])){
			$fechaf =  $_POST["fechaf"];
		}
		$i=1;	
		for($j = 1; $j <= 3; $j++) {
			$sql = mysqli_query($conexion,"INSERT INTO periodocalificacion (id, fecha_inicio, fecha_fin, ciclo, nivel) values (NULL, '".$fechai[$j]."','".$fechaf[$j]."','".$_SESSION['ciclo']."','3')") or die ('Error: '.mysqli_error($conexion));
			$lastid = mysqli_insert_id($conexion);
			$sql = mysqli_query($conexion,"INSERT INTO unidadperiodo (unidad, periodoCalificacion) values ('".$i."','".$lastid."')") or die ('Error: '.mysqli_error($conexion));
			$i++;
		}
		
	}
	if($sql == false) {
		echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_periodo_calificacion.php';</script>";
	}
	else{
		echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_periodo_calificacion.php';</script>";
	}
	
?>