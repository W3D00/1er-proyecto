<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT clave, nombreMateria FROM grado, materiagrado, materia WHERE (grado.id = ".$_GET['id'].") and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave)";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>"; 
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['clave'].'"> '.$fila['nombreMateria'].'</option>';
	};
?>