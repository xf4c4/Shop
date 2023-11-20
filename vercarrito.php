<?php
  session_start();
  require_once "./partials/header.php";
  require_once "./partials/nav.php";
?>


<!-- Main code -->
<main>
<div class="container">
    <?php
        require_once "crud/conexion.php";
        $montoTotal = 0;
        if(empty($_SESSION["listaproductos"])){
            echo "El carrito está vacío";
        }else{
            $lista=unserialize($_SESSION["listaproductos"]);            
            echo "<table class='table table-striped'>";
            echo "<tr><th>Nombre</th><th>Descripción</th><th>Imagen</th><th>Precio</th><th>Borrar producto</th></tr>";
            foreach($lista as $id){                    
                
                //Leo de la base de datos el resto de campos del producto usando el id                    
                $textoSQL="SELECT * FROM PRODUCTOS WHERE id=$id";
                $resultado=$conexion->query($textoSQL);
                $producto=$resultado->fetch_object();
                $montoTotal += $producto->precio;
                //Muestro los datos en el navegador
                echo "<tr><td>" . $producto->nombre . "</td>";
                echo "<td>" . substr($producto->descripcion, 0, 15) . "</td>";
                echo "<td><img src='img/" . $producto->imagen . "' style='height: 100px'>";
                echo "<td>". $producto->precio. "</td>";
                echo "<td><a href='borrarelemento.php?id=$id'>Quitar del carrito</a></td></tr>";
            }
            echo "</table>";
            ?>
            
            <div class="d-flex">
                <a href='borrarcarrito.php' style="margin-right: 800px;">Vaciar carrito</a>
                <form action="pagar.php" method="post">
                    <input type="hidden" name="amount" value="<?= round($montoTotal, 2) ?>">
                    <input class="btn btn-primary" type="submit" value="Pagar <?= round($montoTotal, 2) ?>">
                </form>
            </div>
            

        <?php
        }  
        ?>
</div>
</main>


<?php require_once "./partials/footer.php"; ?> 