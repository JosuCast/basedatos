<?php

    include "../clases/conexion.php";
    include "../clases/crud.php";

    $Crud = new Crud();

    $datos = array(
        '_id'=>$_GET['_id']
    );


    $respuesta = $Crud->eliminarDatos($datos);

    header("location: ../productos.php");


?>