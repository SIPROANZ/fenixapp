@extends('adminlte::page')

@section('title', 'Registro de Gabinetes ')

@section('content_header')
    <h1> Registro de Gabinetes </h1>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                          

                             <div class="float-right">

                             <a href="{{ route('gabinetes.reportes') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Reporte') }}
                                </a>
                                <a href="{{ route('gabinetes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo Gabinete') }}
                                </a>
                              </div>
                        </div>
                            <form method="GET">
                            <div class="input-group mb-12">
                              <input type="text" name="search" class="form-control" placeholder="Buscar">
                              <button class="btn btn-outline-dark" type="submit" id="button-addon2">Buscar</button>
                            </div>
                            </form>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>N°</th>
                                      	<th>Nombre Del Gabinete</th>		
                                        			<th>Imagen de Perfil</th>
										<th>Responsable</th>
					
										<th>Telefono</th>
										<th>Correo</th>
                                        <th>Opciones</th>
                                      
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gabinetes as $gabinete)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $gabinete->nombre }}</td>
											
										<td><img src="{{ asset ($gabinete->imagen) }}" class="img-responsive" style="max-height: 100px; max-width: 100px" alt=""></td>
											<td>{{ $gabinete->responsable }}</td>
											<td>{{ $gabinete->telefono }}</td>
											<td>{{ $gabinete->correo }}</td>
                                       

                                            <td>
                                                <form action="{{ route('gabinetes.destroy',$gabinete->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('gabinetes.show',$gabinete->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Detalles') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('gabinetes.edit',$gabinete->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $gabinetes->links() !!}
            </div>
        </div>
    </div>
    @stop

    @section('css')
        
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop