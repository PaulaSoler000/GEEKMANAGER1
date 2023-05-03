<?php

session_start();

include_once("database.php");
$user_id = $_SESSION['user_id'];
$db = new Database();

$conexion = $db->connect($user_id);

$userData = $conexion->prepare("SELECT * FROM users WHERE email =:email");

$userData->bindParam(':email', $_POST['email']);
$userData->execute();

$results = $userData->fetch(PDO::FETCH_ASSOC);

$message = '';

if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){

    $_SESSION['user_id']=$results['id'];
    $_SESSION['user_usuario']=$results['usuario'];
    $_SESSION['user_email']=$results['email'];
    header('Location: ../views/inicio.php');

}else{

    $message = 'No coincide';
    $_SESSION['login'] = $message;
    header('Location: ../views/login_view.php');
}

?>