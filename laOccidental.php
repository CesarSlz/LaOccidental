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

//$_SESSION['claveu'] ="";

//Cerrar Sesión
echo '<form id="fcerrar" action="laOccidental.php" method="get"> ';
	echo '<input type="hidden" name="cerrar">';
echo '</form>';

if(isset($_GET['cerrar'])){
	session_destroy(); 
	echo "<script>location.assign('laOccidental.php');</script>";
}

if (!isset($_SESSION['pedido'])) {
	$_SESSION['pedido'] = null;	
}


if(isset($_POST['agregar'])){ //Si se envió el primer formulario 
	$claves = array_keys($_POST); 
	$producto = $claves[1]; 
	if(!is_array($_SESSION['pedido'])) //Si no es un array 
	{
		$_SESSION['pedido'] = array();
	}
	if(array_key_exists("$producto",$_SESSION['pedido'])){ 
		$cantidad = $_SESSION['pedido']["$producto"]; 
		$_SESSION['pedido']["$producto"] = ++$cantidad; 
	} 
	else { 
		$_SESSION['pedido']["$producto"] = 1; 
	}	 
}
if(isset($_GET['quitar'])){ //Si se envió el segundo formulario 
	$claves = array_keys($_GET); 
	$producto = $claves[1]; 
	if (array_key_exists("$producto",$_SESSION['pedido'])) {
		$cantidad = $_SESSION['pedido']["$producto"]; 
		if ($cantidad >1 ) {
			$_SESSION['pedido']["$producto"] = --$cantidad; 
		}
		else {
			unset($_SESSION['pedido'][$producto]); //Eliminar la posicion del arreglo 
		}
	}
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
  <title>Muebleria La Occidental</title>
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
		<h1><img src="img/logo.png" style="float:left; width:70px; margin-left:10px; margin-right:10px;" ></img><p style="font-weight: 400; font-size:60px; color:black;">Mueblería La Occidental</h1>      
		
		<div class="container-fluid" align="right">
		<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		  <input  type="text" placeholder="Buscar" name="nom">
		  <button class="w3-black" style="border:solid black" type="submit" name="buscar"><span style="color:white" class="glyphicon glyphicon-search"></span></button>
		
		</form>
		</div>
	</div>
	

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>  		
      </button>
	   <a class="navbar-brand" style="background-color:black; color:white; font-family:arial;" href="laOccidental.php" onclick="mostrar()">Inicio</a>
    </div>
	
    <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav">
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" onclick="mostrar()">Sala<span class="caret"></span></a>
			 <ul class="dropdown-menu">
			  <li><a href="salas.php" target="marco1">Todas las Salas</a></li>
			  <li class="divider"></li>
			  <li><a href="mod.php" target="marco1">Salas Modulares</a></li>
			  <li class="divider"></li>
			  <li><a href="love.php" target="marco1">Love Seat</a></li>
			 </ul>
			</li>
			
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" onclick="mostrar()">Comedor<span class="caret"></span></a>
			 <ul class="dropdown-menu">
			  <li><a href="anteTod.php" target="marco1">Todos los Comedores</a></li>
			  <li class="divider"></li>
			  <li><a href="ante4.php" target="marco1">Antecomedores 4 Sillas</a></li>
			  <li class="divider"></li>
			  <li><a href="ante6.php" target="marco1">Antecomedores 6 Sillas</a></li>
			 </ul>
			</li>
		
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" onclick="mostrar()">Recámara<span class="caret"></span></a>
			 <ul class="dropdown-menu">
			  <li><a href="Recamara.php" target="marco1">Todas las Recámaras</a></li>
			  <li class="divider"></li>
			  <li><a href="cama.php" target="marco1">Camas</a></li>
			  <li class="divider"></li>
			  <li><a href="colchones.php" target="marco1">Colchones</a></li>
			 </ul>
			</li>
			
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" onclick="mostrar()">Cocina<span class="caret"></span></a>
			 <ul class="dropdown-menu">
			  <li><a href="TodCoci.php" target="marco1">Todas las Cocinas</a></li>
			  <li class="divider"></li>
			  <li><a href="cocina.php" target="marco1">Cocinas</a></li>
			  <li class="divider"></li>
			  <li><a href="Isla.php" target="marco1">Islas</a></li>
			 </ul>
			</li>
			
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" onclick="mostrar()">Decoración<span class="caret"></span></a>
			 <ul class="dropdown-menu">
			  <li><a href="decoracion.php" target="marco1">Todas las Decoraciones</a></li>
			  <li class="divider"></li>
			  <li><a href="cuadros.php" target="marco1">Cuadros</a></li>
			  <li class="divider"></li>
			  <li><a href="espejo.php" target="marco1">Espejos</a></li>
			 </ul>
			</li>
			
			<li><a href="TodProduc.php" target="marco1" onclick="mostrar()">Todos los Productos</a></li>
		
		</ul>
	
        <ul class="nav navbar-nav navbar-right">
		  <?php
			if (isset($_SESSION['usuario'])) {
				echo '<li><a href="#" onclick="document.getElementById(' . "'fcerrar'" . ').submit()"><span class="glyphicon glyphicon-user"></span> Cerrar Sesión</a></li>';
			} else {
				echo '<li><a href="iniciarSesion.php" target="marco1" onclick="mostrar()"><span class="glyphicon glyphicon-user"></span> Mi Cuenta</a></li>';	
			}
		  ?>
		  
          <li><a href="carrito.php" target="marco1" onclick="mostrar()"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito de Compra</a></li>
        </ul>
    </div>
  </div>
</nav>

<script>
function mostrar(){
	document.getElementById("marcbuscar").style.display="none";
	document.getElementById("marco1").style.display="block";
}
</script>

<div align="center">
	<iframe src="laOccidentalCI.html" id="marco1" name="marco1" width="100%" height="800px"  style="border:none"></iframe>
</div>


<div id="marcbuscar">
<?php
if (isset($_POST['buscar'])) {
?>	

<div class="w3-row-padding" style="background-color:lightgray; height:30px; line-height: 10px;">
<h6><b>Resultado</b></h6>
</div>
<br>

<form action="laOccidental.php" method="post"> 
<input type="hidden" name="agregar"> 

<div class="w3-row-padding">	
	
<?php	
echo '<script>document.getElementById("marco1").style.display="none"</script>';
$dirImagenes = "img/productos/";
$busqueda =$_POST["nom"];
$sql = "SELECT * FROM productos WHERE nombre LIKE '$busqueda%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    while($row = mysqli_fetch_assoc($result)) {
		
		$cla = $row["id_producto"];
		$nomb = $row["nombre"];
		$marc = $row["marca"];
		$des = $row["descripcion"];
		$color = $row["color"];
		$pre = $row["precio"];
			$imagen = $row["imagen"];
		//$cad = $cla . "_" . $nomb . "_" . $marc . "_" . $pre;
	
	

	
	
	
	echo '<div class="w3-quarter w3-margin-bottom">
			<ul class="w3-ul w3-border w3-center w3-hover-shadow">
				<li style="background-color:#222222"><b style="color: white; font-size:15;">Nombre: '. $nomb . '</b></li>
				
				<div class="w3-display-container">
					<img src="'.$dirImagenes.$imagen.'" style="width:100%; height:200px;">
					<div class="w3-display-middle w3-display-hover">
						<button class="w3-button" style="color: white; background-color:#222222" type="submit" name="'. $cla .'" id="button" value="Añadir al carrito"> añadir al carrito <span class="glyphicon glyphicon-shopping-cart"></span></button>
					</div>
				</div>
				
				<li style="padding:0;"><p style="font-size:13;"><b>Marca: </b>' . $marc . '</p></li>
				<li style="padding:0;"><p style="font-size:13;"><b>Descripción: </b>' . $des . '</p></li>
				<li style="padding:0;"><p style="font-size:13;"><b>Color: </b>' . $color . '</p></li>
				<li class="w3-light-grey"><p style="font-size:15;"><b>Precio: </b>$' . $pre . '</p></li>
			</ul>
		</div>'
		;	
	
	
	
    }
} 
else {
	echo "<script>alert('No existe el artículo');</script>";
}
?> 
</div>
</form>
<?php
}
 ?> 
</div>

  
<footer class="container-fluid">
<div class="container">
<table width="60%" align="center">
	<tr>
		<td style="vertical-align:top" width="30%">
			<p style="text-align:center"><b>CONTACTO</b></p>
			<hr style="border-color:gray">
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
				<a href="https://www.facebook.com/"><img src="img/facebook.jpg"  style="width:13%; height:45px;"></img></a>
				<a href="https://www.twitter.com/" ><img src="img/twitter.png" style="width:13%; height:45px;"></img></a>
				<a href="https://www.instagram.com/" ><img src="img/instagram.jpg" style="width:13%; height:45px;"></img></a>
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