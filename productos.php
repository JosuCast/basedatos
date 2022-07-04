<?php
  session_start();

  if(!isset($_SESSION['loggedin'])){
    header('refresh:2;url=index.php');
    exit();
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style/home.css" rel="stylesheet" type="text/css">
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://use.fontawesome.com/releases/v5.0.8/js/all.js'></script>		</head>
	</head>
  <body class="sidebar-is-reduced">
    <header class="l-header">
      <div class="l-header__inner clearfix">
        <div class="c-header-icon js-hamburger">
          <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
        </div>
        <div class="c-header-icon has-dropdown"><span class="c-badge c-badge--red c-badge--header-icon animated swing">13</span><i class="fa fa-bell"></i>
          <div class="c-dropdown c-dropdown--notifications">
            <div class="c-dropdown__header"></div>
            <div class="c-dropdown__content"></div>
          </div>
        </div>
        <div class="c-search">
          <input class="c-search__input u-input" placeholder="Search..." type="text"/>
        </div>
        <div class="header-icons-group">
          <div class="c-header-icon basket"><span class="c-badge c-badge--blue c-badge--header-icon animated swing">4</span><i class="fa fa-shopping-basket"></i></div>
          <div class="c-header-icon logout"><a href="logout.php"><i class="fa fa-power-off"></i></a></div>
        </div>
      </div>
    </header>
    <div class="l-sidebar">
      <div class="logo">
        <div class="logo__txt">D</div>
      </div>
      <div class="l-sidebar__content">
        <nav class="c-menu js-menu">
          <ul class="u-list">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Inicio" onclick="Home()">
              <div class="c-menu__item__inner"><i class="fa fa-plane"></i>
                <div class="c-menu-item__title"><span>Inicio</span></div>
              </div>
            </li>
           
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="CRUD - Peliculas" onclick="Videojuegos()">
              <div class="c-menu__item__inner"><i class="far fa-chart-bar"></i>
                <div class="c-menu-item__title"><span>CRUD - Juegos</span></div>
              </div>
            </li>
            <li class="c-menu__item is-active" data-toggle="tooltip" title="CRUD - Productos" onclick="Productos()">
              <div class="c-menu__item__inner"><i class="fa fa-gift"></i>
                <div class="c-menu-item__title" ><span>CRUD - Productos</span></div>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </body>
  <main class="l-main">
  
<?php
    require_once "./clases/Conexion.php";
    require_once "./clases/Crud.php";
    $crud = new Crud();
    $datos = $crud->monstrarDatos();

?>


<?php include "./header.php"; ?>




    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                <h2>Crud - MongoDB</h2>
                <a href="./agregar.php" class="btn btn-raised btn-primary btn-lg"><span class="fa fa-plus-circle"></span> Agregar nuevo</a>
                <hr>
                <table class="table table-sm table-hover table-bordered table-dark">
                <thead>
                    <th style="text-align: center;">Id producto</th>
                    <th style="text-align: center;">Nombre del producto</th>
                    <th style="text-align: center;">Stock</th>
                    <th style="text-align: center;">Precio</th>
                    <th style="text-align: center;">Disponible</th>
                    <th style="text-align: center;">Editar</th>
                    <th style="text-align: center;">Eliminar</th>
                </thead>
                    <tbody>
                    <?php
                        foreach($datos as $item){

                    ?>
                        <tr>
                            <td style="text-align: center;" id="_id"><?php echo $item->_id; ?></td>
                            <td style="text-align: center;"><?php echo $item->nombre; ?></td>
                            <td style="text-align: center;"><?php echo $item->stock; ?></td>
                            <td style="text-align: center;"><?php echo $item->precio; ?></td>
                            <td style="text-align: center;"><?php echo $item->disponible; ?></td>
                            <td style="text-align: center;">
                            <form action="" method="post">
                                <a class="btn btn-raised btn-warning btn-xs" href="./actualizar.php?_id=<?php echo $item->_id; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                            </form>
                            </td>

                            <td style="text-align: center;">
                            <form action="" method="post">
                                <a class="btn btn-raised btn-danger btn-xs" href="./procesos/eliminar.php?_id=<?php echo $item->_id; ?>"><i class="fa fa-trash"></i> Eliminar</a>
                            </form></td>
                        </tr>
                            <?php
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


<?php include "./scripts.php"; ?>



  </main>
  <!-- partial -->
   
  <script>
      let Dashboard = (() => {
  let global = {
    tooltipOptions: {
      placement: "right" },

    menuClass: ".c-menu" };


  let menuChangeActive = el => {
    let hasSubmenu = $(el).hasClass("has-submenu");
    $(global.menuClass + " .is-active").removeClass("is-active");
    $(el).addClass("is-active");

    // if (hasSubmenu) {
    // 	$(el).find("ul").slideDown();
    // }
  };

  let sidebarChangeWidth = () => {
    let $menuItemsTitle = $("li .menu-item__title");

    $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
    $(".hamburger-toggle").toggleClass("is-opened");

    if ($("body").hasClass("sidebar-is-expanded")) {
      $('[data-toggle="tooltip"]').tooltip("destroy");
    } else {
      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }

  };

  return {
    init: () => {
      $(".js-hamburger").on("click", sidebarChangeWidth);

      $(".js-menu li").on("click", e => {
        menuChangeActive(e.currentTarget);
      });

      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    } };

})();
    function Home(){
        location.href = "home.php";
    }
  function Productos(){
    location.href = "productos.php";
  }
  function Videojuegos(){
    location.href = "videojuegos.php";
  }
  function Redirect(){
    location.href = "logout.php";
  }
Dashboard.init();
  </script>

		  </body>
</html>