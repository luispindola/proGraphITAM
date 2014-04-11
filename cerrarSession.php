<?php
	session_start();
	unset($_SESSION["nombre"]); 
	unset($_SESSION["correo"]);
	unset($_SESSION["fecha"]);
	session_destroy();
	header("Location: ../index.php");
?>