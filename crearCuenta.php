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


// Funcion para quitar espacios en blanco
$correo = $password = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html lang="en">
<head>
  <title>Crear Cuenta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container"  style="width:50%; margin-left:auto; margin-right:auto;">
  <br>
  <br>
  
  <h3>Crear Cuenta</h3>
  <hr>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
      <label for="nombre">Nombre</label><label style="color:red">&nbsp;*</label>
      <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
    </div>
	<br>
    <div>
      <label for="apellido">Apellido</label><label style="color:red">&nbsp;*</label>
      <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" required>
    </div>
	<br>
	<div>
      <label for="fecha">Fecha de nacimiento</label><label style="color:red">&nbsp;*</label>
      <input type="date" class="form-control" id="fecha" name="fecha" required>
    </div>
	<br>
	<div>
      <label for="email">Correo Electrónico</label><label style="color:red">&nbsp;*</label>
      <input type="email" class="form-control" id="email" placeholder="Correo Electrónico" name="correo" required>
    </div>
	<br>
	<div>
      <label for="pwd">Contraseña</label><label style="color:red">&nbsp;*</label>
      <input type="password" class="form-control" id="pwd" placeholder="Constraseña" name="contra" required>
    </div>
	<br>
    <div>
      <label><input type="checkbox" name="remember" id="tc" required>Acepto términos y condiciones</label><label style="color:red">&nbsp;*</label>
	  <br><br>
    </div>
    <button type="submit" class="btn btn-default" name="guardar">Crear Cuenta</button>
  </form>
</div>

<?php
if (isset($_POST['guardar'])) {
	$nomb = test_input($_POST["nombre"]);
	$ap = test_input($_POST["apellido"]);
	$fech = test_input($_POST["fecha"]);
	$correo = test_input($_POST["correo"]);
	$contra = test_input($_POST["contra"]);
	
	$sql = "INSERT INTO usuarios (nombre, apellido, fecha_nacimiento, correo, contrasena, tipo)
	VALUES ('$nomb', '$ap', '$fech', '$correo', '$contra', 'cliente')";

	if (mysqli_query($conn, $sql)) {
		$_SESSION['usuario'] = $correo; //Guardo el nombre del usuario en sesion 
		//$_SESSION['pedido'] = "";

		echo "<script>window.top.location.href='laOccidental.php';</script>";
		
		echo "<script>alert('La cuenta ha sido creada');</script>";
		
	}
	else {
		echo "<script>alert('Error');</script>" . mysqli_error($conn);
		
	}
}

mysqli_close($conn);

?>

</body>
</html>