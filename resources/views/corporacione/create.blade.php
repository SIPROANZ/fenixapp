@extends('adminlte::page')

@section('title', 'Corporaciones')

@section('content_header')
    <h1>Corporaciones</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }}</span>
                    </div>
                    <div class="card-body"> 
                        <form method="POST" action="{{ route('corporaciones.store') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                            @csrf

                            @include('corporacione.form')

                        </form>
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
    
    <script src="{{ asset('js/submit.js') }}"></script>
        <script> console.log('Hi!'); </script>

     
    @stop

