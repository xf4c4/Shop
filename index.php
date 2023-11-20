<!-- Add header -->
<?php include_once "./partials/header.php"; ?>
<!-- Add navbar -->
<?php include_once "./partials/nav.php"; ?>


<!-- Main code -->
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Tienda de camisetas</h1>
                <h3>Camisetas artesanales y buena calidad<h3>
                <br>
            </div>
        </div>
        <div class="row">
            <?php
            require_once "crud/conexion.php";
            $consulta_sql="SELECT * FROM productos";
            $resultado=$conexion->query($consulta_sql);
            while($fila = $resultado->fetch_object()){
            ?>
            <div class="col mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="img/<?php echo $fila->imagen ?>" class="card-img-top" alt="..." style="width: 100%; height: 300px">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fila->nombre; ?></h5>
                            <p class="card-text"><?php echo $fila->descripcion ?></p>
                            <p class="card-text text-danger"><?php echo round($fila->precio, 2) ?></p>
                            <a href="detalle.php?id=<?php echo $fila->id; ?>" class="btn btn-primary">Ver detalle</a>
                        </div>                        
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</main>


<!-- Add footer -->
<?php include_once "./partials/footer.php"; ?>