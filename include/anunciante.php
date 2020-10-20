<?php

/**
 * Clase para los anunciantes
 */

class anunciante {
    
    protected $login;
    protected $password;
    protected $email;
    protected $bloqueado;
    
    /**
     * Constructor con parametros
     * @param Array $row
     */
    function __construct($row) {
        $this->login = $row['login'];
        $this->password = $row['password'];
        $this->email = $row['email'];
        $this->bloqueado = $row['bloqueado'];
    }
    
    /*
     * Devuelve el login
     */
    function getLogin() {
        return $this->login;
    }

    /*
     * Devuelve el password
     */
    function getPassword() {
        return $this->password;
    }

    /*
     * Devuelve el email
     */
    function getEmail() {
        return $this->email;
    }

    /*
     * devuelve el bloqueado
     */
    function getBloqueado() {
        return $this->bloqueado;
    }

    
}