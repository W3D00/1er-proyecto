<?php	/*$host_name = "184-75-247-53.cprapid.com"; 	$database = "cesesece_servicioescolar"; 	$user_name = "cesesece_primaria"; 	$password = "RwZ8!n2Hc;#\q1W)";*/	//IONOS	/*$host_name = "db653424018.db.1and1.com"; 	$database = "db653424018"; 	$user_name = "dbo653424018"; 	$password = "rootces21*";*/	//LOCAL	$host_name = "localhost"; 	$database = "admisiones"; 	$user_name = "root"; 	$password = "";	/*$conexion = mysql_connect($host_name,$user_name,$password);	if (!$conexion) {		die("Fallo la conexi�n a la Base de Datos: " . mysql_error());	}	$seleccionar_bd = mysql_select_db($database, $conexion);	if (!$seleccionar_bd) {		die("Fallo la selecci�n de la Base de Datos: " .mysql_error());	}*/		$con = mysqli_connect($host_name, $user_name, $password, $database);        if(mysqli_connect_errno()){		echo '<p>Fallo la conexi�n a la Base de Datos: '.mysqli_connect_error().'</p>';    }	/*else{		echo "Conecto a la base de datos";	}*/?>