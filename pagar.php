<?php include_once "./partials/header.php"; ?>
<?php include_once "./partials/nav.php"; ?>
<?php 
 if(isset($_POST["amount"])) {
    $total = $_POST["amount"];
 }
?>

<!-- Main code -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Formulario de Pago contra Reembolso</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="procesarpedido.php">
                        <div class="form-group">
                            <label for="nombre">Nombre completo:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección de envío:</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono de contacto:</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="comentarios">Comentarios adicionales:</label>
                            <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-success btn-block">Procesar Pedido</button>
                            <p style="margin-left: 200px; color:red">Total: <?= $total ?> €</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add footer -->
<?php include_once "./partials/footer.php"; ?>