@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Datos Estadisticos ') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- interactive chart -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                      Area Interactiva de Proyectos
                </h3>

                <div class="card-tools">
                   Tiempo Real
                  <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active" data-toggle="on">On</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="off">Off</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="interactive" style="height: 300px;"></div>
              </div>
      
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

       
        <!-- /.row -->
         <!-- Left col -->
         
        </section>

        <!-- Inicio cuadros de ingresos y egresos estimados y actuales obtenidos -->

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3></h3>

                <h4>{{ number_format($ingreso_estimado, 2,',','.') }} Bs</h4>
                <p>INGRESO ESTIMADO ANUAL</p>
              </div>
           
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3></h3>

                <h4>{{ number_format($ingreso_actual_estimado, 2,',','.') }} Bs</h4>
                <p>TOTAL INGRESO GENERADO</p>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3></h3>

                <h4>{{ number_format($egreso_estimado, 2,',','.') }} Bs</h4>

                <p>EGRESO ESTIMADO ANUAL</p>
              </div>

              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3></h3>

                <h4>{{ number_format($egreso_actual_estimado, 2,',','.') }} Bs</h4>

                <p>TOTAL EGRESO GENERADO</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
                
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <!-- Fin de cuadros de ingresos y egresos -->


<!-- Listado top de diez proyectos -->

<div class="row">
  <div class="col-12 col-md-8">
<div class="card">
  <div class="card-header border-transparent">
  <h3 class="card-title">Proyectos de Mayor Impacto Economico</h3>
  <div class="card-tools">
  <button type="button" class="btn btn-tool" data-card-widget="collapse">
  <i class="fas fa-minus"></i>
  </button>
  <button type="button" class="btn btn-tool" data-card-widget="remove">
  <i class="fas fa-times"></i>
  </button>
  </div>
  </div>
  
  <div class="card-body p-0" style="display: block;">
  <div class="table-responsive">
  <table class="table m-0">
  <thead>
  <tr>
  <th>CODIGO ID</th>
  <th>PROYECTO</th>
  <th>ESTADO</th>
  <th>VALOR</th>
  <th>TIPO</th>
  </tr>
  </thead>
  <tbody>



    @foreach ($proyectos2 as $proyecto)
  
    <tr>
      <td><a href="{{ route('proyectos.show',$proyecto->id) }}">{{ $proyecto->id }}</a></td>
      <td>{!! $proyecto->nombre !!}</td>
      <td>
        
        
        @if (($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente))== 0)
        <span class="badge badge-danger">{{ $proyecto->status }} </span>
        @endif
        @if (($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) > 0 && ($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) < 15)
        <span class="badge badge-warning">{{ $proyecto->status }} </span>
        @endif
        @if (($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) >= 15 && ($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) < 30)
        <span class="badge badge-info">{{ $proyecto->status }} </span>
        @endif
        @if (($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) >= 30 && ($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) < 60)
        <span class="badge badge-primary">{{ $proyecto->status }} </span>
        @endif
        @if (($obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente)) >= 60)
        <span class="badge badge-success">{{ $proyecto->status }} </span>
        @endif
        
      



        {{ $obj_carbon->parse($proyecto->fecha_fin)->diffInDays($fecha_reciente) }} Dias Restantes
      
      </td>
      <td>
      <div class="sparkbar text-right" data-color="#00a65a" data-height="20">{{ number_format($proyecto->costo, 2, ',','.') }} Bs</div>
      </td>
      <td>
        <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $proyecto->tipo }}</div>
        </td>
      </tr>
     
      
    @endforeach

  
  </tbody>
  </table>
  </div>
  
  </div>
  
  <div class="card-footer clearfix" style="display: block;">
  <a href="{{ route('proyectos.create') }}" class="btn btn-sm btn-info float-left">Crear Nuevo Proyecto</a>
  <a href="{{ route('proyectos.index') }}" class="btn btn-sm btn-secondary float-right">Ver Todos los Proyectos</a>
  </div>
  
  </div>

</div> <!-- fin de proyectos -->


<!--  actividades -->

<div class="col-12 col-md-4">

  <div class="card">
    <div class="card-header">
    <h3 class="card-title">Actividades de mayor costo</h3>
    <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse">
    <i class="fas fa-minus"></i>
    </button>
    <button type="button" class="btn btn-tool" data-card-widget="remove">
    <i class="fas fa-times"></i>
    </button>
    </div>
    </div>
    
    <div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">

      <!-- Aqui se agregaran las listas de actividades -->
      
@foreach ($actividades2 as $actividad)


<li class="item">
  <div class="product-img">
  <img src="{{ asset($actividad->imagen) }}" alt="Actividad" class="img-size-50">
  </div>
  <div class="product-info">
  <a href="{{ route('actividades.show',$actividad->id) }}" class="product-title"> {{ $actividad->nombre }}
  <span class="badge badge-info float-right">{{ number_format($actividad->costo, 2, ',','.') }} Bs</span></a>
  <span class="product-description">
    {!! $actividad->descripcion !!}
  </span>
  </div>
  </li>

 
@endforeach
      <!-- Fin de listado de actividades de mayor costo -->

    
    </ul>
    </div>
    
    <div class="card-footer text-center">
    <a href="{{ route('actividades.index') }}" class="uppercase">Ver todas las actividades</a>
    </div>
    
    </div>


</div>
<!-- Fin de Actividades -->


<!-- Chart de ingresos y egresos -->


<!-- Fin chart de ingresos y egresos -->

<!-- Listado de corporaciones -->
<div class="col-md-6">

  <div class="card">
  <div class="card-header">
  <h3 class="card-title">Listado de Corporaciones y Entes</h3>
  <div class="card-tools">
  
  <button type="button" class="btn btn-tool" data-card-widget="collapse">
  <i class="fas fa-minus"></i>
  </button>
  <button type="button" class="btn btn-tool" data-card-widget="remove">
  <i class="fas fa-times"></i>
  </button>
  </div>
  </div>
  
  <div class="card-body p-0">
  <ul class="users-list clearfix">
  
    @foreach ($corporaciones as $corporacion)
    
      <li>
      <img src="{{ asset ($corporacion->imagen) }}" alt="User Image">
      <a class="users-list-name" href="#">{{ $corporacion->nombre }}</a>
      <span class="users-list-date">{{ $corporacion->rif }}</span>
      </li>

    @endforeach
  
    
  </ul>
  
  </div>
  
  <div class="card-footer text-center">
  <a href="{{ route('corporaciones.index') }}">Ver todas las corporaciones</a>
  </div>
  
  </div>
  
  </div>
<!-- Fin de listado de corporaciones -->

<!-- Responsables de las actividades -->
<div class="col-md-6">

  <div class="card">
  <div class="card-header">
  <h3 class="card-title">Responsables</h3>
  <div class="card-tools">
  
  <button type="button" class="btn btn-tool" data-card-widget="collapse">
  <i class="fas fa-minus"></i>
  </button>
  <button type="button" class="btn btn-tool" data-card-widget="remove">
  <i class="fas fa-times"></i>
  </button>
  </div>
  </div>
  
  <div class="card-body p-0">
  <ul class="users-list clearfix">
  
    @foreach ($responsables as $responsable)
    
    <li>
    <img src="{{ asset ($responsable->imagen) }}" alt="User Image">
    <a class="users-list-name" href="#">{{ $responsable->nombre }}</a>
    <span class="users-list-date">{{ $responsable->telefono }}</span>
    </li>

  @endforeach
  
  </ul>
  
  </div>
  
  <div class="card-footer text-center">
  <a href="{{ route('responsables.index') }}">Ver todos los responsables</a>
  </div>
  
  </div>
  
  </div>
<!-- fin de listado de responsables -->

<!-- Inicio Pie Chart -->


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Total Ingresos vs Egresos Estimados Anualmente
              </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <!-- Cadena para guardar los valores en el html que luego leera el script -->
            <input type="hidden" id="ingresos_egresos" value="<?PHP echo "" . $ingreso_estimado . "," . $egreso_estimado; ?>">
           
            <!-- Inicio Otro Pie Ingresos Vs Egresos -->
            <div class="chart">
              <canvas id="myChartPie" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- Fin de Otro Pie  Ingresos vs Egresos --> 
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- DONUT CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Ingreso generado por actividad</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
           

            <!-- Cadena para guardar los valores en el html que luego leera el script -->
            <input type="hidden" id="etiquetas_corporaciones" value="<?PHP echo "" . $cad_corporaciones; ?>">
           
            <input type="hidden" id="ingresos_corporaciones" value="<?PHP echo "" . $cad_ingresos_corporaciones; ?>">
           
            <!-- Inicio Otro Pie Ingresos Vs Egresos -->
            <div class="chart">
              <canvas id="myChartIngresoCorporacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- Fin de Otro Pie  Ingresos vs Egresos --> 
            

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- PIE CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Estimado de Ingresos y Egresos por Corporaciones</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">


              <!-- Inicio Ingreso y Egreso x Corporacion -->

              <input type="hidden" id="ingresos_corporacion" value="<?PHP echo "" . $proyecto_ingresos; ?>">
              <input type="hidden" id="egresos_corporacion" value="<?PHP echo "" . $proyecto_egresos; ?>">
              <!-- Inicio Otro Pie Ingresos Vs Egresos -->
              <div class="chart">
                <canvas id="myChartCorporacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>

              <!-- Fin de Ingreso y Egreso Corporacion -->
            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="card card-info ">
            <div class="card-header">
              <h3 class="card-title">Ingresos vs Egresos generado por actividad</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <!-- Cadena para guardar los valores en el html que luego leera el script -->
            <input type="hidden" id="ingresos_anual" value="<?PHP echo "" . $cad_ingreso_anual; ?>">
            <input type="hidden" id="egresos_anual" value="<?PHP echo "" . $cad_egreso_anual; ?>">
            <!-- Inicio Otro Pie Ingresos Vs Egresos -->
            <div class="chart">
              <canvas id="myChartLine" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- Fin de Otro Pie  Ingresos vs Egresos --> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- BAR CHART -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Egreso generado por actividad</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              
             <!-- <input type="hidden" id="etiquetas_corporaciones" value="<?PHP // echo "" . $cad_corporaciones; ?>"> -->
           
            <input type="hidden" id="egresos_corporaciones" value="<?PHP echo "" . $cad_egresos_corporaciones; ?>">
           
            
            <div class="chart">
              <canvas id="myChartEgresoCorporacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- STACKED BAR CHART -->
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Historico Proyectos</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
             <!-- Ingreso Proyectos Anual -->
                 <!-- Cadena para guardar los valores en el html que luego leera el script -->
            <input type="hidden" id="costos_ingresos" value="<?PHP echo "" . $datos_costos['ingresos']; ?>">
            <input type="hidden" id="costos_egresos" value="<?PHP echo "" . $datos_costos['egresos']; ?>">
            <input type="hidden" id="etiquetas_years" value="<?PHP echo "" . $cad_year_transcurridos; ?>">
            
            <!-- Inicio Otro Pie Ingresos Vs Egresos -->
            <div class="chart">
              <canvas id="myHistoricoProyectos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- Inicio Contenido Galeria de Actividades -->
  <section class="content">

    <h5 class="mb-2">Ultimas Actividades Realizadas</h5>
        <div class="card card-success">
          <div class="card-body">
            <div class="row">
              
              @foreach ($ult_actividades as $activ)

              <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="card mb-2">
                  <img class="card-img-top" src="{{ asset ($activ->imagen) }}" alt="Imagen de la actividad">
                  <div class="card-img-overlay">
                    <h5 class="card-title text-primary">{{ $activ->nombre }}</h5>
                    <p class="card-text pb-1 pt-1 text-white">

                      {!! $activ->descripcion !!}
                      
                    </p>
                    <a href="{{ route('actividades.show',$activ->id) }} class="text-primary">Ver mas</a>
                  </div>
                </div>
              </div>
                
              @endforeach
              
              


            </div>
          </div>
        </div>

  </section>

  <!-- Fin Contenido Galeria Actividades -->
 


</div>

    



    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023-2024 <a href="https://adminlte.io">ProAnzoategui</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
        










                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

  


@stop

@section('js')

<script> console.log('Hi!'); </script>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- FLOT CHARTS -->
<script src="{{ asset('plugins/flot/jquery.flot.js')}}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ asset('plugins/flot/plugins/jquery.flot.resize.js')}}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ asset('plugins/flot/plugins/jquery.flot.pie.js')}}"></script>

<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>


<script src="{{-- asset('dist/js/demo.js') --}}"></script>

<script src="{{-- asset('dist/js/pages/dashboard2.js') --}}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Script para ingresos y egresos tipo PIE -->
<script>
  const ctx = document.getElementById('myChartPie');

  //Cadena con los valores obtenidos del html
  var ingresos_egresos = document.getElementById("ingresos_egresos").value;
      var arrayingresos_egresos =  ingresos_egresos.split(",");

  new Chart(ctx, {
    type: 'pie',
  data: {
  labels: ['Ingresos', 'Egresos'],
  datasets: [
    {
      label: 'Total Bs',
      data: arrayingresos_egresos,
     // backgroundColor: Object.values(Utils.CHART_COLORS),
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Ingresos Vs Egresos'
      }
    }
  }
  });
</script>

<!-- Fin de escrip para ingresos y egresos un PIE -->

<!-- Inicio de Grafica Lineal -->
<script>
  const ctx_line = document.getElementById('myChartLine');

  var ingresos = document.getElementById("ingresos_anual").value;
      var arrayingresos =  ingresos.split(",");

      var egresos = document.getElementById("egresos_anual").value;
      var arrayegresos =  egresos.split(",");

  new Chart(ctx_line, {
    type: 'line',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'Ingresos Bs',
        data: arrayingresos,
        borderWidth: 1
      },
      {
        label: 'Egresos Bs',
        data: arrayegresos,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- Fin de Grafica Inicial -->



<script>
  $(function () {
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data        = [],
        totalPoints = 100

    function getRandomData() {

      if (data.length > 0) {
        data = data.slice(1)
      }

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }

      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    }

    var interactive_plot = $.plot('#interactive', [
        {
          data: getRandomData(),
        }
      ],
      {
        grid: {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor: '#f3f3f3'
        },
        series: {
          color: '#3c8dbc',
          lines: {
            lineWidth: 2,
            show: true,
            fill: true,
          },
        },
        yaxis: {
          min: 0,
          max: 100,
          show: true
        },
        xaxis: {
          show: true
        }
      }
    )

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

      interactive_plot.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
      interactive_plot.draw()
      if (realtime === 'on') {
        setTimeout(update, updateInterval)
      }
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
      update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtime = 'on'
      }
      else {
        realtime = 'off'
      }
      update()
    })
    /*
     * END INTERACTIVE CHART
     */


    /*
     * LINE CHART
     * ----------
     */
    //LINE randomly generated data

    var sin = [],
        cos = []
    for (var i = 0; i < 14; i += 0.5) {
      sin.push([i, Math.sin(i)])
      cos.push([i, Math.cos(i)])
    }
    var line_data1 = {
      data : sin,
      color: '#3c8dbc'
    }
    var line_data2 = {
      data : cos,
      color: '#00c0ef'
    }
    $.plot('#line-chart', [line_data1, line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
    /* END LINE CHART */

    /*
     * FULL WIDTH STATIC AREA CHART
     * -----------------
     */
    var areaData = [[2, 88.0], [3, 93.3], [4, 102.0], [5, 108.5], [6, 115.7], [7, 115.6],
      [8, 124.6], [9, 130.3], [10, 134.3], [11, 141.4], [12, 146.5], [13, 151.7], [14, 159.9],
      [15, 165.4], [16, 167.8], [17, 168.7], [18, 169.5], [19, 168.0]]
    $.plot('#area-chart', [areaData], {
      grid  : {
        borderWidth: 0
      },
      series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#00c0ef',
        lines : {
          fill: true //Converts the line chart to area chart
        },
      },
      yaxis : {
        show: false
      },
      xaxis : {
        show: false
      }
    })

    /* END AREA CHART */

    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data : [[1,10], [2,8], [3,4], [4,13], [5,17], [6,9]],
      bars: { show: true }
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#3c8dbc'],
      xaxis : {
        ticks: [[1,'January'], [2,'February'], [3,'March'], [4,'April'], [5,'May'], [6,'June']]
      }
    })
    /* END BAR CHART */

    /*
     * DONUT CHART
     * -----------
     */

    var donutData = [
      {
        label: 'Series2',
        data : 30,
        color: '#3c8dbc'
      },
      {
        label: 'Series3',
        data : 20,
        color: '#0073b7'
      },
      {
        label: 'Series4',
        data : 50,
        color: '#00c0ef'
      }
    ]
    $.plot('#donut-chart', donutData, {
      series: {
        pie: {
          show       : true,
          radius     : 1,
          innerRadius: 0.5,
          label      : {
            show     : true,
            radius   : 2 / 3,
            formatter: labelFormatter,
            threshold: 0.1
          }

        }
      },
      legend: {
        show: false
      }
    })
    /*
     * END DONUT CHART
     */

  })

  /*
   * Custom Label formatter
   * ----------------------
   */
  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>

<!-- Ingresos corporaciones pie -->
<script>
  const ctx_corp = document.getElementById('myChartIngresoCorporacion');

  //Cadena con los valores obtenidos del html
      var ingresos_cad = document.getElementById("ingresos_corporaciones").value;
      var arrayingresos_cad =  ingresos_cad.split(",");
      var etiquetas_corpo = document.getElementById("etiquetas_corporaciones").value;
      var array_etiquetas =  etiquetas_corpo.split(",");

  new Chart(ctx_corp, {
    type: 'pie',
  data: {
  labels: array_etiquetas,
  datasets: [
    {
      label: 'Total Bs',
      data:  arrayingresos_cad, // [12,25,14,3],
     // backgroundColor: Object.values(Utils.CHART_COLORS),
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      
    }
  }
  });
</script>
<!-- Fin Pie Ingresos Corporaciones -->


<!-- Egreso por corporaciones -->
<script>
  const ctx_corp_egre = document.getElementById('myChartEgresoCorporacion');

  //Cadena con los valores obtenidos del html
  var egresos_cad = document.getElementById("egresos_corporaciones").value;
      var arrayegresos_cad =  egresos_cad.split(",");
      var etiquetas_corpo = document.getElementById("etiquetas_corporaciones").value;
      var array_etiquetas =  etiquetas_corpo.split(",");

  new Chart(ctx_corp_egre, {
    type: 'pie',
  data: {
  labels: array_etiquetas,
  datasets: [
    {
      label: 'Total Bs',
      data:  arrayegresos_cad, // [12,25,14,3],
     // backgroundColor: Object.values(Utils.CHART_COLORS),
    }
  ]
},
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      
    }
  }
  });
</script>
<!-- Fin de egreso por corporaciones  -->

<!-- Ingreso vs Egresos anuales por proyecto corporaciones -->
<script>
  const ctx_corporacion = document.getElementById('myChartCorporacion');

      var ingres = document.getElementById("ingresos_corporacion").value;
      var arrayingre =  ingres.split(",");

      var egres = document.getElementById("egresos_corporacion").value;
      var arrayegre =  egres.split(",");

      var etiquetas_corpo = document.getElementById("etiquetas_corporaciones").value;
      var array_etiquetas =  etiquetas_corpo.split(",");

  new Chart(ctx_corporacion, {
    type: 'bar',
    data: {
      labels: array_etiquetas,
      datasets: [{
        label: 'Ingresos Bs',
        data: arrayingre,
        borderWidth: 1
      },
      {
        label: 'Egresos Bs',
        data: arrayegre,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- Fin de Ingreso vs egresos anuales por proyecto corporaciones -->
 

<!-- Proyectos estimados anuales un total de doce -->
<!-- Inicio de Grafica Lineal -->
<script>
  const ctx_proyecto_anual = document.getElementById('myHistoricoProyectos');

  var ingresos = document.getElementById("costos_ingresos").value;
      var arrayingresos =  ingresos.split(",");

      var egresos = document.getElementById("costos_egresos").value;
      var arrayegresos =  egresos.split(",");

      var years_etq = document.getElementById("etiquetas_years").value;
      var array_years_etq =  years_etq.split(",");

  new Chart(ctx_proyecto_anual, {
    type: 'line',
    data: {
      labels: array_years_etq,
      datasets: [{
        label: 'Ingresos Bs',
        data: arrayingresos,
        borderWidth: 1
      },
      {
        label: 'Egresos Bs',
        data: arrayegresos,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- Fin de Grafica Inicial -->

@stop
