<?php
include_once("database.php");
$user_id = $_SESSION['user_id'];
$db = new Database();

$conexion = $db->connect($user_id);

$imagen = '';


if (isset($_FILES["foto"])) {
  $file = $_FILES["foto"];
  $nombre = $file["name"];
  $tipo = $file["type"];
  $ruta_provisional = $file["tmp_name"];
  $size = $file["size"];
  $dimensiones = getimagesize($ruta_provisional);
  $witdh = $dimensiones[0];
  $height = $dimensiones[1];
  $carpeta = realpath("../fotos") . "/";
  if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/PNG') {
    echo "Error, el archivo no es una imagen";
  } else if ($size > 3 * 1024 * 1024) {
    echo "Error, el tamaño máximo permitido es un 3MB";
  } else {
    $src = $carpeta . $nombre;

    move_uploaded_file($ruta_provisional, $src);

    if (!file_exists($src)) {
      echo "Error al subir la imagen";
    } else {
      $imagen = "../fotos/" . $nombre;
    }
  }
}

if (!empty($_POST["crear_objeto"])) {
  if (empty($_POST["nombre_objeto"]) or empty($_POST["tipo_objeto"]) or empty($_POST["curso"]) or empty($_POST["descripcion"])) {
    echo '<div>Uno de los campos esta vacio</div>';
  } else {
    $nombre_objeto = $_POST["nombre_objeto"];
    $tipo_objeto = $_POST["tipo_objeto"];
    $estado_objeto = $_POST["estado_objeto"];
    $curso = $_POST["curso"];
    $descripcion = $_POST["descripcion"];

    // Verificar si el usuario existe en la tabla users
    $stmt = $conexion->prepare("SELECT id FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
      // El usuario no existe en la tabla users
      echo "El usuario no existe";
    } else {
      ob_start();
      // El usuario existe en la tabla users, se puede realizar la inserción
      $sql = $conexion->prepare("INSERT INTO inventario(nombre_objeto, tipo_objeto, estado_objeto, curso, descripcion, foto, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $sql->execute([$nombre_objeto, $tipo_objeto, $estado_objeto, $curso, $descripcion, $imagen, $user_id]);

      if ($sql) {
        echo 'Objeto añadido';


        if ($tipo_objeto == 'libro') {
          header("Location: ../views/libros.php");
        } else if ($tipo_objeto == 'manga') {
          header("Location: ../views/mangas.php");
        } else if ($tipo_objeto == 'videojuego') {
          header("Location: ../views/videojuegos.php");
        } else if ($tipo_objeto == 'figura') {
          header("Location: ../views/figuras.php");
        }
      } else {
        echo 'Error al añadir objeto: ' . $db->error;
      }

      ob_flush();
    }
  }
}

?>