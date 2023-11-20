<?php
require_once "conexion.php";

$datoPrueba1 = "INSERT INTO productos (nombre, descripcion, precio, imagen)
    VALUES ('Camiseta 1', 'Algodon 100%', 19.99, 'camiseta1.jpg');";

    $datoPrueba2 = "INSERT INTO productos (nombre, descripcion, precio, imagen)
    VALUES ('Camiseta 2', 'Algodon 80% + 20% Poliester', 14.99, 'camiseta2.jpg');";

    $datoPrueba3 = "INSERT INTO productos (nombre, descripcion, precio, imagen)
    VALUES ('Camiseta 3', 'Algodon 70% + 20% Poliester + 10% seda', 29.99, 'camiseta3.jpg');";

    $conexion->query($datoPrueba1);
    $conexion->query($datoPrueba2);
    $conexion->query($datoPrueba3);