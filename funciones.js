
$(document).ready(function () {
    obtenerLista(); // Obtiene la lista de anuncios
    $('#divBotonCerrarMapa').hide(); // Esconde el botón de cerrar mapa

    /*
     * Se obtiene la lista de todos los anuncios
     */
    function obtenerLista() {
        $.ajax({
            url: 'obtenerTabla.php',
            type: 'GET',
            success: function (response) {
                const anuncios = JSON.parse(response);
                let template = '';
                anuncios.forEach(anuncio => {
                    template += `
                <tr codPro="${anuncio.id_anuncio}">
                    <td>${anuncio.id_anuncio}</td>
                    <td>${anuncio.autor}</td>
                    <td>${anuncio.moroso}</td>
                    <td>${anuncio.localidad}</td>
                    <td>${anuncio.descripcion}</td>
                    <td>${anuncio.fecha}</td>
                    <td><button id='mapa'>Mapa</button></td>
                    `;
                    if (anuncio.autor == obtenerCookie('usuario')) {
                        template += `
                    <td>
                        <button id_anuncio='` + anuncio.id_anuncio + `' id='botonActualizar'>
                            <img src='img/edit.svg' alt='Actualizar' height='30' width='30'>
                        </button>
                    </td>
                    <td>
                        <button id_anuncio='` + anuncio.id_anuncio + `' id='botonEliminar'>
                            <img src='img/delete.png' alt='Eliminar' height='30' width='30'>
                        </button>
                    </td>
                </tr>
                `;
                    }
                });
                $('#anuncios').html(template);
            }
        });
    }

    /*
     * Se obtiene la cookie culla clave se pasa
     */
    function obtenerCookie(clave) {
        var name = clave + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ')
                c = c.substring(1);
            if (c.indexOf(name) == 0)
                return c.substring(name.length, c.length);
        }
        return "";
    }

    /*
     * Se crea una cookie con los valores recibidos
     */
    function crearCookie(clave, valor, diasexpiracion) {
        var d = new Date();
        d.setTime(d.getTime() + (diasexpiracion * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = clave + "=" + valor + "; " + expires;
    }

    /*
     * Al pinchar nuevo anuncio, si estas en la sesión de visitante, te lleva a login
     * y si estas logueado te muestra el formulario
     */
    $(document).on('click', '#nuevoAnuncio', (e) => {
        e.preventDefault();
        var usuario = obtenerCookie('usuario');
        if (usuario == 'Visitante' || usuario == 'dwes') {
            window.location = "login.php";
        } else {
            let template = `
        <form id='insertarAnuncio'>
            <label for='autor'>Autor</label>
            <input id='autor' type='text' value='` + usuario + `' placeholder='Autor' readonly>
            <label for='moroso'>Moroso</label>
            <input id='moroso' type='text' value='' placeholder='Moroso'>
            <label for='localidad'>Localidad</label>
            <input id='localidad' type='text' value='' placeholder='Localidad'>
            <label for='descripcion'>Descripcion</label>
            <input id='descripcion' type='text' value='' placeholder='Descripcion'>
            <label for='fecha'>Fecha</label>
            <input id='fecha' type='date' value=''>
            <button id='confirmarInsercion' class='ml-2 btn btn-primary'>
                Insertar
            </button>
        </form>
        `;
            $('#container').html(template);
        }
    });

    // Si se pulsa el botón de confirmar inserccion, se validan los datos y si está todo correcto,
    // se insertan el nuevo anuncio en la base de datos.
    $(document).on('click', '#confirmarInsercion', (e) => {
        e.preventDefault();
        const autor = $('#autor').val();
        const moroso = $('#moroso').val();
        const localidad = $('#localidad').val();
        const descripcion = $('#descripcion').val();
        const fecha = $('#fecha').val();
        let todoCorrecto = true;

        if (autor === '') {
            todoCorrecto = false;
            alert('El autor no puede estar vacio.');
        }

        if (moroso === '') {
            todoCorrecto = false;
            alert('Moroso no puede estar vacío.');
        }

        if (localidad === '') {
            todoCorrecto = false;
            alert('Localidad no puede estar vacío.');
        }

        if (descripcion === '') {
            todoCorrecto = false;
            alert('Descripción no puede estar vacío.');
        }

        if (fecha === '') {
            todoCorrecto = false;
            alert('Fecha no puede estar vacío.');
        }

        if (todoCorrecto) {

            const datos = {
                'autor': autor,
                'moroso': moroso,
                'localidad': localidad,
                'descripcion': descripcion,
                'fecha': fecha
            };

            $.ajax({
                url: 'insertarAnuncio.php',
                data: {datos},
                type: 'POST',
                success: function (response) {
                    obtenerLista();
                }
            });
        }

    });

    /*
     * Si se pincha en el boton de login, te lleva al login (obviamente)
     */
    $(document).on('click', '#login', (e) => {
        e.preventDefault();
        window.location = "login.php";
    });

    /*
     * Al pinchar en volver, te devuelve al index 
     */
    $(document).on('click', '#botonVolver', (e) => {
        e.preventDefault();
        window.location = "index.php";
    });

    /*
     * Al pinchar en ingresar, comprueba los datos en la base de datos
     */
    $(document).on('click', '#botonIngresar', (e) => {
        e.preventDefault();
        const usuario = $('#username').val();
        const password = $('#password').val();
        const datos = {
            'usuario': usuario,
            'password': password
        };
        $.ajax({
            url: 'comprobarUsuario.php',
            data: {datos},
            type: 'POST',
            success: function (response) {
                console.log(response);
                let template = '';
                // Si no devuelve nada es que no están relleno todos los campos
                if (response == '') {
                    template = 'Debes rellenar todos los campos!!';
                    $('#error').html(template);
                }
                // False es que no coincide usuario y contraseña
                if (response == 'false') {
                    template = 'Usuario o contraseña incorrecto!!';
                    $('#error').html(template);
                }
                // Para cuando el usuario está bloqueado
                if (response == 'bloqueado') {
                    template = 'Usuario bloqueado!!';
                    $('#error').html(template);
                }
                // Todo correcto
                if (response == 'true') {
                    crearCookie('usuario', usuario, 1);
                    window.location = "index.php";
                }
                // Si se ha introducido el usuario admin
                if (response == 'dwes') {
                    crearCookie('usuario', 'dwes', 1);
                    window.location = "index.php";
                }
            }
        });
    });

    /*
     * Al pinchar en el boton salir, se crea una cookie con valor visitante
     */
    $(document).on('click', '#botonSalir', () => {
        crearCookie('usuario', 'Visitante', 1);
    });

    /*
     * Al pulsar en actualizar, te muestra el formulario
     */
    $(document).on('click', '#botonActualizar', (e) => {
        const elemento = $(this)[0].activeElement;
        const id_anuncio = $(elemento).attr('id_anuncio');
        $.ajax({
            url: 'obtenerAnuncio.php',
            data: {id_anuncio},
            type: 'POST',
            success: function (response) {
                if (!response.error) {
                    let anuncio = JSON.parse(response);
                    let template = `
                    <form id='insertarAnuncio'>
                        <label for='autor'>Autor</label>
                        <input id='autor' type='text' value='${anuncio[0].autor}' placeholder='Autor' readonly>
                        <label for='moroso'>Moroso</label>
                        <input id='moroso' type='text' value='${anuncio[0].moroso}' placeholder='Moroso'>
                        <label for='localidad'>Localidad</label>
                        <input id='localidad' type='text' value='${anuncio[0].localidad}' placeholder='Localidad'>
                        <label for='descripcion'>Descripcion</label>
                        <input id='descripcion' type='text' value='${anuncio[0].descripcion}' placeholder='Descripcion'>
                        <label for='fecha'>Fecha</label>
                        <input id='fecha' type='date' value='${anuncio[0].fecha}'>
                        <button id='confirmarActualizacion' id_anuncio='${anuncio[0].id_anuncio}' class='ml-2 btn btn-primary'>
                            Actualizar
                        </button>
                    </form>
                    `;
                    $('#container').html(template);
                }
            }
        });
    });

    /*
     * Cuando se confirma, se validan los datos y se mandan a la base de datos
     */
    $(document).on('click', '#confirmarActualizacion', (e) => {
        e.preventDefault();
        const elemento = $(this)[0].activeElement;
        const id_anuncio = $(elemento).attr('id_anuncio');
        const nuevoMoroso = $('#moroso').val();
        const nuevaLocalidad = $('#localidad').val();
        const nuevaDescripcion = $('#descripcion').val();
        const nuevaFecha = $('#fecha').val();
        todoCorrecto = true;

        if (nuevoMoroso === '') {
            todoCorrecto = false;
            alert('Moroso no puede estar vacío.');
        }

        if (nuevaLocalidad === '') {
            todoCorrecto = false;
            alert('Localidad no puede estar vacío.');
        }

        if (nuevaDescripcion === '') {
            todoCorrecto = false;
            alert('Descripción no puede estar vacío.');
        }

        if (nuevaFecha === '') {
            todoCorrecto = false;
            alert('Fecha no puede estar vacío.');
        }

        if (todoCorrecto) {
            const datos = {
                'id_anuncio': id_anuncio,
                'nuevoMoroso': nuevoMoroso,
                'nuevaLocalidad': nuevaLocalidad,
                'nuevaDescripcion': nuevaDescripcion,
                'nuevaFecha': nuevaFecha
            };

            $.ajax({
                url: 'actualizarAnuncio.php',
                data: {datos},
                type: 'POST',
                success: function (response) {
                    if (response !== '') {
                        obtenerLista();
                        let template = '';
                        $('#container').html(template);
                    } else {
                        alert('Algo ha salido mal.');
                    }
                }
            });
        }
    });

    /*
     * Al pulsar en eliminar, sale un mensaje de confirmación y de ser correcto,
     * se elimina el anuncio
     */
    $(document).on('click', '#botonEliminar', () => {
        if (confirm('Seguro que quieres eliminar este anuncio?')) {
            const elemento = $(this)[0].activeElement;
            const id_anuncio = $(elemento).attr('id_anuncio');
            $.ajax({
                url: 'eliminarAnuncio.php',
                data: {id_anuncio},
                type: 'POST',
                success: function (response) {
                    obtenerLista();
                    let template = '';
                    $('#container').html(template);
                }
            });
        } else {
            console.log('No');
        }
    });

    /*
     * Crea el mapa al pulsar en mapa
     */
    $(document).on('click', '#mapa', () => {
        $('#divBotonCerrarMapa').show(); 
        var map = $(this)[0].childNodes[1].childNodes[2].childNodes[3];
        map.setAttribute('style', 'margin:12px 0 12px 0;height:300px;width:80%;');
        var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                osm = L.tileLayer(osmUrl, {maxZoom: 18, attribution: osmAttrib});
        var map = L.map('map').setView([37.462444, -5.648805], 17).addLayer(osm);
        L.marker([37.462444, -5.648805])
                .addTo(map)
                .bindPopup('Calle Vistalegre 11.')
                .openPopup();
    });
    
    /*
     * Al puslar en cerrar mapa, se oculta el mapa y el boton para cerrar el mapa
     */
    $(document).on('click', '#cerrarMapa', () => {
        $('#divBotonCerrarMapa').hide(); 
        $('#map').hide(); 
    });

});