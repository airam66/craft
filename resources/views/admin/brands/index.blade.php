@extends('layouts.main')

@section('content')

<div class="box box-primary">

  <div class="box-header ">
    <h1 class="box-title">Listado de Marcas</h1>

    <div class="row">
      
       <input type ='button' class="btn btn-success col-md-1" style=" margin-top: 10px;margin-bottom: 10px;
    margin-left: 15px;"  value = 'Agregar' onclick="location.href = '{{ route('brands.create') }}'"/> 
      <!-- form busqueda -->
        <form route='admin.brands.index'  method="GET" class="col-md-4 col-md-offset-6 ">
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
          <!-- /form  busqueda-->
        
    </div>

  </div>
  <!--Inicio body-->
  <div class="box-body table-responsive no-padding"> 
            

    <table id="tabla" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
              
                <th>Nombre</th>
               <th>Estado</th>
               <th></th>
               
            </tr>
        </thead>
     
        <tbody>
          @if($brands->isNotEmpty())  
           @foreach($brands as $brand) 

                    <tr role="row" class="odd">

                      <td>{{$brand->name}}</td>
                      <td>{{$brand->status}}</td>
                      <td> 
                      
                      <a href="{{route('brands.edit',$brand->id)}}"  title="Editar">
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>


                      <a href="{{route('brands.desable',$brand->id)}}" title="Deshabilitar" onclick="return confirm('¿Seguro desea dar de baja esta marca?')">
                          <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                          </button>
                      </a>
                      </td>
                    </tr>
          @endforeach
         @else
           <tr><td class="text-center" colspan="4">No se encontraron resultados</td></tr>
         @endif
        </tbody>
    </table>
    <div class="text-center">
       {!!$brands->appends(request()->input())->links()!!}
    </div>
   
  </div><!--Fin body-->
</div>

@endsection