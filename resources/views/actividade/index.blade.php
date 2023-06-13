@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
    <h1>Actividades</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('actividades.reportes') }}" class="btn btn-outline-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Reporte') }}
                                </a>
                                <a href="{{ route('actividades.create') }}" class="btn btn-outline-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Actividad') }}
                                </a>
                              </div>
                        </div>
                    </div>
                   
                    @php 
                    $eliminar = false;
                    $editar = false;
                    $registrar = false;
                    $error = false;
                    @endphp

                    @if ($message = Session::get('success'))
                        
                        @php 
                        if($message == 'eliminar')
                        {
                            $eliminar = true;
                        }
                        elseif($message == 'editar')
                        {
                            $editar = true;
                        }
                        elseif($message == 'registrar')
                        {
                            $registrar = true;
                        }
                        elseif($message == 'error')
                        {
                            $error = true;
                        }

                        @endphp

                    @endif

                    <div class="card-body">

                        <form method="GET">
                            <div class="input-group mb-3">
                              <input type="text" name="search" class="form-control" placeholder="Buscar">
                              <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
                            </div>
                            </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed table-bordered small">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>
                                        
										<th>Nombre De La Actividad</th>
                                        <th>Fecha</th>
										<th>Costo</th>
										<th>Status</th>
										<th>Cantidad</th>
										<th>Descripcion</th>
										<th>Proyecto</th>
										<th>Responsable</th>
										<th>Direccion</th>
                                        <th>Imagen</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actividades as $actividade)
                                        <tr>
                                            <td>{{ $actividade->id }}</td>
                                            
											<td>{{ $actividade->nombre }}</td>
                                            <td>{{ $actividade->created_at}}</td>
											<td>{{ number_format($actividade->costo, 2, ',', '.') }}</td>
											<td>{{ $actividade->status }}</td>
											<td>{{ $actividade->cantidad }}</td>
											<td>{!! $actividade->descripcion !!}</td>
											<td>{!! $actividade->proyecto->nombre !!}</td>
											<td>{{ $actividade->responsable->nombre }}</td>
											<td>{{ $actividade->direccione->descripcion }}</td>
                                            <td><img src="{{ asset ($actividade->imagen) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt=""></td>
											
                                            <td>
                                                <form action="{{ route('actividades.destroy',$actividade->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-primary btn-block" href="{{ route('actividades.show',$actividade->id) }}"><i class="fas fa-print"></i>{{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success btn-block" href="{{ route('actividades.edit',$actividade->id) }}"><i class="fa fa-fw fa-edit"></i>{{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                  <button type="submit" class="btn btn-danger btn-sm submit-prevent-button"><i class="fa fa-fw fa-trash"></i>{{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $actividades->links() !!}
            </div>
        </div>
    </div>

    @stop

    @section('css')


        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
    @stop
    
    @section('js')

        

       

        @if($eliminar)
    <script type="text/javascript" src="{{ asset('js/eliminar.js') }}"></script>
    @elseif ($editar)
    <script type="text/javascript" src="{{ asset('js/editar.js') }}"></script>
    @elseif ($registrar)
    <script type="text/javascript" src="{{ asset('js/registrar.js') }}"></script>
    @elseif ($error)
    <script type="text/javascript" src="{{ asset('js/error.js') }}"></script>
    @endif


    <script src="{{ asset('js/submit.js') }}"></script>
        <script src="{{ asset('js/alerta_eliminar.js') }}"></script>
        

    @stop
