@extends('layouts.admin')
@section('title','Editar servicio taller')


@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Servicios Taller
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('workshops.index')}}">Listado Servicios Taller</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>

        
    </div>

    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Editar servicio</h4>
                </div>
                {!! Form::model($workshop ,['route'=>['workshops.update',$workshop],'method'=>'PUT']) !!}
  
          
                <div class="form-group">
                      <label for="name">Servicio</label>
                      <input type="text" class="form-control" name="name_service" id="name_service"  value="{{$workshop->name_service}}" required>
                    </div>

                    @if ($errors->has('name_service'))
                    <span class="text-danger">{{ $errors->first('name_service') }}</span>
                     @endif
                    <br>

                    <div class="form-group">
                      <label for="description">Descripción</label>
                      <input type="text" class="form-control" name="description" id="description" value="{{$workshop->description}}">
                    </div>
                  <br>
                    @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                     @endif

                     <div class="form-group">
                      <label for="description">Mano de obra ($)</label>
                      <input type="text" class="form-control" name="cost" id="cost" value="{{$workshop->cost}}" required>
                    </div>
                  <br>
                    @if ($errors->has('cost'))
                    <span class="text-danger">{{ $errors->first('cost') }}</span>
                     @endif

                     <div class="form-group">
                      <label for="category_id">Categoría Taller</label>
                      <select class="form-control" name="category_work_id" id="category_work_id" >
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                          @if($category->id == $workshop->category_work_id){
                            selected
                          }
                          @endif
                        
                        >{{$category->name}}
                        
                        </option>
                        @endforeach
                      </select>
                    </div>


                <button type="submit" class="btn btn-warning mr-2">Actualizar</button>
                
                <a href="{{route('workshops.index')}}" class="btn btn-light">Cancelar</a>

                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection




