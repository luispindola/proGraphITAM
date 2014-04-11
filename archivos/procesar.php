<?php
    require_once 'Excel/Excel/reader.php';

    $data = new Spreadsheet_Excel_Reader();

    $data->setOutputEncoding('CP1251');

    $data->read('temp.xls');

    error_reporting(E_ALL ^ E_NOTICE);

    echo $data->sheets[0]['cells'][1][1];
    echo ("</br>");
    
    //Conectar con la base de datos
    $conec = Conector();
    mysql_select_db ($config["baseDatos"],$conec);
    
    //primero buscar que el archivo no exista
    $SQL = "SELECT * FROM archivos WHERE nombre = '".$data->sheets[0]['cells'][1][1]."'";
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
        //Se ejecuta la consulta sin errores
        if ($registro = mysql_fetch_array($consulta, MYSQL_ASSOC))
        {
            //Se encontró registro
            echo('<span style="color: #ff0000"><strong>El archivo ya fue exportado anteriormente</strong></span></br>');
        }
        else
        {
            //No se encontró registro... Se procede a agregarlo a la tabla
            $renglonExcel=3;
            
            //Saca un id para grabar los datos
            $SQL = "SELECT MAX(id) AS max_id FROM archivos";
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
                if ($registro = mysql_fetch_array($consulta, MYSQL_ASSOC))
                {
                    //Se encontró registro
                    $id=$registro["max_id"] + 1;
                }
                else 
                { 
                    $id=1;
                }
            }
            
            while ($data->sheets[0]['cells'][$renglonExcel][1]<>"")
            {
                //Mientras exista dato en la primera celda del renglon
                //echo($data->sheets[0]['cells'][$renglonExcel][1]);
                //echo("</br>");

                //Crea consulta para insertar registros
                $SQL = "INSERT INTO archivos (id, nombre, correo, item, orden_pre, ";
                $SQL = $SQL."mlogit, stderr, infit, outfit, pbiserial, discrim, fecha) VALUES ";
                $SQL = $SQL."(";
                $SQL = $SQL.$id.", ";
                $SQL = $SQL."'".$data->sheets[0]['cells'][1][1]."', ";
                $SQL = $SQL."'".$_SESSION['correo']."', ";
                $SQL = $SQL."'".$data->sheets[0]['cells'][$renglonExcel][8]."', ";
                $SQL = $SQL."'".$data->sheets[0]['cells'][$renglonExcel][1]."', ";
                $SQL = $SQL.$data->sheets[0]['cells'][$renglonExcel][2].", ";
                $SQL = $SQL.$data->sheets[0]['cells'][$renglonExcel][3].", ";
                $SQL = $SQL.$data->sheets[0]['cells'][$renglonExcel][4].", ";
                $SQL = $SQL.$data->sheets[0]['cells'][$renglonExcel][5].", ";
                $SQL = $SQL.$data->sheets[0]['cells'][$renglonExcel][6].", ";
                $SQL = $SQL.$data->sheets[0]['cells'][$renglonExcel][7].", ";
                //fecha para SQL en formato 2013-10-07 14:12:53
                $SQL = $SQL."'".date("Y-m-d H:i:s")."'";
                $SQL = $SQL.")";
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
                    //echo('Se ejecuto la consulta: '.$SQL);
                    //echo("</br>");
                }
                $renglonExcel++;
            }
            echo('<span style="color: #006400"><strong>Archivo cargado correctamente</strong></span></br>');
        }
    }
    
?>
