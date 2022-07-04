<?php
  session_start();

  if(!isset($_SESSION['loggedin'])){
    header('refresh:2;url=index.php');
    exit();
  }

?>
<?php include "./header.php"; ?>

<div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                        <a href="productos.php" class="btn btn-outline-info"><i class="fa-solid fa-angles-left"></i> Regresar</a>
                        <h2>Agregar nuevo producto</h2>
                <form action="./procesos/insertar.php" method="post">
                    <label for="nombre">ID</label>
                    <input type="text" class="form-control" id="id" name="id" required>
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" required>
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name="precio" required>
                    <label for="disponible">Disponible</label>
                    <input type="text" class="form-control" id="disponible" name="disponible" required>
                    <button class="btn btn-primary mt-3"><i class="fa-solid fa-floppy-disk"></i> Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php include "./scripts.php"; ?>