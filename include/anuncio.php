<?php

/**
 * Clase para los anuncios
 */

class anuncio {
    
    protected $id_anuncio;
    protected $autor;
    protected $moroso;
    protected $localidad;
    protected $descripcion;
    protected $fecha;
    
    /**
     * Constructor con parametros
     * @param Array $row
     */
    function __construct($row) {
        $this->id_anuncio = $row['id_anuncio'];
        $this->autos = $row['autor'];
        $this->moroso = $row['moroso'];
        $this->localidad = $row['localidad'];
        $this->descripcion = $row['descripcion'];
        $this->fecha = $row['descripcion'];
    }
    
    /*
     * Devuelve el id_anuncio
     */
    function getId_anuncio() {
        return $this->id_anuncio;
    }

    /*
     * Devuelve el autor
     */
    function getAutor() {
        return $this->autor;
    }

    /*
     * Devuelve el moroso
     */
    function getMoroso() {
        return $this->moroso;
    }

    /*
     * Devuelve la localidad
     */
    function getLocalidad() {
        return $this->localidad;
    }

    /*
     * Devuelve la descripcion
     */
    function getDescripcion() {
        return $this->descripcion;
    }

    /*
     * Devuelve la fecha
     */
    function getFecha() {
        return $this->fecha;
    }
    
} 