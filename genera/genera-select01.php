<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT ciclo.id, DATE_FORMAT(ciclo.fecha_inicio,'%Y') as fechainicio, DATE_FORMAT(ciclo.fecha_fin,'%Y') as fechafin FROM nivel, nivelciclo, ciclo WHERE (nivel.id = ".$_GET['id'].") and (nivel.id = nivelciclo.nivel) and (nivelciclo.ciclo = ciclo.id)";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> CICLO '.$fila['fechainicio'].'-'.$fila['fechafin'].'</option>';
	};
?>