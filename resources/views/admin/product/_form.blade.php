<div class="form-group">

<div class="form-row">
  <div class="form-group col-md-6">
                <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" id="name" class="form-control" aria-describedby="helpId" required>
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
  </div>

  <div class="form-group col-md-6">
                     <div class="form-group">
                     <label for="code">Código de barras</label>
                     <input type="number" name="code" id="code" class="form-control"  aria-describedby="helpId">
                     <small id="helpId" class="text-muted">Campo opcional</small>
                    </div>

                    @if ($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                     @endif
</div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">


                    <div class="form-group">
                        <label for="sell_price">Precio de venta ($)</label>
                        <input type="number" name="sell_price" id="sell_price" step="0.01" class="form-control" aria-describedby="helpId" required>
                    </div>

                    @if ($errors->has('sell_price'))
                    <span class="text-danger">{{ $errors->first('sell_price') }}</span>
                     @endif

</div>

<div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="category_id">Categoría</label>
                      <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    @if ($errors->has('category_id'))
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                     @endif

  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="provider_id">Proveedor</label>
                        <select class="form-control" name="provider_id" id="provider_id">
                          @foreach ($providers as $provider)
                          <option value="{{$provider->id}}">{{$provider->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    @if ($errors->has('provider_id'))
                    <span class="text-danger">{{ $errors->first('provider_id') }}</span>
                     @endif
</div>

<div class="form-group col-md-6">
                    <div class="form-group">
                        <label for="provider_id">Unidad Medida</label>
                        <select class="form-control" name="unit_id" id="unit_id">
                          @foreach ($units as $unit)
                          <option value="{{$unit->id}}">{{$unit->name}}</option>
                          @endforeach
                        </select>
                    </div>

                    @if ($errors->has('unit_id'))
                    <span class="text-danger">{{ $errors->first('unit_id') }}</span>
                     @endif
</div>
</div>



                    <div class="card-body">
                        <h4 class="card-title d-flex">Imagen de producto
                          <small class="ml-auto align-self-end">
                            <a href="" class="font-weight-light" target="_blank">Seleccionar Archivo</a>
                          </small>
                        </h4>
                        <input type="file"  name="picture" id="picture" class="dropify" />
                    </div>
                 

                    @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                     @endif

</div>

@section('scripts')

{!! Html::script('melody/js/dropify.js') !!}

@endsection
