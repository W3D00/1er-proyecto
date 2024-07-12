<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	if($_GET['id'] > 18){
		$consulta = "SELECT educacionfisica.id, educacionfisica.deporte FROM grado, gradoeducacionfisica, educacionfisica WHERE (grado.id = ".$_GET['id'].") and (grado.id = gradoeducacionfisica.grado) and (gradoeducacionfisica.educacionFisica = educacionfisica.id) and (educacionfisica.deporte <> 'EDUCACIÓN FÍSICA')";
	}else
		$consulta = "SELECT educacionfisica.id, educacionfisica.deporte FROM grado, gradoeducacionfisica, educacionfisica WHERE (grado.id = ".$_GET['id'].") and (grado.id = gradoeducacionfisica.grado) and (gradoeducacionfisica.educacionFisica = educacionfisica.id)";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['deporte'].'</option>';
	};
?>