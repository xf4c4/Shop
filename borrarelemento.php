<?php
    session_start();
    if(empty($_GET["id"])){

    }else{
        //Leo el id que me pasan como parámetro
        $id=$_GET["id"];
        //Recupero el carrito de la variable session
        $lista=unserialize($_SESSION["listaproductos"]);
        //Uso un contador para saber en la posición del array en la que me encuentro
        $contador=0;        
        //Recorro la lista con los productos del carrito
        foreach($lista as $idlista){
            //Si el id del carrito coincide con la lista, lo elimino            
            if($id==$idlista){
                echo "entra";
                array_splice($lista, $contador);
            }
            $contador++;
        }
        var_dump($lista);
    
        //Guardo la lista modificada en la variable de sesión
        $_SESSION["listaproductos"]=serialize($lista);
        
        
    }
    //Redirijo a la página que muestra el carrito
    header("location: vercarrito.php");