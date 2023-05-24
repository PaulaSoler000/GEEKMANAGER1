<?php
include_once("database.php");

$db = new Database();
$conexion = $db->connect();

$id_objeto = $_GET["id_objeto"];

$sql = $conexion-> prepare("DELETE FROM galeria WHERE id_objeto = ?;");
$sql->execute([$id_objeto]);

$sql = $conexion->prepare("SELECT * FROM inventario WHERE id_objeto = :id_objeto");
$sql->bindParam(':id_objeto', $id_objeto);
$sql->execute();

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