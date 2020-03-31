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
</div>
<br>

<?php 

session_start(); 


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

$suma=0;

//print_r($_SESSION);
if(isset($_SESSION['pedido'])) {


}

?>

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
				echo '</tr>';
			echo '</thead>';
			
if(!empty($_SESSION['pedido'])){ //Si hay productos en el carrito
	foreach($_SESSION['pedido'] as $prod => $unidades) {
		$sql = "SELECT * FROM productos WHERE id_producto = '$prod'";
		$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)){
				$cla = $row["id_producto"];
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
					$suma= $suma + $sub ;
				echo '</tr>';
				$cusuario = $_SESSION['claveu'];
	
				$sql ="INSERT INTO ventas_productos (id_usuario,id_producto,cantidad,fecha)VALUES ('$cusuario','$cla','$unidades',NOW())";

				if (mysqli_query($conn, $sql)) {
					echo "<script>alert('Venta Guardada');</script>";
				} 
				else {
					echo "<script>alert('Error');</script>" . mysqli_error($conn);
				}
			}
	
	}
	echo '<thead>';
	echo '<tr class="w3-black">';
	echo '<th></th>';
	echo '<th></th>';
	echo '<th></th>';
	echo '<th></th>';
	echo '<th></th>';
	echo '<th>Total: '. $suma . '</th>';
	echo '</tr>';
	echo '</thead>';

	
echo '</table>';
	echo '</div>';	
	
	$_SESSION['pedido']="";

?> 
</form> 

<?php 
} 

?> 
</div>


<div class="w3-container">
<h5 align='center'>Gracias por su compra</h5> 
<a class="w3-button  w3-black w3-section w3-padding" style="float:right" href="laOccidentalCI.html">TERMINAR</a>
</div>

</body>
</html>