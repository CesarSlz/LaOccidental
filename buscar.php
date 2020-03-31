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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
	<h4><b>Buscar Artículos</b></h4>
	<form class="table-responsive" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="w3-section">
		  <label>Nombre</label>
			<input  type="text" placeholder="" name="nombre">
			<button class="w3-button  w3-black w3-section w3-padding" type="submit" name="buscar">Buscar</button>
		</div>
	</form>
<?php

if (isset($_POST['buscar'])) {
	$nombre = test_input($_POST["nombre"]);
	
	$sql = "SELECT * FROM productos WHERE nombre LIKE '$nombre%'";
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
		echo "<script>alert('No existe el artículo');</script>";
	}
}

mysqli_close($conn);
?>

</div>
</body>
</html>