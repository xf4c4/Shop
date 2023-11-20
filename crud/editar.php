<?php
    include "conexion.php";    

    //Cuando mostramos la página con el formulario y los datos del alumno
    if (!isset($_GET['id'])) { //Si no nos pasan el id del alumno        
        echo "El producto no existe";        
    }else{
        $id = $_GET['id'];
        $consultaSQL = "SELECT * FROM productos WHERE id =" . $id;    
        $sentencia = $conexion->query($consultaSQL);            
        $producto=$sentencia->fetch_object();    
        if ($producto) {            
            $nombre = $producto->nombre;
            $descripcion = $producto->descripcion;
            $precio = $producto->precio;            
            $imagen = $producto->imagen;            
        }else{            
            echo 'No se ha encontrado el producto';
        }
        
    }
    
    //Cuando nos envían los datos del alumno desde el formulario y tenemos que actualizarlo
    if (isset($_POST['submit'])) {    
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];        
        $precio = $_POST['precio'];

        //Aquí el tratamiento de la imagen es un poco más complicado. 
        //Si no pasan nombre de fichero, mantenemos la que había. Si pasan nombre, subimos el nuevo fichero        
        if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name']!=""){  //Si nos pasan un nuevo fichero
          $imagen = date("Y-m-d - H-i-s")."-".$_FILES['imagen']['name'];             
          $file_loc = $_FILES['imagen']['tmp_name'];
          move_uploaded_file($file_loc,"uploads/".$imagen); 
          $consultaSQL = "UPDATE productos SET  nombre = '$nombre', descripcion = '$descripcion', edad = $precio, ";
          $consultaSQL .= "imagen = '$imagen', updated_at = NOW() WHERE id = $id";  
        }else{
          //NO nos han pasado fichero, no tenemos que modificarlo, en la consulta no añadimos imagen
          $consultaSQL = "UPDATE productos SET  nombre = '$nombre', descripcion='$descripcion',  precio = $precio, ";
          $consultaSQL .= "updated_at = NOW() WHERE id = $id";
        }        
        $consulta = $conexion->query($consultaSQL);        
        header("Status: 301 Moved Permanently");
        header("Location: index.php");
        exit;
    }    
?>

<?php require "templates/header.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-4">Editando el producto: <?= escapar($nombre) ?></h2>
        <hr>
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?= escapar($nombre) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control"> <?= escapar($descripcion) ?></textarea>
          </div>          
          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" step="any" name="precio" id="precio" value="<?= escapar($precio) ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
          </div>
          <?php
            //Si tiene imagen la mostramos
            if($imagen!=""){
              $ruta="/shop/img";
              echo "<br><img src= '$ruta/$imagen' style='width: 100px'><br>";
            }
          ?>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="Actualizar">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php require "templates/footer.php"; ?>