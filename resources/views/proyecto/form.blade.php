<div class="box box-info padding-1">
    <div class="box-body">
        
        {{--
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::textarea('nombre', $proyecto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        --}}

        <div class="row">
        <div class="col-12 col-md-12">
        <textarea class="ckeditor form-control" name="nombre">{{ $proyecto->nombre }}</textarea>
        </div>

        <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('duracion') }}
            {{ Form::text('duracion', $proyecto->duracion, ['class' => 'form-control' . ($errors->has('duracion') ? ' is-invalid' : ''), 'placeholder' => 'Duracion']) }}
            {!! $errors->first('duracion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('costo') }}
            {{ Form::text('costo', $proyecto->costo, ['class' => 'form-control' . ($errors->has('costo') ? ' is-invalid' : ''), 'placeholder' => 'Costo']) }}
            {!! $errors->first('costo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('inicio') }}
            {{ Form::date('fecha_inicio', $proyecto->fecha_inicio, ['class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicio']) }}
            {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('fin') }}
            {{ Form::date('fecha_fin', $proyecto->fecha_fin, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin']) }}
            {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('Estatus') }}
            {{ Form::select('status', ['SIN EMPEZAR'  => 'SIN EMPEZAR', 'LISTO'  => 'LISTO', 'EN PROGRESO'  => 'EN PROGRESO', 'ARCHIVADO'  => 'ARCHIVADO'], 0, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('Tipo') }}
            {{ Form::select('tipo', (['INGRESO'=>'INGRESO', 'EGRESO'=>'EGRESO']), $proyecto->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('cantidad de actividades') }}
            {{ Form::text('cantidad', $proyecto->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('unidad de medida') }}
            {{ Form::select('unidad_id', $unidades, $proyecto->unidad_id, ['class' => 'form-control' . ($errors->has('unidad_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('unidad_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('responsable') }}
            {{ Form::select('responsable_id', $responsables, $proyecto->responsable_id, ['class' => 'form-control' . ($errors->has('responsable_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('responsable_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-12 col-md-3">
        <div class="form-group">
            {{ Form::label('corporacion') }}
            {{ Form::select('corporacion_id', $corporaciones, $proyecto->corporacion_id, ['class' => 'form-control' . ($errors->has('corporacion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('corporacion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    </DIV>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-outline-primary submit-prevent-button">{{ __('Enviar') }}</button>
    </div>
</div>