<?php

# PHPlot Example: Bar chart with bar color depending on value
require_once 'phplot.php';
# Callback for picking a data color.

# PHPlot will call this every time it needs a data color.
# This returns a color index which depends on the data value.
# Color 0 is for values >= 80%, 1 is for >= 60%, 2 is for < 60%.
# The data_array must have 'text-data' type.
function pickcolor($img, $data_array, $row, $col)
{
 $d = $data_array[$row][$col+1]; // col+1 skips over the row's label
 if ($d >= $_GET["r2"]) return 0;
 if ($d >= $_GET["r1"]) return 1;
 return 2;
}
# The data array has our monthly performance as a percentage.

//INICIO Datos mios
require_once("config/var.php"); //Variables y funciones Globales
//Conectar con la base de datos
$conec = Conector();
mysql_select_db ($config["baseDatos"],$conec);


    $SQL = "SELECT id, nombre, orden_pre, ".$_GET["variable"]." FROM archivos WHERE id = ".$_GET["id"];
    $SQL = $SQL." ORDER BY ".$_GET["variable"]. " DESC";
    $variable = $_GET["variable"];


$consulta = mysql_query($SQL,$conec); //Ejecuta la consulta
$numeroError = mysql_errno();
$tipoError = mysql_error();
if ($numeroError <> 0)
{
    echo('Error: - NumErr: '. $numeroError .' - TipoErr: '. $tipoError .'<BR>');
    echo('SQL: '.$SQL);
}
else
{
    //echo "consulta ejecutada";
    $noReg = mysql_num_rows($consulta);   //Cuenta registros

    $labels = "[";
    $data1 = "";
    $data2 = "";
    $data3 = "";

    $max = 0;
    $min = 100000;
    for ($i=1; $i<=$noReg; $i++)
    {
        $registro = mysql_fetch_array($consulta, MYSQL_ASSOC);  
        $data[$i-1] = array($registro["orden_pre"],$registro[$variable]);
        if ($registro[$variable]>$max)
        {
            $max = $registro[$variable];
        }
        if ($registro[$variable]<$min)
        {
            $min = $registro[$variable];
        }
    }
}

//FIN Datos mios
//$data = array(
// array('Jan', .95), array('Feb', .75), array('Mar', .83),
// array('Apr', .66), array('May', .90), array('Jun', .80),
// array('Jul', .70), array('Aug', .50), array('Sep', .60),
// array('Oct', .70), array('Nov', .80), array('Dec', .45),
// array('Oct', .70), array('Nov', .80), array('Dec', .45),
//);
$plot = new PHPlot(800, 350);
$plot->SetImageBorderType('plain'); // Improves presentation in the manual
$plot->SetPlotType('bars');
$plot->SetDataValues($data);
$plot->SetDataType('text-data');
//$plot->SetTitle('Monthly Performance Rating');
# Turn off X Tick labels which have no meaning here.
$plot->SetXTickPos('none');
# Force the Y axis to be exactly 0:100
$plot->SetPlotAreaWorld(NULL, $min, NULL, $max);
# Establish the function 'pickcolor' as a data color selection callback.
# Set the $data array as the pass-through argument, so the function has
# access to the data values without relying on global variables.
$plot->SetCallback('data_color', 'pickcolor', $data);
# The three colors are meaningful to the data color callback.#9FF781
$plot->SetDataColors(array('#F78181', '#F2F5A9', '#9FF781'));
# The legend will explain the use of the 3 colors.
//$plot->SetLegend(array('Exceeded expectations', 'Met expectations',
// 'Failed to meet expectations'));
//$plot->SetFileFormat("jpg");
//$plot->SetOutputFile("graph.jpg");
//$plot->PrintImage();


$plot->DrawGraph();
?>
