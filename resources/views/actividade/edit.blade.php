@extends('adminlte::page')

@section('title', 'Editar Actividades')


@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizacion de Actividades') }} Actividades</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('actividades.update', $actividade->id) }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('actividade.form')

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

        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.ckeditor').ckeditor();
            });
        </script>
    @stop
