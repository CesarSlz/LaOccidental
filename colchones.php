<?php 
session_start(); //Inicio sesion 
//print_r($_POST);
//print_r($_SESSION);
//session_destroy(); 

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

if (!isset($_SESSION['pedido'])) {
	$_SESSION['pedido'] = "";
	
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


?> 

<?php
// define variables and set to empty values
$name = $pasword = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head> 
<body> 

<div class="w3-row-padding" style="background-color:lightgray; height:30px; line-height: 10px;">
<h6><b>Colchones</b></h6>
</div>
<br>

<form action="colchones.php" method="post"> 
<input type="hidden" name="agregar"> 

<div class="w3-row-padding">

<?php
$dirImagenes = "img/productos/";
$sql = "SELECT * FROM productos WHERE nombre LIKE 'colchon%'";
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
						<button class="w3-button" style="color: white; background-color:#222222" type="submit" name="'. $cla .'" id="button" value="Añadir al carrito"> añadir al carrito <span class="glyphicon glyphicon-shopping-cart"></span>
						</button>
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
	echo "No exiten los artículos solicitados";
}

mysqli_close($conn);
?>
</div>
</form> 

</body> 
</html>