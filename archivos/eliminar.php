<?php
    session_start();
    if (isset($_SESSION["correo"])== false) //Si no exixste session se sale
    {
        header("Location: ../index.php");
    }
    
    require_once("../config/var.php"); //Variables y funciones Globales

    //Conectar con la base de datos
    $conec = Conector();
    mysql_select_db ($config["baseDatos"],$conec);
    
    $SQL = "DELETE FROM archivos WHERE id = ".$_GET["id"];
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
        header("Location: cargardat.php");
    }

?>
