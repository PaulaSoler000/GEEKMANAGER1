<?php
include_once("database.php");
$db = new Database();

$conexion = $db->connect();


$id_objeto = $_GET["id_objeto"];

$imagen = '';


if (isset($_FILES["galeria"])) {
  $file = $_FILES["galeria"];
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



$sql = $conexion->prepare("INSERT INTO galeria(id_objeto, galeria) VALUES(?,?)");
$sql -> execute([$id_objeto,$imagen]);

$_SESSION["id_objeto"] = $id_objeto;

echo $imagen;

      header("Location: ../views/info.php?id_objeto=$id_objeto");
?>

