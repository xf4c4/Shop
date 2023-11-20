<?php
    if(empty($_GET["id"])){
        echo "No has pasado id de artículo";
    }else{
        require_once "./crud/conexion.php";
        $id=$_GET["id"];
        $textoSQL="SELECT * FROM PRODUCTOS WHERE id=$id";
        $resultado=$conexion->query($textoSQL);
        $producto=$resultado->fetch_object();
    }
    $titulo="Detalle del artículo " . $producto->nombre;
    $activo="Detalle";

    require_once "./partials/header.php";
    include_once "./partials/nav.php";
?>

<main>
    <div class="container">
    <div class="row">
        <div class="col-12">
            <?php
                if(empty($_GET["id"])){
                    echo "No has pasado id de artículo";
                }else{
                    require_once "crud/conexion.php";
                    $id=$_GET["id"];
                    $textoSQL="SELECT * FROM PRODUCTOS WHERE id=$id";
                    $resultado=$conexion->query($textoSQL);
                    $producto=$resultado->fetch_object();
                ?>   
            
                <h1 class="text-center"> <?php echo $producto->nombre;?> </h1>                
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <img class="img-fluid" src="img/<?php echo $producto->imagen ?>">
            </div>
            <div class="col-8">
                <p><?php echo $producto->descripcion ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2 class="text-danger text-center"><?php echo round($producto->precio, 2) ?> €</h2>
                <p class="text-center"><a class="btn btn-primary" href="carrito.php?id=<?php echo $id; ?>">Carrito</a></p>
            </div>
        </div>
        <?php } ?>
    </div>
</main>

<?php include_once "./partials/footer.php"; ?>