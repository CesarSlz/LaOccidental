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
<div class="container-fluid" >
	<h4><b>Modificar Artículos</b></h4>
	<form class="table-responsive" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
		
		echo '<div class="container">';
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
							echo '<td><input size="2" class="w3-border w3-margin-bottom" type="text" name="pcla['.$i.']" value="'. $cla .'" required></td>';
							echo '<td><input class="w3-border w3-margin-bottom" type="text" name="pnomb['.$i.']" value="'. $nomb .'" required></td>';
							echo '<td><input class="w3-border w3-margin-bottom" type="text" name="pmarc['.$i.']" value="'. $marc .'" required></td>';
							echo '<td><input class="w3-border w3-margin-bottom" type="text" name="pdesc['.$i.']" value="'. $des .'" required></td>';
							echo '<td><input size="12" class="w3-border w3-margin-bottom" type="text" name="pcolor['.$i.']" value="'. $color .'" required></td>';
							echo '<td><input size="10" class="w3-border w3-margin-bottom" type="text" name="pprec['.$i.']" value="'. $pre .'" required></td>';
							echo '<td><input id="imagen" name="img['.$i.']" size="30" value="'. $imagen .'" type="file" />'. $imagen .'</td>';
							echo '<td><input type="checkbox" value='.$i.' name="pcamb['.$i.']">';
						echo '</tr>';
						
						$i++;
					}
				echo '</table>';
			echo '</div>';
		echo '</div>';
		
		echo '<button class="w3-button w3-black w3-section" type="submit" name="modificar">Modificar</button>';
		
	}
	else {
		echo "<script>alert('No existe el artículo');</script>";
	}
}
?>

</form>

 <?php
if (isset($_POST['modificar'])) {
	$claves  = $_POST["pcla"];
	$nombres = $_POST["pnomb"];
	$marcas = $_POST["pmarc"];
	$descripciones = $_POST["pdesc"];
	$colores = $_POST["pcolor"];
	$precios = $_POST["pprec"];
	$imagenes = $_FILES['img'];
	if (isset($_POST['pcamb'])) {
	
		foreach($_POST['pcamb'] as $key=>$value) {
			//echo $key;
			$mcla = test_input($claves[$key]);
			$mnomb = test_input($nombres[$key]);
			$mmarc = test_input($marcas[$key]);
			$mdesc = test_input($descripciones[$key]);
			$mcolor = test_input($colores[$key]);
			$mprec = test_input($precios[$key]);
			$mimg = $imagenes["name"][$key];
			$msize = $imagenes["size"][$key];
			$mtype = $imagenes["type"][$key];
			$mtemp = $imagenes["tmp_name"][$key];
		
			if ($mimg == !NULL) 
			{
				//indicamos los formatos que permitimos subir a nuestro servidor
				if (($mtype== "image/gif")
				|| ($mtype == "image/jpeg")
				|| ($mtype == "image/jpg")
				|| ($mtype == "image/png"))
				{
					// Ruta donde se guardarán las imágenes que subamos
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/LaOccidental/img/productos/';
					// Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
					move_uploaded_file($mtemp,$directorio.$mimg);
					$sql = "UPDATE productos SET id_producto = '$mcla', nombre = '$mnomb', marca = '$mmarc', descripcion = '$mdesc', color = '$mcolor', precio = '$mprec', imagen = '$mimg'  WHERE id_producto = '$mcla'";
						if (mysqli_query($conn, $sql)) {
							echo "<script>alert('El artículo $mnomb con imagen $mimg ha sido modificado exitosamente');</script>";
						}   	else {
						echo "<script>alert('El artículo no ha sido modificado');</script>" . mysqli_error($conn);
						}
				} else 
					{
					//si no cumple con el formato
					echo "No se puede subir una imagen con ese formato ";
					}
			}
			else {
					$sql = "UPDATE productos SET id_producto = '$mcla', nombre = '$mnomb', marca = '$mmarc', descripcion = '$mdesc', color = '$mcolor', precio = '$mprec'  WHERE id_producto = '$mcla'";
						if (mysqli_query($conn, $sql)) {
							echo "<script>alert('El artículo $mnomb ha sido modificado exitosamente');</script>";
						}   	else {
						echo "<script>alert('El artículo no ha sido modificado');</script>" . mysqli_error($conn);
						}
			}
		}
	}
}

mysqli_close($conn);
?>

</div>
</body>
</html>
 