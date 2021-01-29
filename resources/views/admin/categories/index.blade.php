@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h1 class="box-title">Listado de Categorias</h1>
<div class="row">    
                   
         <input type ='button' class="btn btn-success col-md-1" style=" margin-top: 10px;margin-bottom: 10px;
    margin-left: 15px;" value = 'Agregar' onclick="location.href = '{{ route('categories.create') }}'"/> 
       
        <!-- search name form -->
        <form route='admin.categories.index'  method="GET" class="col-md-4 col-md-offset-6 ">
            <div class="input-group">
              @if($searchName !=null) 
                  <input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{$searchName}}">
               @else 
                  <input type="text" name="name" class="form-control" placeholder="Nombre...">
               @endif 
              
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
       
</div>
</div>

<div class="box-body table-responsive no-padding">     

 
 <table id="tabla" class="table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th style="width:10px">Codigo</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Imagen</th> 
                <th></th>
            </tr>
        </thead>
     
       
<tbody>
  @if($categories->isNotEmpty())
   @foreach($categories as $category) 

          @if ($category->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(247, 212, 212);">
          @endif
            <td class="text-center">{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>

            <td>{{$category->status}}</td>

            <td> 
            @if($category->extension!=null)
                   <div>
                  
                  <a data-toggle="modal" data-target="#favoritesModalCategoryImage{{$category->id}}" title="Ver imagen">
                   <img src="{{ asset('images/categories/'.$category->extension)  }}" width="40" height="40" style="cursor: pointer;"> 
                   </a>
                   @include('admin.categories.imagePopUp')
                   </div>
            @endif
            </td>
            <td>
            @if ($category->status!='inactivo')
             
                <a href="{{route('categories.edit',$category->id)}}" title="Editar" >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>

                     <a href="{{route('categories.desable',$category->id)}}" title="Deshabilitar" onclick="return confirm('¿Seguro desea dar de baja esta categoria?')">
                        <button type="submit" class="btn btn-danger Eliminar">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
            @else
                      <a href="{{route('categories.enable',$category->id)}}" title="Habilitar" onclick="return confirm('¿Seguro desea dar de alta esta categoría?')">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                        </button>
                     </a>
            @endif
            </td>
          
        </tr>
  @endforeach
   @else

    <tr><td class="text-center" colspan="4">No se encontraron resultados</td></tr>

   @endif
   </tbody>
 </table>

 <div class="text-center">
   {!!$categories->appends(request()->input())->links()!!}

 </div>

</div>
</div>

@endsection
