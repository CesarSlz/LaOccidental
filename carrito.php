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

if (!isset($_SESSION['usuario'])) {
	$_SESSION['usuario']=null;
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
<style>
.division{
	padding-right:15px;
	padding-left:15px;
	margin-right:auto;
	margin-left:auto;
}
</style>

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head> 
<body> 

<div class="w3-row-padding" style="background-color:lightgray; height:30px; line-height: 10px;">
<h6><b>El carrito de compras tiene los siguientes productos</b></h6>
</div>
<br>

<div class="division">
<form action="carrito.php" method="get"> 
<input type="hidden" name="quitar"> 
<?php 
echo '<div class="w3-container">';
		echo '<table class="w3-table-all">';
			echo '<thead>';
				echo '<tr class="w3-black">';
					echo '<th>Cantidad</th>';
					echo '<th>Nombre</th>';
					echo '<th>Marca</th>';
					echo '<th>Color</th>';
					echo '<th>Precio</th>';
					echo '<th>Subtotal</th>';
				    echo '<th></th>';
				echo '</tr>';
			echo '</thead>';
if(!empty($_SESSION['pedido'])){ //Si hay productos en el carrito
	foreach($_SESSION['pedido'] as $prod => $unidades) {
		$sql = "SELECT * FROM productos WHERE id_producto = '$prod'";
		$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)){
				$nomb = $row["nombre"];
				$marc = $row["marca"];
				$color = $row["color"];
				$pre = $row["precio"];
				$sub = $pre * $unidades;
				echo '<tr>';
					echo '<td>' . $unidades . '</td>';
					echo '<td>' . $nomb . '</td>';
					echo '<td>' . $marc . '</td>';
					echo '<td>' . $color . '</td>';
					echo '<td>' . $pre . '</td>';
					echo '<td>' . $sub . '</td>';
					echo "<td width='10%'><input type='Submit' name='$prod' value='Quitar'><br></td>"; 
				echo '</tr>';
			}
	}
echo '</table>';
	echo '</div>';	
	

?> 
</form> 


<form action="confirmar.php" method="post"> 
	<?php 
	if($_SESSION['usuario'] != ""){
	echo '<input type="Submit" name="Comprar" value="Confirmar compra">';
	}
	else{
	echo '<input type="Submit" name="Comprar" value="Confirmar compra" disabled>';
	echo "<script>alert('Inicia sesión para finalizar la compra');</script>";
	}
	?> 
</form> 
<?php 
} 
	mysqli_close($conn);

?> 
</div>
</body> 
</html>