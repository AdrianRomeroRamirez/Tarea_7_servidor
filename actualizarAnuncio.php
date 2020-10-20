<?php

include('include/DB.php');

/*
 * Recoge los valores mandados por post para actualizar el anuncio en la base de datos.
 */

$id_anuncio = $_POST['datos']['id_anuncio'];
$nuevoMoroso = $_POST['datos']['nuevoMoroso'];
$nuevaLocalidad = $_POST['datos']['nuevaLocalidad'];
$nuevaDescripcio = $_POST['datos']['nuevaDescripcion'];
$nuevaFecha = $_POST['datos']['nuevaFecha'];

try {
    $con = DB::conexionBD();
    $query = "UPDATE `anuncios` SET `moroso` = ?, `localidad` = ?, `descripcion` = ?, `fecha` = ? WHERE `anuncios`.`id_anuncio` = ?";
    $result = $con->prepare($query);
    $result->bindParam(1, $nuevoMoroso);
    $result->bindParam(2, $nuevaLocalidad);
    $result->bindParam(3, $nuevaDescripcio);
    $result->bindParam(4, $nuevaFecha);
    $result->bindParam(5, $id_anuncio);
    $result->execute();

    echo 'Actualizado';

    if (!$result) {
        die('Error en la actualización de stock.');
    }
} catch (Exception $e) { // Se controla las excepciones
    die('Erro de conexión');
}
