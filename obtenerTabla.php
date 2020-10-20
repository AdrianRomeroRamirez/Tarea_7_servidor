<?php

// Archivo que devuelve la lista de anuncios

include('include/DB.php');
try {
    $con = DB::conexionBD();
    $query = 'SELECT * from anuncios';
    $result = $con->prepare($query);
    $result->execute();
    $array = array();
    while ($row = $result->fetch()) {
        $array[] = array(
            'id_anuncio' => $row['id_anuncio'],
            'autor' => $row['autor'],
            'moroso' => $row['moroso'],
            'localidad' => $row['localidad'],
            'descripcion' => $row['descripcion'],
            'fecha' => $row['fecha']
        );
    }

    $booleanString = json_encode($array);
    echo $booleanString;
} catch (Exception $e) { // Se controla las excepciones
    die('Error en la lista de productos.');
}