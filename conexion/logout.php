<?php
	session_start();
	session_destroy();
	session_unset();
	echo "<script> window.location='../index.php?login=false'; </script>";
?>
