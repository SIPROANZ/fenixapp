@extends('adminlte::page')

@section('title', 'Direccion')

@section('content_header')
    <h1>Direccion</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Direccione</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('direcciones.update', $direccione->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('direccione.form')

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
