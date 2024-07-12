<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT periodo.id, DATE_FORMAT(periodo.fecha_inicio,'%d/%m/%Y') as fechainicio, DATE_FORMAT(periodo.fecha_fin,'%d/%m/%Y') as fechafin FROM nivel, nivelperiodo, periodo WHERE (nivel.id = ".$_GET['id'].") and (nivel.id = nivelperiodo.nivel) and (nivelperiodo.periodo = periodo.id)";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione un periodo (dd/mm/aaaa).</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> PERIODO '.$fila['fechainicio'].' - '.$fila['fechafin'].'</option>';
	};
?>