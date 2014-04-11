<?php
	session_start();
	if (isset($_SESSION["correo"]))
	{
		header("Location: archivos/cargardat.php");
	}
	else
	{
		header("Location: accesos/index.php");
	}
        //sdfsdf
?>