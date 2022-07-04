<?php

require_once "conexion.php";

$conexion=conexion();


$nombre =$_POST['nombrej'];
$anio=$_POST['anioj'];
$precio=$_POST['precioj'];
$empresa=$_POST['empresaj'];

$sql="CALL sp_insertar_datos('$nombre','$anio','$precio','$empresa')";

echo mysqli_query($conexion,$sql);

?>