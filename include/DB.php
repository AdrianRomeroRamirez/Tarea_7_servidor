<?php

/**
 * Clase para la conexión a la base de datos
 */

class DB {
    
    /**
     * Función que devuelve la conexión a la base de datos
     * @return \PDO conexión a la abse de datos
     */
    function conexionBD() {
        try {
            // Array con opciones
            $arrOptions = array(
                PDO::ATTR_EMULATE_PREPARES => FALSE,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            );
            // se crea la conexión
            $con = new PDO('mysql:host=localhost;dbname=morosos', 'dwes', 'abc123.', $arrOptions);
        } catch (Exception $e) { // Se controla las excepciones
            die('Erro de conexión');
        }
        // Se devuelve la conexión
        return $con;
    }
    
}