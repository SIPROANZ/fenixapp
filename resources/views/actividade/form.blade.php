<div class="box box-info padding-1">
    <div class="box-body">
        

        <div class="row">

       <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $actividade->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-md-12">
        {{ Form::label('descripcion ') }}
        <textarea class="ckeditor form-control" name="descripcion">{{ $actividade->descripcion }}</textarea>
        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
       
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('costo') }}
            {{ Form::text('costo', $actividade->costo, ['class' => 'form-control' . ($errors->has('costo') ? ' is-invalid' : ''), 'placeholder' => 'Costo']) }}
            {!! $errors->first('costo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::select('status', ['SIN EMPEZAR'  => 'SIN EMPEZAR', 'LISTO'  => 'LISTO', 'EN PROGRESO'  => 'EN PROGRESO', 'ARCHIVADO'  => 'ARCHIVADO'],0, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('cantidad') }}
            {{ Form::text('cantidad', $actividade->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
            {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

       

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('proyectos') }}
            {{ Form::select('proyecto_id', $proyectos, $actividade->proyecto_id, ['class' => 'form-control' . ($errors->has('proyecto_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('proyecto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('responsables') }}
            {{ Form::select('responsable_id', $responsables, $actividade->responsable_id, ['class' => 'form-control' . ($errors->has('responsable_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('responsable_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

        <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('direcciones') }}
            {{ Form::select('direcion_id', $direcciones, $actividade->direcion_id, ['class' => 'form-control' . ($errors->has('direcion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
            {!! $errors->first('direcion_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Fecha') }}
            {{ Form::date('created_at', $actividade->created_at, ['class' => 'form-control' . ($errors->has('created_at') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Fecha']) }}
            {!! $errors->first('created_at', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen']) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>

    </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-outline-primary submit-prevent-button">{{ __('Enviar') }}</button>
    </div>
</div>