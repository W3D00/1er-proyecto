<?php
	// seteando las cabeceras
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	
	//error_reporting(0);
	session_start();
	include "../../conexion/conexion.php";
	
	$boton=$_POST['Capturar'];
	//ECHO $boton;
	IF($boton == 'Actualizar'){
		//ECHO "ESTOY EN ACTUALIZAR";
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		//INGLES LENGUAJES
		if(isset($_POST['mat1'])){
			$idMat[1] =  $_POST["mat1"];
		}
		if(isset($_POST['cing1'])){
			$calificacion[1] =  $_POST["cing1"];
		}
		else{
			$calificacion[1] = 0;
		}
		if(isset($_POST['pcing1'])){
			$porcentajeCalificacion[1] =  $_POST["pcing1"];
		}
		else{
			$porcentajeCalificacion[1] = 0;
		}
		if(isset($_POST['king1'])){
			$knotion[1] =  $_POST["king1"];
		}
		else{
			$knotion[1] = 0;
		}
		if(isset($_POST['pking1'])){
			$porcentajeKnotion[1] =  $_POST["pking1"];
		}
		else{
			$porcentajeKnotion[1] = 0;
		}
		if(isset($_POST['suma1'])){
			$suma[1] =  $_POST["suma1"];
		}
		else{
			$suma[1] = 0;
		}
		if(isset($_POST['f1'])){
			$final[1] =  $_POST["f1"];
		}
		else{
			$final[1] = 0;
		}
		//INGLES SABERES
		if(isset($_POST['mat2'])){
			$idMat[2] =  $_POST["mat2"];
		}
		if(isset($_POST['cing2'])){
			$calificacion[2] =  $_POST["cing2"];
		}
		else{
			$calificacion[2] = 0;
		}
		if(isset($_POST['pcing2'])){
			$porcentajeCalificacion[2] =  $_POST["pcing2"];
		}
		else{
			$porcentajeCalificacion[2] = 0;
		}
		if(isset($_POST['king2'])){
			$knotion[2] =  $_POST["king2"];
		}
		else{
			$knotion[2] = 0;
		}
		if(isset($_POST['pking2'])){
			$porcentajeKnotion[2] =  $_POST["pking2"];
		}
		else{
			$porcentajeKnotion[2] = 0;
		}
		if(isset($_POST['suma2'])){
			$suma[2] =  $_POST["suma2"];
		}
		else{
			$suma[2] = 0;
		}
		if(isset($_POST['f2'])){
			$final[2] =  $_POST["f2"];
		}
		else{
			$final[2] = 0;
		}
		//INGLES ENS
		if(isset($_POST['mat3'])){
			$idMat[3] =  $_POST["mat3"];
		}
		if(isset($_POST['cing3'])){
			$calificacion[3] =  $_POST["cing3"];
		}
		else{
			$calificacion[3] = 0;
		}
		if(isset($_POST['pcing3'])){
			$porcentajeCalificacion[3] =  $_POST["pcing3"];
		}
		else{
			$porcentajeCalificacion[3] = 0;
		}
		if(isset($_POST['king3'])){
			$knotion[3] =  $_POST["king3"];
		}
		else{
			$knotion[3] = 0;
		}
		if(isset($_POST['pking3'])){
			$porcentajeKnotion[3] =  $_POST["pking3"];
		}
		else{
			$porcentajeKnotion[3] = 0;
		}
		if(isset($_POST['suma3'])){
			$suma[3] =  $_POST["suma3"];
		}
		else{
			$suma[3] = 0;
		}
		if(isset($_POST['f3'])){
			$final[3] =  $_POST["f3"];
		}
		else{
			$final[3] = 0;
		}
		//INGLES DLHALC
		if(isset($_POST['mat4'])){
			$idMat[4] =  $_POST["mat4"];
		}
		if(isset($_POST['cing4'])){
			$calificacion[4] =  $_POST["cing4"];
		}
		else{
			$calificacion[4] = 0;
		}
		if(isset($_POST['pcing4'])){
			$porcentajeCalificacion[4] =  $_POST["pcing4"];
		}
		else{
			$porcentajeCalificacion[4] = 0;
		}
		if(isset($_POST['suma4'])){
			$suma[4] =  $_POST["suma4"];
		}
		else{
			$suma[4] = 0;
		}
		if(isset($_POST['f4'])){
			$final[4] =  $_POST["f4"];
		}
		else{
			$final[4] = 0;
		}
		
		for($i=1;$i<=4;$i++){
			for($j = 1; $j < $no_filas; $j++) {
				if (empty($calificacion[$i][$j])) {$calificacion[$i][$j]=0;}
				if (empty($porcentajeCalificacion[$i][$j])) {$porcentajeCalificacion[$i][$j]=0;}
				if (empty($knotion[$i][$j])) {$knotion[$i][$j]=0;}
				if (empty($porcentajeKnotion[$i][$j])) {$porcentajeKnotion[$i][$j]=0;}
				if (empty($suma[$i][$j])) {$suma[$i][$j]=0;}
				if (empty($final[$i][$j])) {$final[$i][$j]=0;}
			}
		}
		
		for($i=1;$i<=4;$i++){
			for($j = 1; $j < $no_filas; $j++) {
				if($i<=3)
					$sql = mysqli_query($conexion,"UPDATE `calificacioningles` SET `evidencias` = '".$calificacion[$i][$j]."', `porcentajeEvidencias` = '".$porcentajeCalificacion[$i][$j]."', `knotion` = '".$knotion[$i][$j]."', `porcentajeKnotion` = '".$porcentajeKnotion[$i][$j]."', `suma` = '".$suma[$i][$j]."', `porcentajeFinal` = '".$final[$i][$j]."' WHERE `calificacioningles`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
				else
					$sql = mysqli_query($conexion,"UPDATE `calificacioningles` SET `evidencias` = '".$calificacion[$i][$j]."', `porcentajeEvidencias` = '".$porcentajeCalificacion[$i][$j]."', `suma` = '".$suma[$i][$j]."', `porcentajeFinal` = '".$final[$i][$j]."' WHERE `calificacioningles`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
			}
		}
	}
	
	IF($boton == 'Capturar'){
		//ECHO "eNTRO A GUARDAR";
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		//INGLES LENGUAJES
		if(isset($_POST['cing1'])){
			$calificacion[1] =  $_POST["cing1"];
		}
		else{
			$calificacion[1] = 0;
		}
		if(isset($_POST['pcing1'])){
			$porcentajeCalificacion[1] =  $_POST["pcing1"];
		}
		else{
			$porcentajeCalificacion[1] = 0;
		}
		if(isset($_POST['king1'])){
			$knotion[1] =  $_POST["king1"];
		}
		else{
			$knotion[1] = 0;
		}
		if(isset($_POST['pking1'])){
			$porcentajeKnotion[1] =  $_POST["pking1"];
		}
		else{
			$porcentajeKnotion[1] = 0;
		}
		if(isset($_POST['suma1'])){
			$suma[1] =  $_POST["suma1"];
		}
		else{
			$suma[1] = 0;
		}
		if(isset($_POST['f1'])){
			$final[1] =  $_POST["f1"];
		}
		else{
			$final[1] = 0;
		}
		//INGLES SABERES
		if(isset($_POST['cing2'])){
			$calificacion[2] =  $_POST["cing2"];
		}
		else{
			$calificacion[2] = 0;
		}
		if(isset($_POST['pcing2'])){
			$porcentajeCalificacion[2] =  $_POST["pcing2"];
		}
		else{
			$porcentajeCalificacion[2] = 0;
		}
		if(isset($_POST['king2'])){
			$knotion[2] =  $_POST["king2"];
		}
		else{
			$knotion[2] = 0;
		}
		if(isset($_POST['pking2'])){
			$porcentajeKnotion[2] =  $_POST["pking2"];
		}
		else{
			$porcentajeKnotion[2] = 0;
		}
		if(isset($_POST['suma2'])){
			$suma[2] =  $_POST["suma2"];
		}
		else{
			$suma[2] = 0;
		}
		if(isset($_POST['f2'])){
			$final[2] =  $_POST["f2"];
		}
		else{
			$final[2] = 0;
		}
		//INGLES ENS
		if(isset($_POST['cing3'])){
			$calificacion[3] =  $_POST["cing3"];
		}
		else{
			$calificacion[3] = 0;
		}
		if(isset($_POST['pcing3'])){
			$porcentajeCalificacion[3] =  $_POST["pcing3"];
		}
		else{
			$porcentajeCalificacion[3] = 0;
		}
		if(isset($_POST['king3'])){
			$knotion[3] =  $_POST["king3"];
		}
		else{
			$knotion[3] = 0;
		}
		if(isset($_POST['pking3'])){
			$porcentajeKnotion[3] =  $_POST["pking3"];
		}
		else{
			$porcentajeKnotion[3] = 0;
		}
		if(isset($_POST['suma3'])){
			$suma[3] =  $_POST["suma3"];
		}
		else{
			$suma[3] = 0;
		}
		if(isset($_POST['f3'])){
			$final[3] =  $_POST["f3"];
		}
		else{
			$final[3] = 0;
		}
		//INGLES DLHALC
		if(isset($_POST['cing4'])){
			$calificacion[4] =  $_POST["cing4"];
		}
		else{
			$calificacion[4] = 0;
		}
		if(isset($_POST['pcing4'])){
			$porcentajeCalificacion[4] =  $_POST["pcing4"];
		}
		else{
			$porcentajeCalificacion[4] = 0;
		}
		if(isset($_POST['suma4'])){
			$suma[4] =  $_POST["suma4"];
		}
		else{
			$suma[4] = 0;
		}
		if(isset($_POST['f4'])){
			$final[4] =  $_POST["f4"];
		}
		else{
			$final[4] = 0;
		}
		
		for($i=1;$i<=4;$i++){
			for($j = 1; $j < $no_filas; $j++) {
				if (empty($calificacion[$i][$j])) {$calificacion[$i][$j]=0;}
				if (empty($porcentajeCalificacion[$i][$j])) {$porcentajeCalificacion[$i][$j]=0;}
				if (empty($knotion[$i][$j])) {$knotion[$i][$j]=0;}
				if (empty($porcentajeKnotion[$i][$j])) {$porcentajeKnotion[$i][$j]=0;}
				if (empty($suma[$i][$j])) {$suma[$i][$j]=0;}
				if (empty($final[$i][$j])) {$final[$i][$j]=0;}
			}
		}
		
		$con1= mysqli_query($conexion,"SELECT ingles.id as ingles FROM grado, gradoingles, ingles WHERE (grado.id = '".$_SESSION["grado"]."') and (grado.id = gradoingles.grado) and (gradoingles.ingles = ingles.id)") or die("Error 1 :".mysqli_error($conexion)); 
		while ($row = mysqli_fetch_array($con1,MYSQLI_NUM)){ 
			$ingles=$row[0];
		}
		
		for($i=1;$i<=4;$i++){
			for($j = 1; $j < $no_filas; $j++) {
				if($i<=3)
					$sql = mysqli_query($conexion,"INSERT INTO calificacioningles (id, alumno, materia, unidad, ciclo, campoFormativo, evidencias, porcentajeEvidencias, knotion, porcentajeKnotion, suma, porcentajeFinal, bloquear) values (NULL, '".$ids[$j]."', '".$ingles."', '".$_SESSION['bloque']."', '".$_SESSION["ciclo"]."', '".$i."', '".$calificacion[$i][$j]."', '".$porcentajeCalificacion[$i][$j]."', '".$knotion[$i][$j]."', '".$porcentajeKnotion[$i][$j]."', '".$suma[$i][$j]."', '".$final[$i][$j]."', '0')") or die ('Error: '.mysqli_error($conexion));
				else
					$sql = mysqli_query($conexion,"INSERT INTO calificacioningles (id, alumno, materia, unidad, ciclo, campoFormativo, evidencias, porcentajeEvidencias, knotion, porcentajeKnotion, suma, porcentajeFinal, bloquear) values (NULL, '".$ids[$j]."', '".$ingles."', '".$_SESSION['bloque']."', '".$_SESSION["ciclo"]."', '".$i."', '".$calificacion[$i][$j]."', '".$porcentajeCalificacion[$i][$j]."', '0', '0', '".$suma[$i][$j]."', '".$final[$i][$j]."', '0')") or die ('Error: '.mysqli_error($conexion));
			//echo $sql . "<br>";
			}
		}
	}
	if($sql == false) {
		echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_captura_calificaciones_ingles.php';</script>";
	}
	else{	
		echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_captura_calificaciones_ingles.php';</script>";
	}
?>
