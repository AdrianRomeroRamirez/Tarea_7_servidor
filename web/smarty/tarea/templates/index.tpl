{* Smarty *}

<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Okupa2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
        <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AkNOcfbd_H756A3CbVwhr9ojDQXE_Y6KLQChHusCATl-g0W0CNNyuD3uPc7VeRnN' async defer></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Okupa2</a>

            <h3 class="ml-auto mr-auto">Usuario: {$usuario} || Hora visita: {$visita}</h3>

            <form>
                {$botonLogin}
                {$botonSalir}
                <button id="nuevoAnuncio" class="my-2 my-lg-0  ml-auto btn btn-primary">Nuevo anuncio</button>
            </form>

        </nav>

                <div id="map" class="map map-home">
                </div>
                <div id="divBotonCerrarMapa">
                    <button id="cerrarMapa" class="btn btn-danger">Cerrar mapa</button>
                </div>

        <!-- TABLA  -->
        <div>

            <div class="card my-4" id="panel-oculto">
                <div id="container" class="card-body">
                    {$tabla}
                </div>
            </div>


            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Id Anuncio</th>
                        <th>Autor</th>
                        <th>Moroso</th>
                        <th>Localidad</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Mapa</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody id="anuncios"></tbody>
            </table>
        </div>

        <!-- Script jquery  -->
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <!-- back-end  -->
        <script src="funciones.js"></script>
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script> 
    </body>
</html>