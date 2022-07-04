<?php

    include "../clases/conexion.php";
    include "../clases/crud.php";

    $Crud = new Crud();

    $datos = array(
        "_id"=> $_POST['id'],
        "nombre" => $_POST['nombre'],
        "stock" => $_POST['stock'],
        "precio" => $_POST['precio'],
        "disponible" => $_POST['disponible']
    );

    $respuesta = $Crud->insertarDatos($datos);

    if($respuesta->getInsertedId() > 0){
        header("location: ../productos.php");
    }else{
        print_r($respuesta);
    }
?>