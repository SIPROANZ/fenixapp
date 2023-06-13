@extends('adminlte::page')

@section('title', 'Registro de Direcciones ')

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
              <div class="col-lg-3 col-2">
                <div class="small-box bg-blue">
                    <div class="inner">
                      <h3></h3>
      
                      <p>  Direciones Registradas </p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mas info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('direcciones.reportes') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Reporte') }}
                                </a>
                                <a href="{{ route('direcciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nueva Direccion ') }}
                                </a>
                              </div>
                        </div>
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
                                    	<th>Descripcion</th>
										<th>Municipios</th>
										<th>Parroquias </th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($direcciones as $direccione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $direccione->descripcion }}</td>
											<td>{{ $direccione->municipio->nombre }}</td>
											<td>{{ $direccione->parroquia->nombre }}</td>

                                            <td>
                                                <form action="{{ route('direcciones.destroy',$direccione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('direcciones.show',$direccione->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('direcciones.edit',$direccione->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $direcciones->links() !!}
            </div>
        </div>
    </div>
@endsection
