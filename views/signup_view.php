<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="../img/logo_transparente.png">
    <!-- CSS-->
    <link rel="stylesheet" href="../css/login.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- iconos fontawesome-->
    <script src="https://kit.fontawesome.com/4a0af06348.js" crossorigin="anonymous"></script>
    <title>Registro</title>
</head>

<body>
 


  <div id="form-registro">
    
      <form action="../controllers/signup.php" method="POST">
      <h1 class="titulo_registro">Regístrate o <a href="login_view.php">Accede</a></h1>
        <label for="usuario">Usuario:</label><br>
        <input name="usuario" type="text" placeholder="Intrtoduzca su usuario"><br>
        <label for="email">Email:</label><br>
        <input name="email" type="text" placeholder="Introduzca su email"><br>
        <label for="password">Contraseña:</label><br>
        <input name="password" type="password" placeholder="Introduzca su contraseña"><br>
        <button type="submit" value="Submit">Registrarse</button>
      </form>

  </div>

  



</body>

</html>