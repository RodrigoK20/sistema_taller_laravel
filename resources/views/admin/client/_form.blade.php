<div class="form-row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" required>
            @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
             @endif
        </div>
    </div>
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId">
            <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
            @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
             @endif
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="dni">DUI</label>
            <input type="number" class="form-control" name="dui" id="dui" aria-describedby="helpId">
            @if ($errors->has('dui'))
                    <small class="text-danger">{{ $errors->first('dui') }}</small>
             @endif
             <small id="helpId" class="form-text text-muted">Este campo es opcional. Ingrese los 8 dígitos sin guiones</small>
        </div>
    </div>
    

    <div class="form-group col-md-4">
        <div class="form-group">
            <label for="phone">Teléfono \ Celular</label>
            <input type="number" class="form-control" name="phone" id="phone" aria-describedby="helpId">
            @if ($errors->has('phone'))
                    <small class="text-danger">{{ $errors->first('phone') }}</small>
             @endif
        </div>
    </div>
</div>
<div class="form-group">
    <label for="address">Dirección</label>
    <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId">
    <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>

    @if ($errors->has('address'))
                    <small class="text-danger">{{ $errors->first('address') }}</small>
             @endif
</div>

@section('scripts')

{!! Html::script('melody/js/dropify.js') !!}

@endsection
