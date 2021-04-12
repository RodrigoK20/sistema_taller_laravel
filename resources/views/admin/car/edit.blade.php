@extends('layouts.admin')
@section('title','Editar vehiculo')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Vehiculos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('cars.index')}}">Listado vehiculos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar vehiculo</h4>
                </div>
                {!! Form::model($car ,['route'=>['cars.update',$car],'method'=>'PUT', 'files' => true]) !!}
  
        
                <div class="form-group">

<div class="form-row">
  <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="name">Marca</label>
                      <input type="text" class="form-control" name="brand" id="" placeholder="Marca" value="{{$car->brand}}" required>
                    </div>

                    @if ($errors->has('brand'))
                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                     @endif
                  
        </div>

   
  <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="description">Modelo</label>
                      <input type="text" class="form-control" name="model" id="model" placeholder="Modelo" value="{{$car->model}}" required>
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
                      <input type="text" class="form-control" name="license_plate" id="" placeholder="Placa" max="8" value="{{$car->license_plate}}" required>
                    </div>

                    @if ($errors->has('license_plate'))
                    <span class="text-danger">{{ $errors->first('license_plate') }}</span>
                     @endif
                   
</div>


  <div class="form-group col-md-6">
                   
                     <div class="form-group">
                      <label for="name">Año</label>
                      <input type="text" class="form-control" name="year" id=""  placeholder="Año" maxlength="7" minlength="4" value="{{$car->year}}"  required>
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
                          <option value="{{$client->id}}"
                          
                          @if($client->id == $car->client_id){
                            selected
                          }
                          @endif
                          
                          >{{$client->name}}</option>
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
                      <input type="text" class="form-control" name="viscosity" id="" value="{{$car->viscosity}}" placeholder="Viscosidad">
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



                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('cars.index')}}" class="btn btn-light">Cancelar</a>

                

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection


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


@section('scripts')

{!! Html::script('melody/js/dropify.js') !!}
{!! Html::script('melody/js/sweetalert2.js') !!}
@endsection



