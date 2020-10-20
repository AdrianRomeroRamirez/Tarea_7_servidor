<?php

// Archivo para eliminar un anuncio

include('include/DB.php');

$id_anuncio = $_POST['id_anuncio'];

// Si recibe datos del codigo, borra el anuncio
if (!empty($id_anuncio)) {
    try {
        $con = DB::conexionBD();
        $query = "DELETE FROM anuncios WHERE id_anuncio = ?";
        $result = $con->prepare($query);
        $result->bindParam(1, $id_anuncio);
        $result->execute();

        if (!$result) {
            die('Error al eliminar el producto.');
        }

        echo 'Producto eliminado correctamente';
    } catch (Exception $e) { // Se controla las excepciones
        die('Erro de conexión');
    }
}