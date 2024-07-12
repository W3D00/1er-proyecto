<?php
	/*session_start();
	
	//Eliminamos un par clave/valor
	/*$_SESSION['userid'] = NULL;
	$_SESSION['clave'] = NULL;
	$_SESSION['username'] = NULL;
	$_SESSION['puesto'] = NULL;
	$_SESSION['area'] = NULL;
	$_SESSION['curp'] = NULL;
	$_SESSION['materia'] = NULL;
	$_SESSION['grado'] = NULL;*
	
	unset($_SESSION["userid"]); 
	unset($_SESSION["clave"]);
	unset($_SESSION["username"]); 
	unset($_SESSION["puesto"]);
	unset($_SESSION["area"]); 
	unset($_SESSION["curp"]);
	unset($_SESSION["materia"]); 
	unset($_SESSION["grado"]);
	
	//Eliminamos todas las variables de sesión
	$_SESSION = array();
	
	//Destruimos la sesion
    session_destroy();
    
	//Redireccionamos
	header('location: ../index.php');*/
	session_start();
	session_destroy();
	session_unset();
	echo "<script> window.location='../index.php?login=false'; </script>";
?>