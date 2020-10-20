<?php

/*
 * Comprueba si el usuario y la contraseña corresponden
 */

require_once('include/DB.php');

if (isset($_POST['datos'])) {
    $usuario = $_POST['datos']['usuario'];
    $password = $_POST['datos']['password'];
}

if (!empty($usuario) && !empty($password)) {
    $usuarioEncontrado = 'false';
    try {
        // Si es el usuario admin, devuelve dwes
        if ($usuario == 'dwes' && $password == 'abc123.') {
            $usuarioEncontrado = 'dwes';
        } else {
            $con = DB::conexionBD();
            $query = "SELECT login, password FROM anunciantes WHERE login = ?";
            $result = $con->prepare($query);
            $result->bindParam(1, $usuario);
            $result->execute();

            if ($registro = $result->fetch()) {
                if (!ComprobarBloqueo($usuario)) {
                    // Si coincide, devuelve true y borra los intentos fallidos
                    if ($registro['login'] == $usuario && password_verify($password, $registro['password'])) {

                        borrarIntentosFallidos($usuario);
                        $usuarioEncontrado = 'true';
                    // Si no coincide, se suma un intento fallido
                    } else {
                        if ($usuario != "dwes") {
                            sumarIntentoFallido($usuario);
                        }
                    }
                // si está bloqueado, devuelve bloqueado
                } else {
                    $usuarioEncontrado = 'bloqueado';
                }
            }
            // Se cierra la consulta
            $result->closeCursor();
        }


        echo $usuarioEncontrado;
    } catch (Exception $e) { // Se controla las excepciones
        die('Erro de conexión');
    }
}

/*
 * Borra todos los intentos fallidos
 */
function borrarIntentosFallidos($usuario) {
    try {
        // Se guarda la consulta
        $sql = "UPDATE anunciantes SET bloqueado = 0 WHERE login = ?";
        // Se crea la conexión
        $con = DB::conexionBD();
        // Se prepara la consulta en la conexión
        $consulta = $con->prepare($sql);
        // Se introducen los parametros
        $consulta->bindParam(1, $usuario);
        // Se ejecuta
        $consulta->execute();
    } catch (Exception $e) {
        die('Erro de conexión');
    }
}

/*
 * Suma un intento fallido
 */
function sumarIntentoFallido($usuario) {
    try {
        // Se guarda la consulta
        $sql = "UPDATE anunciantes SET bloqueado = bloqueado + 1 WHERE login = ?";
        // Se crea la conexión
        $con = DB::conexionBD();
        // Se prepara la consulta en la conexión
        $consulta = $con->prepare($sql);
        // Se introducen los parametros
        $consulta->bindParam(1, $usuario);
        // Se ejecuta
        $consulta->execute();
    } catch (Exception $e) {
        die('Erro de conexión');
    }
}

// Comprueba si está bloqueado el usuario
function ComprobarBloqueo($usuario) {
    $bloqueado = false;
    // Se guarda la consulta
    $sql = "SELECT bloqueado FROM anunciantes WHERE login = ?";
    // se crea la conexión
    $con = DB::conexionBD();
    // Se prepara la consulta
    $resultado = $con->prepare($sql);
    // Se ejecuta
    $resultado->execute(array($usuario));
    if ($registro = $resultado->fetch()) {
        // Si tiene 3 intentos fallidos, está bloqueado
        if ($registro['bloqueado'] >= 3) {
            $bloqueado = true;
        }
    }
    return $bloqueado;
}

/*
 * Crea una lista de bloqueados
 */
function listaBloqueados() {
    // Se guarda la consulta
    $sql = "SELECT login, bloqueado FROM anunciantes WHERE bloqueado = 3";
    // se crea la conexión
    $con = DB::conexionBD();
    // Se prepara la consulta
    $resultado = $con->prepare($sql);
    // Se ejecuta
    $resultado->execute();
    $template = '';
    // se crea un checkbox con todos los bloqueados
    while ($registro = $resultado->fetch()) {
        $template .= "<label><input type='checkbox' name='usuariosDesblo[]' value='" . $registro['login'] . "'><p>" . $registro['login'] . "</p></input></label>";
    }
    return $template;
}

/*
 * Llama a borrarIntentos por cada usuario pasado en el array
 */
function desbloquearAnunciantes($anunciantes) {
    // Por cada registro de la lista, se le aplica la función borrarIntentosFallidos()
    foreach ($anunciantes as $login) {
        borrarIntentosFallidos($login);
    }
}
