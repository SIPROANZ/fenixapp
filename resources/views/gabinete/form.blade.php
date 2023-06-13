<div class="box box-info padding-1">
    <div class="box-body">
        
    <div class="row">

    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $gabinete->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Del Gabinete']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('responsable') }}
            {{ Form::text('responsable', $gabinete->responsable, ['class' => 'form-control' . ($errors->has('responsable') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Del Responsable Del Gabinete']) }}
            {!! $errors->first('responsable', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen11111111111111111']) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>


        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::text('telefono', $gabinete->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono ']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('correo') }}
            {{ Form::text('correo', $gabinete->correo, ['class' => 'form-control' . ($errors->has('correo') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
            {!! $errors->first('correo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>

</div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>