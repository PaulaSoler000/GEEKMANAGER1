<?php
include_once("database.php");
$db = new Database();

$conexion = $db->connect();

$id_foto = $_GET['id_foto'];
$id_objeto = $_GET["id_objeto"];


$sql = $conexion->prepare("DELETE FROM galeria WHERE id_foto = :id_foto");
$sql->bindParam(":id_foto", $id_foto, PDO::PARAM_INT);
$sql->execute();


$_SESSION["id_objeto"] = $id_objeto;

header("Location: ../views/info.php?id_objeto=$id_objeto");

?>