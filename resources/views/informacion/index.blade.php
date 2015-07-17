<html>
    <head>
        <title>Administrar información de ubicaciones - TourGuide</title>
        <link rel="stylesheet" href="/css/styles.css">
    </head>
    <body>
        <div class="container-fluid">
            <h3>Administrar información para {{ $ubicacion->nombre }}</h3>

            <p>
                En esta página puedes administrar la información almacenada sobre la ubicación
                turística "{{ $ubicacion->nombre }}". Para añadir información en nuevo idioma,
                haz clic en <strong>Nuevo</strong>. Para modificar o eliminar alguna entrada de
                información, haz clic en el botón <strong>Modificar</strong> o
                <strong>Eliminar</strong> que corresponda.
            </p>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
