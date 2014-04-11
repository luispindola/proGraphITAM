<?php
$config = array (
	"nombre_sitio" => "Sistema de Análisis de Reactivos",
	"servidor_MySQL" => "localhost",
	"usuario_MySQL" => "root",
	"pssw_MySQL" => "usbw",
	"baseDatos" => "proy1"
);

function Conector()
{
	global $config;
	//Coneccion a mysql
	$conec = mysql_connect($config["servidor_MySQL"], $config["usuario_MySQL"], $config["pssw_MySQL"]);
	if (!$conec)
	{
	   die('No se conecto: ' .mysql_error());
	}
	return $conec;
}

?>