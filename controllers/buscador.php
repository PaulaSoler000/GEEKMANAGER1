<?php
session_start();
include_once("database.php");
$user_id = $_SESSION['user_id'];
$pagina_id=$_SESSION['id_pag_act'];
$_SESSION['id_pag_act']=8;

$buscar = $_GET['texto'];
echo $buscar;
$_SESSION['buscador']=$buscar;

echo $_SESSION['buscador'];



if ($pagina_id == 2) {
    header("Location: ../views/libros.php");
  } else if ($pagina_id == 1) {
    header("Location: ../views/mangas.php");
  } else if ($pagina_id == 3) {
    header("Location: ../views/videojuegos.php");
  } else if ($pagina_id == 4) {
    header("Location: ../views/figuras.php");
  }else if ($pagina_id == 0){
    header("Location: ../views/inicio.php");
  }
?>
