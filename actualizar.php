<?php
  session_start();

  if(!isset($_SESSION['loggedin'])){
    header('refresh:2;url=index.php');
    exit();
  }

?>
<?php include "./header.php";
    require_once "./clases/Conexion.php";
    require_once "./clases/Crud.php";
$crud = new Crud();
$dato = array(
    '_id'=>$_GET['_id']
);
$datos = $crud->find($dato);
?>

<div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                        <a href="index.php" class="btn btn-outline-info"><i class="fa-solid fa-angles-left"></i> Regresar</a>
                        <h2>Actualizar producto</h2>
                        <?php
                        foreach($datos as $item):

                        ?>
                <form action="./procesos/actualizar.php?_id=<?php echo $item->_id; ?>" method="post">
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $item->nombre; ?>">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $item->stock; ?>">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $item->precio; ?>">
                    <label for="disponible">Disponible</label>
                    <input type="text" class="form-control" id="disponible" name="disponible" value="<?php echo $item->disponible; ?>">
                    <button class="btn btn-warning mt-3"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
                </form>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
</div>


<?php include "./scripts.php"; ?>