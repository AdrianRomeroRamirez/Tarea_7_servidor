<?php

require_once('cabecera.php');
require_once('comprobarUsuario.php');

// Se inicia sesion
session_start();

// Se guarda la hora
$_SESSION['visita'] = mktime();

// Si existe una cookie usuario, se guarda ese usuario para la sesión, si no, se crea la sesion con visitante
if (isset($_COOKIE['usuario'])) {
    $_SESSION['usuario'] = $_COOKIE['usuario'];
} else {
    $_SESSION['usuario'] = 'Visitante';
}

// si la sesión es visitante, se crea el boton de login y una cookie con valor visitante
if ($_SESSION['usuario'] == 'Visitante') {
    $botonLogin = '<button id="login" class="my-2 my-lg-0  ml-auto btn btn-primary">Login</button>';
    setcookie('usuario', 'Visitante', time() + 3600);
// Si se ha iniciado sesión con otro usuario, se crea el botón salir
} else {
    $botonSalir = '<button id="botonSalir" class="my-2 my-lg-0  ml-auto btn btn-primary">Salir</button>';
}

// Si pinchas en desbloquear, llama a la función desbloquearnunciantes()
if (isset($_POST['desbloquear'])) {
    if (isset($_POST['usuariosDesblo'])) {
        desbloquearAnunciantes($_POST['usuariosDesblo']);
    }
}

// Si la sesion se ha iniciado con dwes, se muestra una tabla con los bloqueados
if ($_SESSION['usuario'] == 'dwes') {
    $tabla = "<form action=' " . $_SERVER['PHP_SELF'] . "' method='post'> 
                <fieldset >
                    <legend>Usuarios bloqueados</legend>" .
            listaBloqueados() .
            "<input type='submit' class='my-2 my-lg-0  ml-auto btn btn-warning' id='desbloquear' name='desbloquear' value='Desbloquear'>
                </fieldset>
            </form>";
}

$smarty->assign('usuario', $_SESSION['usuario']);
$visita = date('H:i:s', $_SESSION['visita']);
$smarty->assign('visita', $visita);
$smarty->assign('botonLogin', $botonLogin);
$smarty->assign('botonSalir', $botonSalir);
$smarty->assign('tabla', $tabla);

$smarty->display('index.tpl');
