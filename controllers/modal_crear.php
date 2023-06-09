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
  if (empty($_POST["nombre_objeto"]) or empty($_POST["año_salida"]) or empty($_POST["tipo_objeto"]) or empty($_POST["curso"]) or empty($_POST["descripcion"])) {
    echo '<div>Uno de los campos esta vacio</div>';
  } else {
    $nombre_objeto = $_POST["nombre_objeto"];
    $año_salida = $_POST["año_salida"];
    $tipo_objeto = $_POST["tipo_objeto"];
    $estado_objeto = $_POST["estado_objeto"];
    $curso = $_POST["curso"];
    $descripcion = $_POST["descripcion"];

    $data = json_decode($_POST["tags"], true);
    $tagsArray = array();

    foreach ($data as $item) {
      $tagsArray[] = $item['value'];
    }

    $tags = implode(', ', $tagsArray);




    //opciones
    $edicion = $_POST["edicion"];
    $editorial = $_POST["editorial"];
    $volumen = $_POST["volumen"];
    $autor = $_POST["autor"];
    $genero = $_POST["genero"];
    $plataforma = $_POST["plataforma"];
    $compañia = $_POST["compañia"];
    $altura = $_POST["altura"];
    $marca = $_POST["marca"];


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
      if ($tipo_objeto == "figura") {
        $sql = $conexion->prepare("INSERT INTO inventario(nombre_objeto, año_salida, tipo_objeto, estado_objeto, curso, descripcion, foto, id_usuario, edicion, altura, marca, tags) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->execute([$nombre_objeto, $año_salida, $tipo_objeto, $estado_objeto, $curso, $descripcion, $imagen, $user_id, $edicion, $altura, $marca, $tags]);
      } else if ($tipo_objeto == "libro") {
        $sql = $conexion->prepare("INSERT INTO inventario(nombre_objeto, año_salida, tipo_objeto, estado_objeto, curso, descripcion, foto, id_usuario, edicion, volumen, editorial, autor, genero,tags) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?)");
        $sql->execute([$nombre_objeto, $año_salida, $tipo_objeto, $estado_objeto, $curso, $descripcion, $imagen, $user_id, $edicion, $volumen, $editorial, $autor, $genero, $tags]);
      } else if ($tipo_objeto == "videojuego") {
        $sql = $conexion->prepare("INSERT INTO inventario(nombre_objeto, año_salida, tipo_objeto, estado_objeto, curso, descripcion, foto, id_usuario, edicion, genero, plataforma, compañia, tags) VALUES (?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)");
        $sql->execute([$nombre_objeto, $año_salida, $tipo_objeto, $estado_objeto, $curso, $descripcion, $imagen, $user_id, $edicion, $genero, $plataforma, $compañia, $tags]);
      } else if ($tipo_objeto == "manga") {
        $sql = $conexion->prepare("INSERT INTO inventario(nombre_objeto, año_salida, tipo_objeto, estado_objeto, curso, descripcion, foto, id_usuario, edicion, editorial, volumen, autor, genero, tags) VALUES (?,?, ?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->execute([$nombre_objeto, $año_salida, $tipo_objeto, $estado_objeto, $curso, $descripcion, $imagen, $user_id, $edicion, $editorial, $volumen, $autor, $genero, $tags]);
      }

     

      if ($sql) {
        echo 'Objeto añadido';
        $sql = $conexion->prepare("SELECT id_objeto from inventario order by id_objeto desc limit 1");
        $sql->execute();
  
        $idpenultimo=$sql ->fetchObject();
        $idultimo = $idpenultimo -> id_objeto;

        header("Location: ../views/info.php?id_objeto=$idultimo");
      }

      ob_flush();
    }
  }
}

?>