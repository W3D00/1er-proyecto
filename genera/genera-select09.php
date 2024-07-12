<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT artes.id, artes.nombre FROM taller, tallerartes, artes WHERE (taller.id = ".$_GET['id'].") and (taller.id = tallerartes.taller) and (tallerartes.artes = artes.id)";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['nombre'].'</option>';
	};
?>