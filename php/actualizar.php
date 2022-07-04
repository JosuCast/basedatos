<?php

require_once "conexion.php";

$conexion=conexion();

$id_juego=$_POST['id_juego'];
$nombre =$_POST['nombrejU'];
$anio=$_POST['aniojU'];
$precio=$_POST['preciojU'];
$empresa=$_POST['empresajU'];

$sql="CALL sp_actualizar_datos('$nombre','$anio','$precio','$empresa','$id_juego')";

echo mysqli_query($conexion,$sql);

?>