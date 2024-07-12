<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT unidad.id,unidad.unidad FROM grado ,gradounidad ,unidad ,unidadperiodo ,periodocalificacion WHERE (grado.id = ".$_GET['id'].") AND (grado.id = gradounidad.grado) AND (gradounidad.unidad = unidad.id) AND unidad.id = unidadperiodo.unidad AND unidadperiodo.periodoCalificacion = periodocalificacion.id AND (CURDATE() >= fecha_inicio and CURDATE() <= DATE_ADD(fecha_fin, INTERVAL 7 DAY))";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['unidad'].'</option>';
	};
?>