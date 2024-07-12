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
		if(isset($_POST['king4'])){
			$knotion[4] =  $_POST["king4"];
		}
		else{
			$knotion[4] = 0;
		}
		if(isset($_POST['pking4'])){
			$porcentajeKnotion[4] =  $_POST["pking4"];
		}
		else{
			$porcentajeKnotion[4] = 0;
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
				$sql = mysqli_query($conexion,"UPDATE `calificacioningles` SET `evidencias` = '".$calificacion[$i][$j]."', `porcentajeEvidencias` = '".$porcentajeCalificacion[$i][$j]."', `knotion` = '".$knotion[$i][$j]."', `porcentajeKnotion` = '".$porcentajeKnotion[$i][$j]."', `suma` = '".$suma[$i][$j]."', `porcentajeFinal` = '".$final[$i][$j]."' WHERE `calificacioningles`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
			}
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudieron guardar los datos');window.location='Inicio_actualizar_calificaciones_ingles.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se guardaron los datos correctamente');window.location='Inicio_actualizar_calificaciones_ingles.php';</script>";
		}
	}
	IF($boton == 'Bloquear'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		if(isset($_POST['mat1'])){
			$idMat[1] =  $_POST["mat1"];
		}
		if(isset($_POST['mat2'])){
			$idMat[2] =  $_POST["mat2"];
		}
		if(isset($_POST['mat3'])){
			$idMat[3] =  $_POST["mat3"];
		}
		if(isset($_POST['mat4'])){
			$idMat[4] =  $_POST["mat4"];
		}
		
		for($i=1;$i<=4;$i++){
			for($j = 1; $j < $no_filas; $j++) {
				$sql = mysqli_query($conexion,"UPDATE `calificacioningles` SET `bloquear` = '1' WHERE `calificacioningles`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
			}
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudo bloquear las calificaciones');window.location='Inicio_actualizar_calificaciones_ingles.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se bloquearon las calificaciones correctamente');window.location='Inicio_actualizar_calificaciones_ingles.php';</script>";
		}
	}
	IF($boton == 'Desbloquear'){
		$no_filas = $_POST['filas'];
		$ids = $_SESSION['id'];
		
		if(isset($_POST['mat1'])){
			$idMat[1] =  $_POST["mat1"];
		}
		if(isset($_POST['mat2'])){
			$idMat[2] =  $_POST["mat2"];
		}
		if(isset($_POST['mat3'])){
			$idMat[3] =  $_POST["mat3"];
		}
		if(isset($_POST['mat4'])){
			$idMat[4] =  $_POST["mat4"];
		}
		for($i=1;$i<=4;$i++){
			for($j = 1; $j < $no_filas; $j++) {
				$sql = mysqli_query($conexion,"UPDATE `calificacioningles` SET `bloquear` = '0' WHERE `calificacioningles`.`id` = '".$idMat[$i][$j]."'") or die (mysqli_error($conexion));
			}
		}
		if($sql == false) {
			echo "<script languaje='javascript'>alert('No se pudo desbloquear las calificaciones');window.location='Inicio_actualizar_calificaciones_ingles.php';</script>";
		}
		else{	
			echo "<script languaje='javascript'>alert('Se desbloquearon las calificaciones correctamente');window.location='Inicio_actualizar_calificaciones_ingles.php';</script>";
		}
	}
?>
