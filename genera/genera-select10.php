<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT taller.id, taller.taller FROM grado, gradotaller, taller WHERE (grado.id = ".$_GET['id'].") and (grado.id = gradotaller.grado) and (gradotaller.taller = taller.id) and (taller.taller != 'EDUCACIÓN ARTÍSTICA')";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['taller'].'</option>';
	};
?>