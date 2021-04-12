<div class="form-group">


                    <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="" placeholder="Nombre">
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                    <br>
                    <div class="form-group">
                      <label for="description">Descripción</label>
                      <input type="text" class="form-control" name="description" id="description" placeholder="Descripción">
                    </div>
                  <br>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                     @endif

</div>