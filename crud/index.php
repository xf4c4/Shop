<?php
/*Diferenciar entre SCRIPT y enlaces
$_SERVER['DOCUMENT_ROOT'] . "/carpeta";
__DIR__
__FILE__
$config_path = __DIR__.'/../config/settings.php';
require $config_path;*/

    include "conexion.php";
    include "templates/header.php"; 

    csrf();
    if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
        die();
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex">
                <a href="crear.php"  class="btn btn-primary m-2">Crear producto</a>
                <a href="/shop/"  class="btn btn-primary m-2">Ir a Home</a>
                <hr>
            </div>            
        </div>
        <div class="container">
            <div class="row">
                <form action="" method="post" class="form-inline">
                    <div class="form-group mr-3">
                        <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre de producto" class="form-control">
                    </div>
                    <input name="csrf" type="hidden" value="<?php echo escapar($_SESSION['csrf']); ?>">
                    <button style="margin-top: 15px;" type="submit" name="submit" class="btn btn-primary">Ver resultados</button>
                </form>                
            </div>
        </div>
        <?php            
            if (isset($_POST['nombre']) ) {
                $nombre=$_POST['nombre'];
                $consultaSQL = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%'";
                $titulo = ($nombre!="") ? "Lista de productos con nombre $nombre" : 'Lista de productos';
            } else {
                $consultaSQL = "SELECT * FROM productos";
                $titulo = 'Lista de productos';
            }   
            
            echo "<h1 class='mt-3'>$titulo</h1>";
        ?>        
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
        <?php                 
                 
            $consulta=$conexion->query($consultaSQL);    
            while($elemento=$consulta->fetch_object()){  
                $id=$elemento->id;
                $nombre=$elemento->nombre;
                $descripcion=$elemento->descripcion;
                $precio=$elemento->precio;
                $imagen=$elemento->imagen;
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$nombre</td>";
                $aux=strlen($descripcion)>15 ? substr($descripcion, 0, 15) . "..." : $descripcion;
                echo "<td>$aux</td>";
                echo "<td>$precio</td>";                
                echo "<td><img src='/shop/img/$imagen' style='height: 100px'></td>";
                //echo "<td><a href='borrar.php?id=$id ?'>🗑️Borrar</a>";
                echo "<td><form action='borrar.php?id=$id' method='post' onSubmit='return confirm(\"Seguro?\")'><input type='submit' value='borrar'></form>";
                echo "<a href='editar.php?id=$id'>✏️Editar</a></td>";
                echo "</tr>";
            }
        ?>
            </tbody>
        </table>
    </div>   
<?php 
    include "templates/footer.php"; 
?>
