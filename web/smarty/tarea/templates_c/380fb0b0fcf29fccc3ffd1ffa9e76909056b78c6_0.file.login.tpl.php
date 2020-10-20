<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-03 11:54:31
  from '/home/adrian/NetBeansProjects/Tarea7/web/smarty/tarea/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e8707d74d8725_81990164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '380fb0b0fcf29fccc3ffd1ffa9e76909056b78c6' => 
    array (
      0 => '/home/adrian/NetBeansProjects/Tarea7/web/smarty/tarea/templates/login.tpl',
      1 => 1585907667,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e8707d74d8725_81990164 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">
    <head>
        <title>Login</title>

        <!--JQUERY-->
        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"><?php echo '</script'; ?>
>

        <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>

        <!-- Los iconos tipo Solid de Fontawesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
        <?php echo '<script'; ?>
 src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"><?php echo '</script'; ?>
>

        <!-- Nuestro css-->
        <link rel="stylesheet" type="text/css" href="css/index.css" th:href="">

    </head>
    <body>
        <div class="modal-dialog text-center">
            <div class="col-sm-8 main-section">
                <div class="modal-content">
                    <div>
                        <h2 style="color: red;" id="error"></h2>
                    </div>
                    <form class="col-12">
                        <div class="form-group" id="user-group">
                            <input type="text" class="form-control" placeholder="Nombre de usuario" id="username" value=""/>
                        </div>
                        <div class="form-group" id="contrasena-group">
                            <input type="password" class="form-control" placeholder="Contraseña" id="password"/>
                        </div>
                        <button class="btn btn-primary" id="botonIngresar"><i class="fas fa-sign-in-alt"></i>  Ingresar </button>
                        <button class="btn btn-success" id="botonVolver"><i class="fas fa-home"></i>  Volver </button>
                    </form>
                    <div class="col-12 forgot">
                        <a href="#">Recordar contrasena?</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- back-end  -->
        <?php echo '<script'; ?>
 src="funciones.js"><?php echo '</script'; ?>
>
    </body>
</html><?php }
}
