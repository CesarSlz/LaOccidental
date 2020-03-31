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

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<html>
<head>
<title>Muebleria La Occidental Administrador</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">

<style>
.division{
	padding-right:15px;
	padding-left:15px;
	margin-right:auto;
	margin-left:auto;
}
</style>

<head>
<body>
<div class="division">
	<h4><b>Listado de Artículos</b></h4>
<?php

$sql = "SELECT * FROM productos";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
		
	echo '<div class="w3-container">';
		echo '<table class="w3-table-all">';
			echo '<thead>';
				echo '<tr class="w3-black">';
					echo '<th>ID</th>';
					echo '<th>Nombre</th>';
					echo '<th>Marca</th>';
					echo '<th>Descripción</th>';
					echo '<th>Color</th>';
					echo '<th>Precio</th>';
				echo '</tr>';
			echo '</thead>';
			while($row = mysqli_fetch_assoc($result)){
				$cla = $row["id_producto"];
				$nomb = $row["nombre"];
				$marc = $row["marca"];
				$des = $row["descripcion"];
				$color = $row["color"];
				$pre = $row["precio"];
				echo '<tr>';
					echo '<td>' . $cla . '</td>';
					echo '<td>' . $nomb . '</td>';
					echo '<td>' . $marc . '</td>';
					echo '<td>' . $des . '</td>';
					echo '<td>' . $color . '</td>';
					echo '<td>' . $pre . '</td>';
				echo '</tr>';
			}
		echo '</table>';
	echo '</div>';
}
else {
	echo "<script>alert('No existen artículos en la base de datos');</script>";
}

mysqli_close($conn);
?>

</div>
</body>
</html>