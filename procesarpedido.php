<?php
require_once "./partials/header.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "./crud/conexion.php";
    // Recoge los datos del formulario
    $nombre=escapar($_POST["nombre"]);
    $direccion=escapar($_POST["direccion"]);
    $telefono = escapar($_POST['telefono']);
    $comentarios = escapar($_POST['comentarios']);

    $consulta=$conexion->query("INSERT INTO pedidos (nombre, direccion, telefono, comentarios) VALUES
      ('$nombre', '$direccion', '$telefono', '$comentarios')");
    echo "<p class='alert alert-success'>Pedido procesado</p>";
    header("Location: /shop/ ");
}