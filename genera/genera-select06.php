<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT unidad.id,unidad.unidad FROM grado, gradounidad, unidad WHERE (grado.id = ".$_GET['id'].") and (grado.id = gradounidad.grado) and (gradounidad.unidad = unidad.id) LIMIT 0, 3";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['unidad'].'</option>';
	};
?>