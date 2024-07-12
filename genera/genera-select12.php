<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT habilidades.id, habilidades.habilidades FROM ingles, ingleshabilidades, habilidades WHERE (ingles.id = ".$_GET['id'].") and (ingles.id = ingleshabilidades.ingles) and (ingleshabilidades.habilidades = habilidades.id)";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['habilidades'].'</option>';
	};
?>