<?php
    session_start();
    $_SESSION["listaproductos"]=[];
    header("location: vercarrito.php");