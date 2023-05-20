<?php

session_start();
$_SESSION['id_pag_act']=0;
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
 




      <form action="../controllers/login.php" method="POST" id="login_view">
      <h1 class="titulo_registro">Accede o <a href="signup_view.php">Regístrate</a></h1>
      <label for="email">Email:</label><br>
        <input name="email" type="text" placeholder="Introduzca su email" required><br>
        <label for="password">Contraseña:</label><br>
        <input name="password" type="password" placeholder="Introduzca su contraseña" required><br>
        <button type="submit" name="login_view" value="Submit">Entrar</button>
      </form>

  </div>

  <!--footer-->
<footer class="footer">
    <div class="footer__addr logo">
        <a href="../index.php">
            <img src="../img/logo_con_nombre.png">
        </a>

    </div>

    <div class="footer__nav">
 

    </div>


    <div class="legal">
        <p>Copyright &copy; 2023 GeekManager. All rights reserved.</p>

        <div class="legal__links">
            <a href="#">Privacy Policy</a>
        </div>
    </div>
</footer>


</body>

</html>