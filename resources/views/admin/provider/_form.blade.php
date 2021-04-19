<div class="form-group">


                <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
                    </div>

                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
                    <br>

                    
                    <div class="form-group">
                    <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>

                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                     @endif
                    
                    
                    <div class="form-group">
                    <label for="ruc">Número de RUC</label>
                      <input type="text" class="form-control" name="ruc_number" id="ruc_number" placeholder="RUC Numero" required>
                      
                    <small id="helpId" class="form-text text-muted">Ingrese los 11 digitos del Número RUC.</small>
                    </div>


                    @if ($errors->has('ruc_number'))
                    <span class="text-danger">{{ $errors->first('ruc_number') }}</span>
                     @endif

                    
                    <div class="form-group">
                    <label for="direcion">Dirección</label>
                      <input type="text" class="form-control" name="address" id="address" placeholder="Dirección">
                      <small id="helpId" class="form-text text-muted">Este campo es opcional</small>
                    </div>

                    @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                     @endif

                    
                    
                    <div class="form-group">
                      <label for="description">Teléfono</label>
                      <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono">
                    </div>
                 

                    @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                     @endif

</div>