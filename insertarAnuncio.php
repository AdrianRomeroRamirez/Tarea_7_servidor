<?php

/*
 * Archivo para insertar un anuncio con datos pasados por post
 */

require_once('include/DB.php');

try {
    
    $autor = $_POST['datos']['autor'];
    $moroso = $_POST['datos']['moroso'];
    $localidad = $_POST['datos']['localidad'];
    $descripcion = $_POST['datos']['descripcion'];
    $fecha = $_POST['datos']['fecha'];
    
    // Se guarda la consulta
    $sql = "INSERT INTO `anuncios` (`autor`, `moroso`, `localidad`, `descripcion`, `fecha`)"
            . " VALUES (?, ?, ?, ?, ?);";
    // Se crea la conexión
    $con = DB::conexionBD();
    // Se prepara la consulta en la conexión
    $consulta = $con->prepare($sql);
    // Se introducen los parametros
    $consulta->bindParam(1, $autor);
    $consulta->bindParam(2, $moroso);
    $consulta->bindParam(3, $localidad);
    $consulta->bindParam(4, $descripcion);
    $consulta->bindParam(5, $fecha);
    // Se ejecuta
    $consulta->execute();
} catch (Exception $e) { // Se controla las excepciones
    die('Erro de conexión');
}