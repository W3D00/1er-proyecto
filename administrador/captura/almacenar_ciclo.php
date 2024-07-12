<?php	
	//error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	
	//Guardar los terminos a evaluar
	$boton=$_POST['Capturar'];
	IF($boton == 'Capturar'){
		
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
	
		if(isset($_POST['fechai'])){
			$fechai =  $_POST["fechai"];
		}
		if(isset($_POST['fechaf'])){
			$fechaf =  $_POST["fechaf"];
		}
		for($j = 1; $j <= 1; $j++) {
			$sql = mysqli_query($conexion,"INSERT INTO ciclo (id, fecha_inicio, fecha_fin) values (NULL, '".$fechai[$j]."','".$fechaf[$j]."')") or die ('Error: '.mysqli_error($conexion));
		}
		
	}
	if($sql == false) {
		echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='../Inicio_admin_primaria.php';</script>";
	}
	else{
		echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='../Inicio_admin_primaria.php';</script>";
	}
	
?>