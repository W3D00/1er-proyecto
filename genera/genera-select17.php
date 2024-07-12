<?php
	header('Content-Type: text/xml; charset=ISO-8859-1');
	include "../conexion/conexion.php";
	$consulta = "SELECT DISTINCT club.id, club.club FROM club INNER JOIN gradoclub ON gradoclub.club = club.id INNER JOIN grado ON gradoclub.grado = grado.id WHERE grado.id = '".$_GET['id']."' LIMIT 0, 1";
	$query = mysqli_query($conexion,$consulta);
	mysqli_close($conexion);
	echo "<option value='0'>Seleccione una opci&oacute;n.</option>";
	while ($fila = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
		echo '<option value="'.$fila['id'].'"> '.$fila['club'].'</option>';
	};
?>