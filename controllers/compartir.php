<?php
include_once("database.php");

$db = new Database();
$conexion = $db->connect();

$id_objeto = $_GET["id_objeto"];
echo $id_objeto;
$sql = $conexion-> prepare("UPDATE inventario SET compartir = ? WHERE id_objeto = ? ;");
$sql->execute([1,$id_objeto]);

$datos = $sql->fetchObject();

if (!empty($_GET["id_objeto"])) {
  $id_objeto = $_GET["id_objeto"];
  $sql = $conexion->query("DELETE FROM inventario WHERE id_objeto = $id_objeto");
}

if ($datos->tipo_objeto == 'libro') {
  header("Location: ../views/libros.php");
} else if ($datos->tipo_objeto == "manga") {
  header("Location: ../views/mangas.php");
} else if ($datos->tipo_objeto == 'videojuego') {
  header("Location: ../views/videojuegos.php");
} else if ($datos->tipo_objeto == 'figura') {
  header("Location: ../views/figuras.php");
}

?>