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
  <title>Iniciar Sesión</title>
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
  
  <h3>Iniciar Sesión</h3>
  <hr>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="email">Correo Electrónico</label>
      <input type="email" class="form-control" id="email" placeholder="Ingresa tu Correo Electrónico" name="correo" required>
	  <br>
    </div>
	
    <div class="form-group">
      <label for="pwd">Contraseña</label>
      <input type="password" class="form-control" id="pwd" placeholder="Ingresa tu Contraseña" name="contra" required>
	  <br>
    </div>
	
	
    <button type="submit" class="btn btn-default" name="ingresar">Iniciar Sesión</button>
	<br>
	<hr>
	<a onclick="window.location.href='crearCuenta.php'" class="btn btn-default">Crear Cuenta</a>
  </form>
</div>

<?php
if (isset($_POST['ingresar'])) {
	$correo = test_input($_POST["correo"]);
	$password = test_input($_POST["contra"]);

	$sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena='$password'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$_SESSION['usuario'] = $correo; //Guardo el nombre del usuario en sesion 
		//$_SESSION['pedido'] = "";

		while($row = mysqli_fetch_assoc($result)) {
			$categoria = $row["tipo"];
			$_SESSION['claveu'] = $row['id_usuario'];
		}
		if ($categoria == "admin") {
			echo "<script>window.top.location.href='laOccidentalAdmin.php';</script>";
		}
		else{
			echo "<script>window.top.location.href='laOccidental.php';</script>";
		}
		
   } else {
	   session_destroy();
	   echo "<script>alert('Usuario Incorrecto');</script>";
   }

}
mysqli_close($conn);

?>

</body>
</html>