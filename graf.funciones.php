<?php
function muestraresultados($reactivo,$id)
{
    require ("config/var.php");
    $SQL = "SELECT * FROM archivos WHERE ((id = ".$id.") AND ";
    $SQL = $SQL."(orden_pre = '".$reactivo."'))";
    
    //Coneccion a mysql
    $conec = mysql_connect($config["servidor_MySQL"], $config["usuario_MySQL"], $config["pssw_MySQL"]);
    if (!$conec)
    {
       die('No se conecto: ' .mysql_error());
    }
    //Conectar con la base de datos
    mysql_select_db ($config["baseDatos"],$conec);
    
    $consulta = mysql_query($SQL,$conec); //Ejecuta la consulta
    $numeroError = mysql_errno();
    $tipoError = mysql_error();
    if ($numeroError <> 0)
    {
        $respuesta='Error: - NumErr: '. $numeroError .' - TipoErr: '. $tipoError."--SQL: " .$SQL;
    }
    else
    {
        $registro = mysql_fetch_array($consulta, MYSQL_ASSOC);  
        //$respuesta="med=".$registro["media_dif"];
        $respuesta = "";
        $respuesta = $respuesta.'<table border="1" cellpadding="1" cellspacing="1" style="height: 123px; width: 182px" class="hovertable" >';
        $respuesta = $respuesta.'<tbody>';
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>Reactivo</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$reactivo.'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>MLogit</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$registro["mlogit"].'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'<tbody>';
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>StdErr</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$registro["stderr"].'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'<tbody>';
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>INFIT</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$registro["infit"].'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'<tbody>';
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>OUTFIT</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$registro["outfit"].'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'<tbody>';
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>Pbiserial</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$registro["pbiserial"].'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'<tbody>';
        $respuesta = $respuesta.'<tr onmouseover="this.style.backgroundColor=\'#ffff66\';" onmouseout="this.style.backgroundColor=\'#EFE7CE\';">';
        $respuesta = $respuesta.'<td width="100"><strong>Discrim</strong></td>';
        $respuesta = $respuesta.'<td align="center"><?php echo($valtemp[0]); ?>'.$registro["discrim"].'</td>';
        $respuesta = $respuesta.'</tr>';
        
        $respuesta = $respuesta.'</tbody>';
        $respuesta = $respuesta.'</table>';
    }
    
    //$respuesta = "El reactivo es: ".$reactivo. " el id es = ".$id;
    $objResponse = new xajaxResponse();
    $objResponse->assign("resultados", "innerHTML", $respuesta);
    return $objResponse;
}
require("graf.common.php");
$xajax->processRequest();
?>
