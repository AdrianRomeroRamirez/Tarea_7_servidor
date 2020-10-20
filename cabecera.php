<?php

/*
 * Cabecera con declaraciones comunes para no llenar demasiado los otros archivos
 */

require_once('include/DB.php');
require_once('libs/Smarty.class.php');

$smarty = new Smarty();

$smarty->setTemplateDir('./web/smarty/tarea/templates/');
$smarty->setCompileDir('./web/smarty/tarea/templates_c/');
$smarty->setConfigDir('./web/smarty/tarea/configs/');
$smarty->setCacheDir('./web/smarty/tarea/cache/');

$botonLogin = '';
$botonSalir = '';
$tabla = '';