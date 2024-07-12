<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT grado.id, concat(grado.grado,'', grupo.descripcion) as gg FROM nivel, nivelgrado, grado, grupo WHERE (nivel.id = ".$_GET['id'].") and (nivel.id = nivelgrado.nivel) and (nivelgrado.grado = grado.id) and (grado.grupo = grupo.id) and (grupo.descripcion <> 'U') order by gg ASC";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['gg'].'</option>';
	};
?>