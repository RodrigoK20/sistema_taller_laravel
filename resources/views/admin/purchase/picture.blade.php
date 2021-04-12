@extends('layouts.admin')
@section('title','Comprobante de compra')


@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Detalles de compra
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="#">Compras</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles de compra</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   
                {!! Form::model($purchase ,['route'=>['purchases.upload',$purchase],'method'=>'POST','files' => true]) !!}
                <div class="card-body">
                        <h4 class="card-title d-flex">Comprobante de Compra
                          <small class="ml-auto align-self-end">
                            <a href="" class="font-weight-light" target="">Seleccionar Archivo</a>
                          </small>
                        </h4>
                        <input type="file"  name="picture" id="picture" class="dropify" />
                    </div>
                    


                </div>

        
                <div class="card-footer text-muted">
                 <button type="submit" class="btn btn-warning mr-2">Subir comprobante</button>
                    <a href="{{route('purchases.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
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




@endsection


@section('scripts')

{!! Html::script('melody/js/dropify.js') !!}
{!! Html::script('melody/js/sweetalert2.js') !!}
@endsection


