<?php
	//LOCAL
	$host_name = "localhost"; 
	$database = "admisiones"; 
	$user_name = "root"; 
	$password = "";

	$con = mysqli_connect($host_name, $user_name, $password, $database);
    
  if(mysqli_connect_errno()){
		echo '<p>Fallo la conexión a la Base de Datos: '.mysqli_connect_error().'</p>';
  }
?>
