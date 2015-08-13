<!DOCTYPE html>
<html>
<head>
  <title>Compras - TourGuide Admin</title>
  <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body onload="cargarGraficaDeCompras()">
  <div class="container-fluid">
    <h1>Resumen de las compras</h1>

    <div class="row">
      <div class="col-sm-12 col-md-8">
        <div id="compras">
          <canvas id="comprasGrafico" width="800" height="400">
        </div>
      </div>

      <div class="col-sm-12 col-md-4">
        <form id="filtros">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Ubicación</div>
              {!! Form::select('ubicacion_id', $ubicaciones, null, ['class' => 'form-control']) !!}
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Desde</div>
              <input type='date' name='desde' value='{{ $fecha_desde->toDateString() }}' class='form-control'>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon">Hasta</div>
              <input type='date' name='hasta' value='{{ $fecha_hasta->toDateString() }}' class='form-control'>
            </div>
          </div>

          {!! Form::submit('Actualizar', ['class' => 'btn btn-primary']) !!}
          </form>

        </div>
      </div>
    </div>

  <script src="/js/app.js"></script>
  <script>
    var chart;
    Chart.defaults.global.responsive = true;

    function cargarGraficaDeCompras() {
      $.ajax({
        method: 'GET',
        url: '{{ route('compras.index') }}',
        data: $('#filtros').serialize(),
        success: function(compras) {
          mostrarGraficaDeCompras(compras);
        }
      });
    }

    function mostrarGraficaDeCompras(datos) {
      if (chart) chart.destroy();

      var contexto = $('#comprasGrafico').get(0).getContext('2d');
      chart = new Chart(contexto).Line(datos);
    }

    $('#filtros').submit(function(e) {
      e.preventDefault();

      cargarGraficaDeCompras();
    });
  </script>
</body>
</html>
