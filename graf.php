<?php
    session_start();
    if (isset($_SESSION["correo"])== false) //Si no exixste session se sale
    {
        header("Location:index.php");
    }
    require ("graf.common.php");
    require_once("config/var.php"); //Variables y funciones Globales
    
    //Conectar con la base de datos
    $conec = Conector();
    mysql_select_db ($config["baseDatos"],$conec);
    
    if (isset($_POST["Variable"]))
    {
        $SQL = "SELECT id, nombre, orden_pre, ".$_POST["Variable"]." FROM archivos WHERE id = ".$_GET["id"];
        $SQL = $SQL." ORDER BY ".$_POST["Variable"]. " DESC";
        $variable = $_POST["Variable"];
    }
    else
    {
        $SQL = "SELECT id, nombre, orden_pre, mlogit FROM archivos WHERE id = ".$_GET["id"];
        $SQL = $SQL." ORDER BY mlogit DESC";
        $variable = "mlogit";
    }
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
       $registro = mysql_fetch_array($consulta, MYSQL_ASSOC);  
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
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Add custom CSS here -->
		<link href="css/logo-nav.css" rel="stylesheet">
		
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
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
                   border-color: #a9c6c9;
                   }
                   table.hovertable tr {
                   background-color:#EFE7CE;
                   }
                   table.hovertable td {
                   border-width: 1px;
                   padding: 8px;
                   border-style: solid;
                   border-color: #a9c6c9;
                   }
                </style>
                <?php $xajax->printJavascript(); ?>
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
                                <a class="navbar-brand logo-nav" href="index.php"><img src="/images/logoITAM.jpg"></a>
                                <table>
                                    <tr><td><span style="font-size: 8px">&nbsp;</span></td></tr>
                                    <tr><td align="center"><span style="color: #f0f8ff"><span style="font-size: 20px"><strong>Departamento Académico de </strong></span></span></td></tr>
                                    <tr><td align="center"><span style="color: #f0f8ff"><span style="font-size: 20px"><strong>LENGUAS</strong></span></span></td></tr>
                                </table>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="/index.php">Inicio</a></li>
					<li><a href="/archivos/cargardat.php">Archivos</a></li>
					<li><a href="cerrarSession.php">Cerrar sesión</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container -->
		</nav>
		<div class="container">
		  <div class="row">
			<div class="col-lg-12">
			  <h1><?php echo($registro["nombre"]); ?></h1>
			  <p> </p>
                          <form method="post" name="cargadat" id="cargadat">
				<table width="100%" border="0" cellpadding="2" cellspacing="2" style="background-color: #ffffff;">
					<tr valign="top">
						<td style="border-width : 0px;"><br />
                                                    <select name="Variable" size="1" style="width: 168px">
                                                        <option <?php
                                                        if (isset($_POST["Variable"]))
                                                        {
                                                            if ($_POST["Variable"]=="mlogit")
                                                            {echo("selected='selected'"); }
                                                        }else{echo("selected='selected'");}
                                                        ?> value="mlogit">MLogit</option>
                                                        <option <?php
                                                        if (isset($_POST["Variable"]))
                                                        {
                                                            if ($_POST["Variable"]=="stderr")
                                                            {echo("selected='selected'"); }
                                                        }
                                                        ?> value="stderr">StdErr</option>
                                                        <option <?php
                                                        if (isset($_POST["Variable"]))
                                                        {
                                                            if ($_POST["Variable"]=="infit")
                                                            {echo("selected='selected'"); }
                                                        }
                                                        ?> value="infit">INFIT</option>
                                                        <option <?php
                                                        if (isset($_POST["Variable"]))
                                                        {
                                                            if ($_POST["Variable"]=="outfit")
                                                            {echo("selected='selected'"); }
                                                        }
                                                        ?> value="outfit">OUTFIT</option>
                                                        <option <?php
                                                        if (isset($_POST["Variable"]))
                                                        {
                                                            if ($_POST["Variable"]=="pbiserial")
                                                            {echo("selected='selected'"); }
                                                        }
                                                        ?> value="pbiserial">Pbiserial</option>
                                                        <option <?php
                                                        if (isset($_POST["Variable"]))
                                                        {
                                                            if ($_POST["Variable"]=="discrim")
                                                            {echo("selected='selected'"); }
                                                        }
                                                        ?> value="discrim">Discrim</option>
                                                    </select>&nbsp;&nbsp; 
                                                    
                                                    <input name="rango1" size="4" type="text" value="<?php
                                                    if (isset($_POST["rango1"]))
                                                    {
                                                        echo($_POST["rango1"]);
                                                        $r1 = $_POST["rango1"];
                                                    }else    
                                                    {
                                                        $r1=43;  
                                                        echo($r1);    
                                                    } 
                                                    ?>" />   
                                                    <input name="rango2" size="4" type="text" value="<?php
                                                    if (isset($_POST["rango2"]))
                                                    {
                                                        echo($_POST["rango2"]);
                                                        $r2 = $_POST["rango2"];
                                                    }
                                                    else
                                                    {
                                                        $r2=58;
                                                        echo($r2);  
                                                    } 
                                                    ?>" />
                                                    
                                                    <input name="selec_var" type="submit" value="Seleccionar Variable" />
                                                    
						</td>
						<td style="border-width : 0px;">
						<br />
						</td>
					</tr>
					<tr valign="top">
						<td style="border-width : 0px;">
                                                        <IMG SRC='grafica.php?id=<?php echo($_GET["id"]); ?>&variable=<?php echo($variable); ?>&r1=<?php echo($r1); ?>&r2=<?php echo($r2); ?>'>
						</td>
						<td style="border-width : 0px;">
                                                    <p><strong>Datos por Reactivo</strong></p>
                                                    <?php
                                                        $SQL = "SELECT * FROM archivos WHERE (id = '".$_GET["id"]."') ORDER BY ".$variable." DESC";
                                                        
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
                                                            
                                                           //echo "consulta ejecutada: ".$SQL;
                                                           $cont = 0;
                                                           while($registro = mysql_fetch_array($consulta, MYSQL_ASSOC))
                                                           {
                                                               if ($cont == 0)
                                                               {
                                                                   $valtemp = array($registro["mlogit"],$registro["stderr"],$registro["infit"],$registro["outfit"],$registro["pbiserial"],$registro["discrim"]);
                                                                   
                                
                                                               }
                                                               $reactivos[$cont] = $registro["orden_pre"];
                                                               $datosSelect[$cont] = $registro["orden_pre"];
                                                               $cont++;
                   
                                                           }
                                                        }
                                                    ?>
                                                    <table border="1" cellpadding="1" cellspacing="1" style="width: 300px">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center">
                                                            <div id="resultados">
                                                                <table border="1" cellpadding="1" cellspacing="1" style="height: 123px; width: 182px" class="hovertable" >
                                                                        <tbody>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td width="100"><strong>Reactivo</strong></td>
                                                                                        <td align="center"><?php echo($datosSelect[0]); ?></td>
                                                                                </tr>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td width="100"><strong>MLogit</strong></td>
                                                                                        <td align="center"><?php echo($valtemp[0]); ?></td>
                                                                                </tr>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td><strong>StdErr</strong></td>
                                                                                        <td align="center"><?php echo($valtemp[1]); ?></td>
                                                                                </tr>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td><strong>INFIT</strong></td>
                                                                                        <td align="center"><?php echo($valtemp[2]); ?></td>
                                                                                </tr>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td><strong>OUTFIT</strong></td>
                                                                                        <td align="center"><?php echo($valtemp[3]); ?></td>
                                                                                </tr>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td><strong>Pbiserial</strong></td>
                                                                                        <td align="center"><?php echo($valtemp[4]); ?></td>
                                                                                </tr>
                                                                                <tr onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#EFE7CE';">
                                                                                        <td><strong>Discrim</strong></td>
                                                                                        <td align="center"><?php echo($valtemp[5]); ?></td>
                                                                                </tr>
                                                                        </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                        <td align="center">
                                                            <p><strong>Reactivos:</strong></p>
                                                            <select id="reactivo" name="reactivo" size="15" onchange="xajax_muestraresultados(document.getElementById('reactivo').value,'<?php echo($_GET["id"]); ?>');return false;" >
                                                                <?php
                                                                foreach($datosSelect as $clave => $valor)
                                                                {
                                                                    if ($clave == 0)
                                                                    {
                                                                        echo("<option selected value='".$valor."'>".$valor."</option>");
                                                                    }else
                                                                    {
                                                                    echo("<option value='".$valor."'>".$valor."</option>");
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            </br>
                                                            </br>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    </table>
                                                    
						</td>
					</tr>
				</table>
                          </form>
			</div>
		  </div>
		</div><!-- /.container -->
		<!-- Bootstrap core JavaScript -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!-- Make sure to add jQuery - download the most recent version at http://jquery.com/ -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>