<!DOCTYPE html>

<?php 
session_start(); //Inicio sesion 
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "laoccidental";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

//Cerrar Sesión
echo '<form id="fcerrar" action="laOccidental.php" method="get"> ';
	echo '<input type="hidden" name="cerrar">';
echo '</form>';

if(isset($_GET['cerrar'])){
	session_destroy(); 
	echo "<script>location.assign('laOccidental.php');</script>";
}

// define variables and set to empty values
$name = $pasword = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?> 

<html lang="en">
<head>
  <title>Muebleria La Occidental Administrador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
  
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-top: 0;
	  margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
	 padding-top:10px;
	 padding-bottom:10px;
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
	.carousel-inner img {
      width: 100%; /* Set width to 100% */
      max-height:600px;
	  margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }	
</style>

</head>
<body>

	<div class="jumbotron" style="background-image: url('img/fondo.jpg'); background-repeat:no-repeat; background-size: 100%;">
		<h1><img src="img/logo.png" style="float:left; width:60px; margin-left:10px; margin-right:10px;" ></img><p style="font-size:60px; color:black;">Muebleria La Occidental</h1>      
	</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>  		
      </button>
	  <a class="navbar-brand" style="background-color:black; color:white;" href="laOccidentalAdminCI.html" target="marco2">Inicio</a>
    </div>
	
    <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Artículos<span class="caret"></span></a>
			 <ul class="dropdown-menu">
			  <li><a href="buscar.php" target="marco2">Buscar</a></li>
			  <li class="divider"></li>
			  <li><a href="listado.php" target="marco2">Listado</a></li>
			  <li class="divider"></li>
			  <li><a href="agregar.php" target="marco2">Agregar</a></li>
			  <li class="divider"></li>
			  <li><a href="modificar.php" target="marco2">Modificar</a></li>
			  <li class="divider"></li>
			  <li><a href="eliminar.php" target="marco2">Eliminar</a></li>
			 </ul>
			</li>
		</ul>
	
        <ul class="nav navbar-nav navbar-right">
		  <?php
			if (isset($_SESSION['usuario'])) {
				echo '<li><a href="#" onclick="document.getElementById(' . "'fcerrar'" . ').submit()"><span class="glyphicon glyphicon-user"></span> Cerrar Sesión</a></li>';
			}
		  ?>
		  
        </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
	<iframe src="laOccidentalAdminCI.html" name="marco2" width="100%" height="700px"  style="border:none"></iframe>
</div>

<footer class="container-fluid" >
<div class="container">
<table width="60%" align="center">
	<tr>
		<td style="vertical-align:top" width="30%">
			<p style="text-align:center"><b>CONTACTO</b></p>
			<hr width="90%" style="border-color:gray">
			<p>Muebleria La Occidental S.A. de C.V.</p>
			<p>Calle Fresno No. 2242, Colonia Del Freno</p>
			<p>Guadalajara Jalisco</p>
			<p>C.P. 44900</p>
			<p>Tel. (33)33 4390 3211</p>
			<p>laoccidental@gmail.com</p>
		</td>
		
		<td style="vertical-align:top" width="30%">
			<p style="text-align:center"><b>REDES SOCIALES</b></p>
			<hr width="90%" style="border-color:gray">
				<div align="center">
				<img src="img/facebook.jpg" style="width:13%; height:45px;"></img>
				<img src="img/twitter.png" style="width:13%; height:45px;"></img>
				<img src="img/instagram.jpg" style="width:13%; height:45px;"></img>
				</div>
			<br>
			<p style="text-align:center"><b>FORMAS DE PAGO</b></p>
			<hr width="90%" style="border-color:gray">
				<div align="center">
				<img src="img/visa.png" style="width:15%; height:50px;"></img>
				<img src="img/master.png" style="width:15%; height:50px;"></img>
				<img src="img/paypal.png" style="width:15%; height:50px;"></img>
				</div>
		</td>
		
	</tr>
	</table>

</div>
</footer>

<?php
	mysqli_close($conn);
?>

</body>
</html>