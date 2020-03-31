<!DOCTYPE html>
<?php 
session_start(); //Inicio sesion 

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "laoccidental";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$directorio = $_SERVER['DOCUMENT_ROOT'].'/LaOccidental/img/productos/';
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
<div class="container-fluid">
	<h4><b>Eliminar Artículos</b></h4>
	<form class="table-responsive" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="w3-section">
		  <label>Nombre</label>
		  <input  type="text" placeholder="" name="nom">
		  <button class="w3-button  w3-black w3-section w3-padding" type="submit" name="buscar">Buscar</button>
		</div>
<?php
if (isset($_POST['buscar'])) {
	$nombre = test_input($_POST["nom"]);
	
	$sql = "SELECT * FROM productos WHERE nombre LIKE '$nombre%'";
	$result = mysqli_query($conn, $sql);
	
	$i=0;
	
	if (mysqli_num_rows($result) > 0) {
		
		echo '<div class="table-responsive">';
					echo '<table class=" w3-table-all table-hover">';
					echo '<thead>';
						echo '<tr class="w3-black">';
							echo '<th>ID</th>';
							echo '<th>Nombre</th>';
							echo '<th>Marca</th>';
							echo '<th>Descripción</th>';
							echo '<th>Color</th>';
							echo '<th>Precio</th>';
							echo '<th>ID Imagen</th>';
							echo '<th>Habilitar Cambio</th>';
						echo '</tr>';
					echo '</thead>';
					while($row = mysqli_fetch_assoc($result)){
						$cla = $row["id_producto"];
						$nomb = $row["nombre"];
						$marc = $row["marca"];
						$des = $row["descripcion"];
						$color = $row["color"];
						$pre = $row["precio"];
						$imagen = $row["imagen"];
						echo '<tr>';
							echo '<td><input size="4" class="w3-border w3-margin-bottom" type="text" name="pcla['.$i.']" value="'. $cla .'" redonly></td>';
							echo '<td><input class="w3-border w3-margin-bottom" type="text" name="pnomb['.$i.']" value="'. $nomb .'" readonly></td>';
							echo '<td><input class="w3-border w3-margin-bottom" type="text" name="pmarc['.$i.']" value="'. $marc .'" readonly></td>';
							echo '<td><input class="w3-border w3-margin-bottom" type="text" name="pdesc['.$i.']" value="'. $des .'" readonly></td>';
							echo '<td><input size="12" class="w3-border w3-margin-bottom" type="text" name="pcolor['.$i.']" value="'. $color .'" readonly></td>';
							echo '<td><input size="10" class="w3-border w3-margin-bottom" type="text" name="pprec['.$i.']" value="'. $pre .'" readonly></td>';
							echo '<td><input size="12" class="w3-border w3-margin-bottom" type="text" name="pimagen['.$i.']" value="'. $imagen .'" readonly></td>';
							echo '<td><input type="checkbox" name="pcamb['.$i.']">';
						echo '</tr>';
						
						$i++;
					}
				echo '</table>';
		echo '</div>';
		
		echo '<button class="w3-button w3-black w3-section" type="submit" name="eliminar">Eliminar</button>';
	
	}
	else {
		echo "<script>alert('No existe el artículo');</script>";
	}
}
?>

</form>

 <?php
if (isset($_POST['eliminar'])) {
	$claves  = $_POST["pcla"];
	$imagenes = $_POST['pimagen'];
	if (isset($_POST['pcamb'])) {
	
		foreach($_POST['pcamb'] as $key=>$value) {
			//echo $key;
			$mcla = test_input($claves[$key]);
			$mimg = $imagenes[$key];
			$sql = "DELETE from productos where id_producto = $mcla";
			unlink($directorio.$mimg);  
			
			if (mysqli_query($conn, $sql)) {
				echo "<script>alert('El artículo ha sido eliminado exitosamente');</script>";
			} else {
				echo "<script>alert('El artículo no ha sido eliminado');</script>" . mysqli_error($conn);
				
			}
		}
	}
}

mysqli_close($conn);
?>

</div>
</body>
</html>