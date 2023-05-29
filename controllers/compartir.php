<?php
include_once("database.php");

$db = new Database();
$conexion = $db->connect();

$id_objeto = $_GET["id_objeto"];

$sql = $conexion-> prepare("UPDATE inventario SET compartir = ? WHERE id_objeto = ? ;");
$sql->execute([1,$id_objeto]);

$datos = $sql->fetchObject();


?>