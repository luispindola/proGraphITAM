<?php
$config = array (
	"nombre_sitio" => "Sistema de Análisis de Reactivos",
	"servidor_MySQL" => "localhost",
	"usuario_MySQL" => "spin100_proy1",
	"pssw_MySQL" => "Proyproy1",
	"baseDatos" => "spin100_proy2"
);
//Datos de servidor Spin100.com
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