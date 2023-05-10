<?php

session_start();

include_once("database.php");
$user_id = $_SESSION['user_id'];
$db = new Database();

$message = '';
if (!empty($_POST["signup_view"])) {
  if (empty($_POST["usuario"]) or empty($_POST["email"]) or empty($_POST["password"])) {
    $message = 'Sorry there must have been an issue creating your account';
    $_SESSION['registro'] = $message;
      header("Location: ../views/signup_view.php");
  } else {

    $conexion = $db->connect($user_id);

    $sql = 'INSERT INTO users (usuario, email, password) VALUES (:usuario, :email, :password)';

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':usuario', $_POST['usuario']);
    $stmt->bindParam(':email', $_POST['email']);

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario registrado con éxito';
      $_SESSION['registro'] = $message;
      header("Location: ../views/login_view.php");
    } else {
      $message = 'Sorry there must have been an issue creating your account';
      $_SESSION['registro'] = $message;
      header("Location: ../views/signup_view.php");
    }
  }
}

?>
