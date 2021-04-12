<div class="form-group">


                    <div class="form-group">
                      <label for="name">Servicio</label>
                      <input type="text" class="form-control" name="name_service" id="name_service" placeholder="Servicio">
                    </div>

                    @if ($errors->has('name_service'))
                    <span class="text-danger">{{ $errors->first('name_service') }}</span>
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

                     <div class="form-group">
                      <label for="description">Mano de Obra ($)</label>
                      <input type="number" class="form-control" step='0.01' name="cost" id="cost" placeholder="Mano de Obra ($)">
                    </div>
                  <br>
                    @if ($errors->has('cost'))
                    <span class="text-danger">{{ $errors->first('cost') }}</span>
                     @endif

             <div class="form-group">
            <label for="client_id">Categoría Servicio</label>
            <select class="form-control" name="category_work_id" id="category_work_id">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>


</div>