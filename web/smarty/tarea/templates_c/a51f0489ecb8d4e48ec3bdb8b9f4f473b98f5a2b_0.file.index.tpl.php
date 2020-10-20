<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-06 13:41:27
  from '/home/adrian/NetBeansProjects/Tarea7/web/smarty/tarea/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e8b156733a5d4_12885785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a51f0489ecb8d4e48ec3bdb8b9f4f473b98f5a2b' => 
    array (
      0 => '/home/adrian/NetBeansProjects/Tarea7/web/smarty/tarea/templates/index.tpl',
      1 => 1586173284,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e8b156733a5d4_12885785 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Okupa2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
        <?php echo '<script'; ?>
 type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AkNOcfbd_H756A3CbVwhr9ojDQXE_Y6KLQChHusCATl-g0W0CNNyuD3uPc7VeRnN' async defer><?php echo '</script'; ?>
>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Okupa2</a>

            <h3 class="ml-auto mr-auto">Usuario: <?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
 || Hora visita: <?php echo $_smarty_tpl->tpl_vars['visita']->value;?>
</h3>

            <form>
                <?php echo $_smarty_tpl->tpl_vars['botonLogin']->value;?>

                <?php echo $_smarty_tpl->tpl_vars['botonSalir']->value;?>

                <button id="nuevoAnuncio" class="my-2 my-lg-0  ml-auto btn btn-primary">Nuevo anuncio</button>
            </form>

        </nav>

                <div id="map" class="map map-home">
                </div>
                <div id="divBotonCerrarMapa">
                    <button id="cerrarMapa" class="btn btn-danger">Cerrar mapa</button>
                </div>

        <!-- TABLA  -->
        <div>

            <div class="card my-4" id="panel-oculto">
                <div id="container" class="card-body">
                    <?php echo $_smarty_tpl->tpl_vars['tabla']->value;?>

                </div>
            </div>


            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Id Anuncio</th>
                        <th>Autor</th>
                        <th>Moroso</th>
                        <th>Localidad</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Mapa</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody id="anuncios"></tbody>
            </table>
        </div>

        <!-- Script jquery  -->
        <?php echo '<script'; ?>

            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        <?php echo '</script'; ?>
>
        <!-- back-end  -->
        <?php echo '<script'; ?>
 src="funciones.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"><?php echo '</script'; ?>
> 
    </body>
</html><?php }
}
