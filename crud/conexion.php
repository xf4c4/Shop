<?php
    //Conectamos con el servidor 
    $conexion=new mysqli("localhost", "root", "");

    //Creamos la base de datos si no existe
    $consulta="CREATE DATABASE IF NOT EXISTS shop;";
    $conexion->query($consulta);

    //Seleccionamos la base de datos y creamos la tabla si no existe
    $conexion->select_db("shop");
    $consulta="CREATE TABLE IF NOT EXISTS productos (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        descripcion TEXT,
        imagen VARCHAR(255) NOT NULL,
        precio DECIMAL(65,10) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";
    $conexion->query($consulta);

    $consulta2 = "CREATE TABLE IF NOT EXISTS pedidos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(255) NOT NULL,
      direccion TEXT NOT NULL,
      telefono VARCHAR(20) NOT NULL,
      comentarios TEXT
    );";

    $conexion->query($consulta2);

    function escapar($html) {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    function csrf() {
        session_start();
      
        if (empty($_SESSION['csrf'])) {
          if (function_exists('random_bytes')) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
          } else if (function_exists('mcrypt_create_iv')) {
            $_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
          } else {
            $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
          }
        }
    }
?>