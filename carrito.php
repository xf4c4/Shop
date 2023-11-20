<?php
    session_start();
    if(empty($_GET["id"])){

    }else{
        $id=$_GET["id"];
        if(empty($_SESSION["listaproductos"])){
            $lista=[$id];
            //$lista=[["id"=> $id, "cantidad"=> 1]];
            $_SESSION["listaproductos"]=serialize($lista);
        }else{
            //Recupero la lista de artículos en el carrito y la "deserializo"
            $lista=unserialize($_SESSION["listaproductos"]);            
            //Añado el nuevo id a la lista.
            $lista[]=$id;
            //$lista[]=["id"=> $id, "cantidad"=> 1];            
            $_SESSION["listaproductos"]=serialize($lista);            
        }
    }
    $url=$_SERVER['HTTP_REFERER'];
    header("location: " . $url);
    //header("location: detalle.php?id=" . $id);