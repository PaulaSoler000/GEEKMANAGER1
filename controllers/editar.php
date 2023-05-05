<?php
include_once("database.php");
$user_id = $_SESSION['user_id'];
$db = new Database();
$id_objeto = $_SESSION['id_objeto'];
$conexion = $db->connect();


//$pagina_id = $_SESSION['id_pagina'];

$sql = $conexion->prepare("SELECT * FROM inventario WHERE id_objeto = :id_objeto");
$sql->bindParam(':id_objeto', $id_objeto);
$sql->execute();
$datos = $sql->fetchObject();

$imagen = $datos->foto;



  if (isset($_FILES["foto"])) {
    $file = $_FILES["foto"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];

  
    $carpeta = realpath("../fotos") . "/";
    if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/PNG') {
      echo "Error, el archivo no es una imagen";
    } else if ($size > 3 * 1024 * 1024) {
      echo "Error, el tamaño máximo permitido es un 3MB";
    } else {
      $dimensiones = getimagesize($ruta_provisional);
      $witdh = $dimensiones[0];
      $height = $dimensiones[1];
      $src = $carpeta . $nombre;

      move_uploaded_file($ruta_provisional, $src);

      if (!file_exists($src)) {
        echo "Error al subir la imagen";
      } else {
        $imagen = "../fotos/" . $nombre;
      }
    }
  }




if (!empty($_POST["editar_objeto"])) {
  if (empty($_POST["id_objeto"]) or empty($_POST["nombre_objeto"]) or empty($_POST["tipo_objeto"]) or empty($_POST["curso"]) or empty($_POST["descripcion"])) {
    echo '<div>Uno de los campos esta vacio</div>';
  } else {
    $id_objeto = $_POST["id_objeto"];
    $nombre_objeto = $_POST["nombre_objeto"];
    $tipo_objeto = $_POST["tipo_objeto"];
    $estado_objeto = $_POST["estado_objeto"];
    $curso = $_POST["curso"];
    $descripcion = $_POST["descripcion"];


    ob_start();
    // El usuario existe en la tabla users, se puede realizar la inserción
    $sql = $conexion->prepare("UPDATE inventario SET nombre_objeto=?, tipo_objeto=?, estado_objeto=?, curso=?, descripcion=?, foto=? WHERE id_objeto=?");
    $sql->execute([$nombre_objeto, $tipo_objeto, $estado_objeto, $curso, $descripcion, $imagen, $id_objeto]);

    if ($sql) {
      echo 'Objeto añadido';

      $_SESSION['id_objeto'] = $id_objeto;

      if ($pagina_id == 1) {
        header("Location: ../views/info.php");
      } else {
        if ($tipo_objeto == 'libro') {
          header("Location: ../views/libros.php");
        } else if ($tipo_objeto == 'manga') {
          header("Location: ../views/mangas.php");
        } else if ($tipo_objeto == 'videojuego') {
          header("Location: ../views/videojuegos.php");
        } else if ($tipo_objeto == 'figura') {
          header("Location: ../views/figuras.php");
        }
      }
    } else {
      echo 'Error al añadir objeto: ' . $db->error;
    }

    ob_flush();
  }
}
?>