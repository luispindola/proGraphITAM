<?php
    session_start();
    require_once("../config/var.php"); //Variables y funciones Globales

    if (isset($_SESSION["correo"])== false) //Si no exixste session se sale
    {
        header("Location: ../index.php");
    }
    
    if (isset($_POST["ok"]))
    {
        //echo("se preciono el boton enviar");
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="iso-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Instituto Tecnológico Autónomo de México</title>
		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<!-- Add custom CSS here -->
		<link href="../css/logo-nav.css" rel="stylesheet">
                
                <!-- inicio Para la tabla-->
                <style type="text/css">
 
                    table.hovertable {
                   font-family: verdana,arial,sans-serif;
                   font-size:11px;
                   color:#333333;
                   border-width: 1px;
                   border-color: #999999;
                   border-collapse: collapse;
                   }
                   table.hovertable th {
                   background-color:#9CC1A5;
                   border-width: 1px;
                   padding: 8px;
                   border-style: solid;
                   border-color: #EFE7CE;
                   }
                   table.hovertable tr {
                   background-color:#EFE7CE;
                   }
                   table.hovertable td {
                   border-width: 1px;
                   padding: 8px;
                   border-style: solid;
                   border-color: #EFE7CE;
                   }

                  </style>

                  <script type="text/javascript">
                  onload = function() 
                  {//Para obtener el renglon seleccionado
                      if (!document.getElementsByTagName || !document.createTextNode) return;
                      var rows = document.getElementById('my_table').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                      for (i = 0; i < rows.length; i++) {
                          rows[i].onclick = function() {
                              //alert(this.rowIndex + 1);
                          }
                      }
                  }
                  </script>
		<!-- fin Para la tabla-->
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		  <div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
				<a class="navbar-brand logo-nav" href="../index.php"><img src="/images/logoITAM.jpg"></a>
                                <table>
                                    <tr><td><span style="font-size: 8px">&nbsp;</span></td></tr>
                                    <tr><td align="center"><span style="color: #f0f8ff"><span style="font-size: 20px"><strong>Departamento Académico de </strong></span></span></td></tr>
                                    <tr><td align="center"><span style="color: #f0f8ff"><span style="font-size: 20px"><strong>LENGUAS</strong></span></span></td></tr>
                                </table>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../index.php">Inicio</a></li>
					<li><a href="cargardat.php">Archivos</a></li>
					<li><a href="../cerrarSession.php">Cerrar sesión</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container -->
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1></h1>
					<p></p>
                                        <!-- enctype="multipart/form-data" Para formularios que suben archivos-->
                                        <form method="post" name="cargadat" id="cargadat" enctype="multipart/form-data">
                                        <p align="center">
					<table border="1" cellpadding="1" cellspacing="1" style="height: 51px; width: 943px">
                                                <tbody>
                                                        <tr>
                                                                <td>
                                                                    <?php
                                                                        if (isset($_POST["ok"]))
                                                                        {
                                                                            //echo("type: ".$_FILES["archivo"]["type"]);
                                                                            //echo("</br>");
                                                                            //echo("name: ".$_FILES["archivo"]["name"]);
                                                                            //echo("</br>");
                                                                            //echo("size: ".$_FILES["archivo"]["size"]);
                                                                            //echo("</br>");
                                                                            move_uploaded_file($_FILES["archivo"]["tmp_name"], "temp.xls");
                                                                            //header("Location: procesar.php");
                                                                            include("procesar.php");
                                                                        }
                                                                    ?>
                                                                    <!--<INPUT type=hidden name=MAX_FILE_SIZE  VALUE=2048>-->
                                                                    </BR>
                                                                    <INPUT type=file name="archivo" id="archivo"></br>
                                                                    <INPUT type=submit value="Cargar Archivo" name="ok" id="ok">
                                                                    &nbsp;
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <table class="hovertable" id="my_table">
                                                                <tr>
                                                                    <th width="20">ID</th>
                                                                    <th width="500">Nombre</th>
                                                                    <th width="170" align="center">Fecha de importación</th>
                                                                    <th width="90" align="center">Número de Items</th>
                                                                    <th width="150" align="center">Acciones</th>
                                                                </tr>
                                                                <?php
                                                                $conec = Conector();
                                                                mysql_select_db ($config["baseDatos"],$conec);

                                                                //primero buscar que el archivo no exista
                                                                $SQL = "SELECT id, nombre, fecha, COUNT(item) AS items FROM archivos GROUP BY id, nombre, fecha";
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
                                                                    while($registro = mysql_fetch_array($consulta, MYSQL_ASSOC))
                                                                    {
                                                                        ?>
                                                                        <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                            <td><?php echo($registro["id"]); ?></td>
                                                                            <td><?php echo($registro["nombre"]); ?></td>
                                                                            <td><?php echo($registro["fecha"]); ?></td>
                                                                            <td align="center"><?php echo($registro["items"]); ?></td>
                                                                            <td>
                                                                                <input type="button" value="Graficar" onClick="window.location = '../graf.php?id=<?php echo($registro["id"]);?>';">
                                                                                <input type="button" value="Eliminar" onClick="window.location = 'eliminar.php?id=<?php echo($registro["id"]);?>';">
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </table>
                                                        </tr>
                                                </tbody>
                                        </table>
                                        </p>
                                        </form>
					
				</div>
			</div>
		</div><!-- /.container -->
		<!-- Bootstrap core JavaScript -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!-- Make sure to add jQuery - download the most recent version at http://jquery.com/ -->
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</body>
</html>