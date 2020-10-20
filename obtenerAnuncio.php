<?php

include('include/DB.php');

$id_anuncio = $_POST['id_anuncio'];

// hace la busuqeda a la base de datos y la devuleve
try {
    $con = DB::conexionBD();
    $query = 'SELECT * from anuncios WHERE id_anuncio = ?';
    $result = $con->prepare($query);
    $result->bindParam(1, $id_anuncio);
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

    $arrayString = json_encode($array);
    echo $arrayString;
} catch (Exception $e) { // Se controla las excepciones
    die('Error al obtener el producto.');
}