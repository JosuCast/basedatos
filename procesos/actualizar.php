<?php

include "../clases/conexion.php";
include "../clases/crud.php";

$Crud = new Crud();

$parametros = array(
    '_id'=> $_GET['_id']
);
$datos = array(
    "nombre" => $_POST['nombre'],
    "stock" => $_POST['stock'],
    "precio" => $_POST['precio'],
    "disponible" => $_POST['disponible']
);

$respuesta = $Crud->actualizarDatos($parametros,$datos);

header("location: ../productos.php");

?>