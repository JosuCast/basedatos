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
           
            <li class="c-menu__item is-active" data-toggle="tooltip" title="CRUD - Peliculas" onclick="Videojuegos()">
              <div class="c-menu__item__inner"><i class="far fa-chart-bar"></i>
                <div class="c-menu-item__title"><span>CRUD - Juegos</span></div>
              </div>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="CRUD - Productos" onclick="Productos()">
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
  <body>
  <?php require_once "dependencias.php"; ?>
	<div class="container">
		<br>
		<h1>CRUD con store procedures y Php</h1>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div id="tablastores"></div>
			</div>
		</div>
	</div>


  <!--************************************************* agregar datosmodal ***********************************************-->
  <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo juego</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmAgrega">
        		<label>Nombre</label>
        		<input type="text" class="form-control form-control-sm" name="nombrej" id="nombrej">
        		<label>Fecha de estreno</label>
        		<input type="text" class="form-control form-control-sm" name="anioj" id="anioj">
            <label>Precio</label>
        		<input type="text" class="form-control form-control-sm" name="precioj" id="precioj">
        		<label>Empresa</label>
        		<input type="text" class="form-control form-control-sm" name="empresaj" id="empresaj">
        	</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-raised btn-primary" id="btnAgregarJuego">Agregar</button>
        </div>
      </div>
    </div>
  </div>
  <!--************************************************* agregar datosmodal ***********************************************-->


  <!--************************************************* updatemodal ***********************************************-->
  <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Actualiza Juego</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmactualiza">
            <input type="text" hidden="" name="id_juego" id="id_juego">
            <label>Nombre</label>
            <input type="text" class="form-control form-control-sm" name="nombrejU" id="nombrejU">
            <label>Fecha de estreno</label>
            <input type="text" class="form-control form-control-sm" name="aniojU" id="aniojU">
            <label>Precio</label>
        		<input type="text" class="form-control form-control-sm" name="preciojU" id="preciojU">
            <label>Empresa</label>
            <input type="text" class="form-control form-control-sm" name="empresajU" id="empresajU">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-raised btn-warning" id="btnactualizar">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
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
  <script type="text/javascript">
	$(document).ready(function(){
		$('#tablastores').load('tabla.php');

    $('#btnAgregarJuego').click(function(){
      if(validarFormVacio('frmAgrega') > 0){
        alertify.alert("Debes llenar todos los campos por favor!");
        return false;
      }

      datos=$('#frmAgrega').serialize();

      $.ajax({
        type:"POST",
        data:datos,
        url:"php/insertar.php",
        success:function(r){
          if(r==1){
           $('#frmAgrega')[0].reset();
           $('#tablastores').load('tabla.php');
           alertify.success("Agregado con exito :)");
         }else{
          alertify.error("No se pudo agregar :(");
        }
      }
    });
    });


  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnactualizar').click(function(){

      datos=$('#frmactualiza').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"php/actualizar.php",
          success:function(r){
            if(r==1){
             $('#tablastores').load('tabla.php');
               alertify.success("Actualizado con exito :)");
            }else{
               alertify.error("No se pudo actualizar :(");
            }
           }
        });
    });
  });
</script>

<script type="text/javascript">

  function obtenDatos(idjuego){
    $.ajax({
      type:"POST",
      data:"idjuego=" + idjuego,
      url:"php/obtenerRegistro.php",
      success:function(r){
        datos=jQuery.parseJSON(r);

        $('#id_juego').val(datos['id_juego']);
        $('#nombrejU').val(datos['nombrejU']);
        $('#aniojU').val(datos['aniojU']);
        $('#preciojU').val(datos['preciojU']);
        $('#empresajU').val(datos['empresajU']);
      }
    });
  }

  
  function validarFormVacio(formulario){
    datos=$('#' + formulario).serialize();
    d=datos.split('&');
    vacios=0;
    for(i=0;i< d.length;i++){
      controles=d[i].split("=");
      if(controles[1]=="A" || controles[1]==""){
        vacios++;
      }
    }
    return vacios;
  }

  function elimina(idjuego){
      alertify.confirm('Eliminar juego', '¿Desea eliminar este registro?', 
              function(){ 
                  $.ajax({
                     type:"POST",
                      data:"idjuego=" + idjuego,
                      url:"php/eliminar.php",
                      success:function(r){
                          if(r==1){     
                              $('#tablastores').load('tabla.php');
                              alertify.success("Eliminado con exito :)");
                          }else{
                               alertify.error("No se pudo eliminar :(");
                          }
                      }
                  });
              }
              ,function(){ 
                alertify.error('Cancelo')
              });
  }

</script>

		  </body>
</html>