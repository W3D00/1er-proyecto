<?php	
	//error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	
	//Guardar los terminos a evaluar
	$boton=$_POST['Capturar'];
	$cuadro =  array();
	$matricula =  array();
	$paterno =  array();
	$materno =  array();
	$nombre =  array();
	$situacion =  array();
	$grado =  array();
	$arte =  array();
	$deporte =  array();
	IF($boton == 'Capturar'){
		
		if(isset($_POST['cuadro'])){
			$cuadro =  $_POST["cuadro"];
		}
		if(isset($_POST['matricula'])){
			$matricula =  $_POST["matricula"];
		}
		if(isset($_POST['paterno'])){
			$paterno =  $_POST["paterno"];
		}
		if(isset($_POST['materno'])){
			$materno =  $_POST["materno"];
		}
		if(isset($_POST['nombre'])){
			$nombre =  $_POST["nombre"];
		}
		if(isset($_POST['curp'])){
			$curp =  $_POST["curp"];
		}
		if(isset($_POST['situacion'])){
			$situacion =  $_POST["situacion"];
		}
		if(isset($_POST['grado'])){
			$grado =  $_POST["grado"];
		}
		if(isset($_POST['arte'])){
			$arte =  $_POST["arte"];
		}
		if(isset($_POST['deporte'])){
			$deporte =  $_POST["deporte"];
		}
		for($i=0;$i<=count($matricula);$i++){
			if($cuadro[$i]=='on'){
				//echo $cuadro[$i]."-".$i."<br>";
				//echo "INSERT INTO alumno (id, matricula, nombre, paterno, materno, curp, rfc, pertenece, otro, matricula_normal) values ('".$matricula[$i]."', '".$matricula[$i]."','".$nombre[$i]."','".$paterno[$i]."','".$materno[$i]."', '".$curp[$i]."', NULL, NULL, NULL, NULL)<br>";
				$sql = mysqli_query($conexion,"INSERT INTO alumno (id, matricula, nombre, paterno, materno, curp, rfc, pertenece, otro, matricula_normal) values ('".$matricula[$i]."', '".$matricula[$i]."','".$nombre[$i]."','".$paterno[$i]."','".$materno[$i]."', '".$curp[$i]."', NULL, NULL, NULL, NULL)") or die ('Error: '.mysqli_error($conexion));
				//echo "INSERT INTO alumnosituacion (alumno, situacion, ciclo, nivel, fecha) values ('".$matricula[$i]."', '3','".$_SESSION["ciclo"]."','3', NULL)<br>";
				$sql1 = mysqli_query($conexion,"INSERT INTO alumnosituacion (alumno, situacion, ciclo, nivel, fecha) values ('".$matricula[$i]."', '3','".$_SESSION["ciclo"]."','3', NULL)") or die ('Error: '.mysqli_error($conexion));
				//echo "INSERT INTO alumnogrado (alumno, grado, activo, ciclo) values ('".$matricula[$i]."', '".$grado[$i]."','1','".$_SESSION["ciclo"]."')<br>";
				$sql2 = mysqli_query($conexion,"INSERT INTO alumnogrado (alumno, grado, activo, ciclo) values ('".$matricula[$i]."', '".$grado[$i]."','1','".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
				if($grado[$i]<18){
					if($grado[$i]==7 || $grado[$i]==8){
						$taller='1';
						$deportes='5';
						$ingles='1';
					}
					if($grado[$i]==10 || $grado[$i]==11){
						$taller='8';
						$deportes='6';
						$ingles='2';
					}
					if($grado[$i]==13 || $grado[$i]==14){
						$taller='9';
						$deporte='7';
						$ingles='3';
					}
					if($grado[$i]==16 || $grado[$i]==17){
						$taller='10';
						$deportes='8';
						$ingles='4';
					}
					//echo "INSERT INTO alumnotaller (taller, alumno, ciclo) values ('".$taller."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')<br>";
					$sql3_1 = mysqli_query($conexion,"INSERT INTO alumnotaller (taller, alumno, ciclo) values ('".$taller."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
					//echo "INSERT INTO alumnofisica (educacionFisica, alumno, ciclo) values ('".$deportes."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')<br>";
					$sql4_1 = mysqli_query($conexion,"INSERT INTO alumnofisica (educacionFisica, alumno, ciclo) values ('".$deportes."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
					//echo "INSERT INTO alumnoingles (ingles, alumno, ciclo) values ('".$ingles."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')<br>";
					$sql5_1 = mysqli_query($conexion,"INSERT INTO alumnoingles (ingles, alumno, ciclo) values ('".$ingles."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
				}
				else{
					if($grado[$i]==19 || $grado[$i]==20){
						$ingles='5';
					}
					if($grado[$i]==21 || $grado[$i]==22){
						$ingles='6';
					}
					//echo "INSERT INTO alumnoartes (alumno, artes, activo, ciclo) values ('".$matricula[$i]."', '".$arte[$i]."', '1', '".$_SESSION["ciclo"]."')<br>";
					$sql3_2 = mysqli_query($conexion,"INSERT INTO alumnoartes (alumno, artes, activo, ciclo) values ('".$matricula[$i]."', '".$arte[$i]."', '1', '".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
					$sql4_2 = mysqli_query($conexion,"INSERT INTO alumnofisica (educacionFisica, alumno, ciclo) values ('".$deporte[$i]."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
					$sql5_2 = mysqli_query($conexion,"INSERT INTO alumnoingles (ingles, alumno, ciclo) values ('".$ingles."', '".$matricula[$i]."', '".$_SESSION["ciclo"]."')") or die ('Error: '.mysqli_error($conexion));
				}
			}
		}
	}
	if($sql5_1 == false || $sql5_2 == false) {
		echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_registro_alumno.php';</script>";
	}
	else{
		echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_registro_alumno.php';</script>";
	}
	
?>