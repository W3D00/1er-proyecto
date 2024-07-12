<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	//mysqli_query($conexion,"SET NAMES 'utf8'");
	$consulta = "SELECT artes.id, artes.nombre FROM artes, gradoarte, grado WHERE grado.id = ".$_GET['id']." AND grado.id = gradoarte.grado AND gradoarte.artes = artes.id";
	$prueba = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	//echo "<option value='0'>".$consulta."</option>";
	while ($fila = mysqli_fetch_array($prueba,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['nombre'].'</option>';
	};
?>