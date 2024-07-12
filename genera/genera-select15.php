<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "select DISTINCT alumno.id, alumno.matricula, concat(alumno.paterno,' ', alumno.materno,' ',alumno.nombre) as nombre_completo from alumno,alumnogrado, grado ,alumnosituacion ,situacion, ciclo where (alumno.id = alumnogrado.alumno) and (alumnogrado.grado = grado.id) and (grado.id = '".$_GET["id"]."') AND (alumno.id = alumnosituacion.alumno) AND (alumnosituacion.situacion = situacion.id) AND (situacion.situacion <> 'BAJA') AND (alumnogrado.activo ='1') AND (alumnogrado.ciclo ='3') AND (alumnosituacion.ciclo = ciclo.id) and (DATE_FORMAT(NOW(),'%Y-%m-%d') BETWEEN ciclo.fecha_inicio and ciclo.fecha_fin) ORDER BY nombre_completo ASC";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['nombre_completo'].'</option>';
	};
?>