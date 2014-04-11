<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="iso-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Universidad Autónoma Metropolitana</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<!-- Add custom CSS here -->
		<link href="css/logo-nav.css" rel="stylesheet">
		<script src="Chart.js-master/Chart.js"></script>
		<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
		<style>
			canvas{}
		</style>
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
				<a class="navbar-brand logo-nav" href="index.php"><img src="/images/logoUAM.jpg"></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#about">About</a></li>
					<li><a href="/archivos/cargardat.php">Cargar Archivos</a></li>
					<li><a href="cerrarSession.php">Cerrar sesión</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container -->
		</nav>
		<div class="container">
		  <div class="row">
			<div class="col-lg-12">
			  <h1>EXAMEN UAM 2013 RAZONAMIENTO VERBAL FORMA A</h1>
			  <p> </p>
				<table width="100%" border="0" cellpadding="2" cellspacing="2" style="background-color: #ffffff;">
					<tr valign="top">
						<td style="border-width : 0px;"><br />
							<a href="excel.php">Leer archivo Excel</a>
						</td>
						<td style="border-width : 0px;">
						<br />
						</td>
					</tr>
					<tr valign="top">
						<td style="border-width : 0px;">
							<canvas id="canvas" height="300" width="750"></canvas>
							<script>
								var barChartData = {
									labels : ["9","28","10","20","8","29","13","11","17","4","5","6","7","23","21","12","26","22","18","14","30","27","2","19","25","15","16","3","1","24"],
									datasets : [
										{
											fillColor : "rgba(151,187,205,0.5)",
											strokeColor : "rgba(151,187,205,1)",
											data : [76.48,64.52,63.04,60.02,58.26,56.9,56.54,55.83,54.75, , , , , , , , , , , , , , , , , , , , , ]
										},
										{
											fillColor : "rgba(200,187,205,0.5)",
											strokeColor : "rgba(200,187,205,1)",
											data : [ , , , , , , , , ,54.39,54.1,53.4,52.78,51.92,49.6,49.37,48.87,48.18,48.07,47.24,47.23, , , , , , , , , ]
										},
										{
											fillColor : "rgba(200,50,205,0.5)",
											strokeColor : "rgba(200,50,205,1)",
											data : [ , , , , , ,,,,,,,,,,,,,,,,44.49,42.23,39.57,37.17,36.9,36.58,34.9,34.73,30.21]
										},
									]
								}
							var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);
							
							</script>		
						</td>
						<td style="border-width : 0px;">
						<p>Seleccion</p> 
						<SELECT NAME="Colores" MULTIPLE size="15"> 
							   <OPTION VALUE="r">9</OPTION> 
							   <OPTION VALUE="g">28</OPTION> 
							   <OPTION VALUE="b">10</OPTION> 
							   <OPTION VALUE="7">20</OPTION> 
							   <OPTION VALUE="8">8</OPTION> 
							   <OPTION VALUE="9">29</OPTION> 
							   <OPTION VALUE="1">13</OPTION> 
							   <OPTION VALUE="2">11</OPTION> 
							   <OPTION VALUE="b3">17</OPTION> 
							   <OPTION VALUE="r4">4</OPTION> 
							   <OPTION VALUE="g5">5</OPTION> 
							   <OPTION VALUE="b6">6</OPTION> 
							   <OPTION VALUE="r7">7</OPTION> 
							   <OPTION VALUE="g8">23</OPTION> 
							   <OPTION VALUE="b9">21</OPTION> 
						</SELECT> 
						</td>
					</tr>
				</table>
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