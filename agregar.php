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
	<h4><b>Agregar Artículos</b></h4>
	<form class="w3-container" method="post" enctype='multipart/form-data' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="w3-section">
				  <label>Nombre</label>
				  <br>
				  <input  type="text" placeholder="" name="nom" required>
				  <br>
				  <label>Marca</label>
				  <br>
				  <input  type="text" placeholder="" name="marca" required>
				  <br>
				  <label>Descripción</label>
				  <br>
				  <input  type="text" placeholder="" name="desc" required>
				  <br>
				  <label>Color</label>
				  <br>
				  <input  type="text" placeholder="" name="color" required>
				  <br>
				  <label>Precio</label>
				  <br>
				  <input  type="text" placeholder="" name="pre" required>
				  <br>
				  <br>
				  <input id="imagen" name="imagen" size="30" type="file" />
				 <br>
				 <button class="w3-button  w3-black w3-section w3-padding" type="submit" name="agregar">Agregar</button>
				</div>
	 </form>
<?php
if (isset($_POST['agregar'])) {
	$nom = test_input($_POST["nom"]);
	$marc = test_input($_POST["marca"]);
	$desc = test_input($_POST["desc"]);
	$color = test_input($_POST["color"]);
	$pre = test_input($_POST["pre"]);
	$nombre_img = $_FILES['imagen']['name'];
	$tipo = $_FILES['imagen']['type'];
	$tamano = $_FILES['imagen']['size'];
	
	if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 400000)) 
	{
   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($_FILES["imagen"]["type"] == "image/gif")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/png"))
   {
      // Ruta donde se guardarán las imágenes que subamos
      $directorio = $_SERVER['DOCUMENT_ROOT'] . '/LaOccidental/img/productos/';
      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
    
	$sql = "INSERT INTO productos (nombre,marca,descripcion,color,precio,imagen)
		VALUES ('$nom', '$marc', '$desc', '$color', '$pre', '$nombre_img')";

	if (mysqli_query($conn, $sql)) {
		echo "<script>alert('El artículo $nom ha sido guardado exitosamente');</script>";
	} else {
		echo "<script>alert('El artículo no ha sido guardado');</script>" . mysqli_error($conn);
		}
	
	} 
    else 
    {
       //si no cumple con el formato
       echo "No se puede subir una imagen con ese formato ";
    }
} 
else 
{
   //si existe la variable pero se pasa del tamaño permitido
   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
}	
	}


mysqli_close($conn);
?>

</div>
</body>
</html>