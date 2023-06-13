@extends('adminlte::page')

@section('title', 'Detalles de Actividades')


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalles de Actividades') }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('actividades.index') }}"><i class="fas fa-reply-all"></i> {{ __('Regresar') }}</a>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ url('#') }}"><i class="fas fa-print"></i> {{ __('Imprimir') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Nombre De La Actividad:</strong>
                            {{ $actividade->nombre }}
                        </div>
                    </div>
                       <div class="col-md-6">
                        <div class="form-group">
                            <strong>Proyecto a cual pertenece  :</strong>
                            {!! $actividade->proyecto->nombre !!}
                        </div>
                    </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <strong>Descripcion De La Actividad:</strong>
                            {!! $actividade->descripcion !!}
                        </div>
                          </div>
                       <div class="col-md-6">
                        <div class="form-group">
                            <strong>Fecha De La Actividad:</strong>
                            {{ $actividade->created_at }}
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $actividade->direccione->descripcion }}
                        </div>
                         </div>

                        

                        <div class="col-md-6">
                        <div class="form-group">
                            <strong>Costo:</strong>
                            {{ number_format($actividade->costo, 2, ',', '.') }}
                        </div>
                    </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $actividade->status }}
                        </div>
                    </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $actividade->cantidad }}
                        </div>
                    </div>


                        <div class="col-md-6">
                        <div class="form-group">
                            <strong>Responsable:</strong>
                            {{ $actividade->responsable->nombre }}
                        </div>
                    </div>

                    
                     <div class="col-md-12">
                        <div class="form-group">
                            <strong>Imagen De La Actividad:</strong>
                            <img src="{{ asset ($actividade->imagen) }}" class="rounded mx-auto d-block" style="max-height: 400px; max-width: 400px" alt="">
                            
                        </div>
                        



         
 </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
    
    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
