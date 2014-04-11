<?php
	session_start();
	if (isset($_SESSION["correo"]))
	{
		echo("Ya existe una session iniciada");
	}
	else
	{
		header("Location: login.php");
	}
?>