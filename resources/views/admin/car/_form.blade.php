<div class="form-group">

<div class="form-row">
  <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="name">Marca</label>
                      <input type="text" class="form-control" name="brand" id="" placeholder="Marca" required>
                    </div>

                    @if ($errors->has('brand'))
                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                     @endif
                  
        </div>

   
  <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="description">Modelo</label>
                      <input type="text" class="form-control" name="model" id="model" placeholder="Modelo" required>
                    </div>
                  <br>
                    @if ($errors->has('model'))
                    <span class="text-danger">{{ $errors->first('model') }}</span>
                     @endif

                    
                </div>
        </div>

        <div class="form-row">
  <div class="form-group col-md-6">
                     <div class="form-group">
                      <label for="name">Placa</label>
                      <input type="text" class="form-control" name="license_plate" id="" placeholder="Placa" max="8" required>
                    </div>

                    @if ($errors->has('license_plate'))
                    <span class="text-danger">{{ $errors->first('license_plate') }}</span>
                     @endif
                   
</div>


  <div class="form-group col-md-6">
                   
                     <div class="form-group">
                      <label for="name">Año</label>
                      <input type="text" class="form-control" name="year" id=""  placeholder="Año" maxlength="7" minlength="4"  required>
                    </div>

                    @if ($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                     @endif
                   

    </div>
</div>

<div class="form-row">


<div class="form-group col-md-6"> 
                    <div class="form-group">
                      <label for="category_id">Cliente</label>
                      <select class="form-control" name="client_id" id="client_id">
                        @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    @if ($errors->has('client_id'))
                    <span class="text-danger">{{ $errors->first('client_id') }}</span>
                     @endif
</div>

<div class="form-group col-md-6">
                    <div class="form-group">
                    <label for="name">Viscosidad</label>
                      <input type="text" class="form-control" name="viscosity" id="" placeholder="Viscosidad">
                      <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                    </div>

                    @if ($errors->has('viscosity'))
                    <span class="text-danger">{{ $errors->first('viscosity') }}</span>
                     @endif

                    
</div>

  </div>


                    <div class="card-body">
                        <h4 class="card-title d-flex">Fotografía
                          <small class="ml-auto align-self-end">
                            <a href="" class="font-weight-light" target="">Seleccionar Archivo</a>
                          </small>
                        </h4>
                        <input type="file"  name="picture" id="picture" class="dropify" />
                    </div>

                    

</div>

<script>


//attaching "change" event to the file upload button
document.getElementById("picture").addEventListener("change", validateFile)

function validateFile(){
  const allowedExtensions =  ['jpg','png'],
        sizeLimit = 10000000; // 10 megabyte

  // destructuring file name and size from file object
  const { name:fileName, size:fileSize } = this.files[0];

  /*
  * if filename is apple.png, we split the string to get ["apple","png"]
  * then apply the pop() method to return the file extension
  *
  */
  const fileExtension = fileName.split(".").pop();

  /* 
    check if the extension of the uploaded file is included 
    in our array of allowed file extensions
  */
  if(!allowedExtensions.includes(fileExtension)){
    Swal.fire({
            type: 'error',
            text: 'Tipo de archivo no permitido, selecciona un archivo de imagen',
        })
    this.value = null;
  }else if(fileSize > sizeLimit){
    Swal.fire({
            type: 'error',
            text: 'Imagen demasiada grande, por favor selecciona una imagen maxixo de 10 MB',
        })
    this.value = null;
  }
}

</script>