<?php
session_start();
require_once("../config/var.php"); //Variables y funciones Globales  00574A

if (isset($_SESSION["correo"])) //Si ya existe la session
{
	header("Location: ../index.php");
}

if (isset($_POST["boton"])) //Submint
{
	//Conectar con la Base de Datos y Seleccionar Base de Datos
	$conec = Conector();
	mysql_select_db ($config["baseDatos"],$conec);
	
	$SQL = "SELECT * FROM usuarios WHERE correo = '".$_POST["email"]."'";
	//echo($SQL);
	
	$consulta = mysql_query($SQL,$conec); //Crea la consulta
	$numeroError = mysql_errno();
	$tipoError = mysql_error();
	if ($numeroError <> 0)
	{
		echo('Error: - NumErr: '. $numeroError .' - TipoErr: '. $tipoError .'<BR>');
		echo('SQL: '.$SQL);
	}
	
	if ($registro = mysql_fetch_array($consulta, MYSQL_ASSOC))
	{
		//Se encontró el correo
		if ($registro["contrasena"] == base64_encode($_POST["password"]))
		{
			//Coincidio la contraseña
			$_SESSION['nombre'] = $registro['nombre'];
			$_SESSION['correo'] = $registro['correo'];
			$_SESSION['fecha'] = $registro['fecha'];
			header("Location: ../index.php");
		}
		else
		{
			echo ("<p align=center><h3>La contraseña ingresada no coincide</h3></p>");
		}
	}
	else
	{
		echo ("<p align=center><h3>El Correo électrónico ingresado no se encuentra registrado en el sistema</h3></p>");
	}
}

?>
<html lang="en-US">
<head>

	<meta charset="iso-8859-1">

	<title><?php echo($config["nombre_sitio"]); ?></title>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link href="css/external.css" rel="stylesheet">
</head>

<body>
	</br>
        <h1 align="center">Instituto Tecnológico Autónomo de México</h1>
        <h1 align="center">Departamento Académico de LENGUAS</h1>
	<h2 align="center"><?php echo($config["nombre_sitio"]); ?></h1>
        
    <div id="login-form">
        
        <h3>Datos de Acceso</h3>

        <fieldset>

            <form method="post">

                <input type="email" name="email" id="email" required value="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' "> <!-- JS because of IE support; better: placeholder="Email" -->

                <input type="password" name="password" id="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "> <!-- JS because of IE support; better: placeholder="Password" -->

                <input type="submit" name="boton" id="boton" value="Ingresar">

                <footer class="clearfix">

                    <p><span class="info">?</span><a href="#">Forgot Password</a></p>

                </footer>

            </form>

        </fieldset>

    </div> <!-- end login-form -->
    <div class="grid_16"><p align="center">
            </br></br></br>
					© Octubre 2013 Programado por:</br>
					webmaster: <a href="mailto:luispindola78@gmail.com">Ing. Luis Alejandro Spíndola R.</a>
				</div></p>
</body>
</html>