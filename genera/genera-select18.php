<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	if($_GET['id']=='7' || $_GET['id']=='8' || $_GET['id']=='10' || $_GET['id']=='11'){
		$consulta ="SELECT clave, materia.nombreMateria FROM grado, materiagrado, materia WHERE (grado.id = '".$_GET['id']."') and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '2'";
	}
	else{
		$consulta ="SELECT clave, materia.nombreMateria FROM grado, materiagrado, materia WHERE (grado.id = '".$_GET['id']."') and (grado.id = materiagrado.grado) and (materiagrado.materia = materia.clave) AND materiagrado.malla = '1'";
	}
	
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['clave'].'"> '.$fila['nombreMateria'].'</option>';
	};
?>