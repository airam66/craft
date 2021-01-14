@extends('layouts.main')

@section('content')

<div class="box box-primary">

     <div class="box-header ">
        <h2 class="box-title">Listado de Proveedores</h2>    
        
       <div class="row">
          <input type ='button' class="btn btn-success col-md-1" style=" margin-top: 10px;margin-bottom: 10px;
            margin-left: 15px;"  value = 'Agregar' onclick="location.href = '{{ route('providers.create') }}'"/> 
          
          <!-- campo de busqueda-->
          <form route='admin.providers.index'  method="GET" class="col-md-4 col-md-offset-6 ">
              <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
              </div>
          </form>
            <!-- fin campo de busqueda -->
        </div>
     

      </div>
     
     <div class="box-body table-responsive no-padding">              
    
       <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
          <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Provincia</th> 
                <th></th>
            </tr>
          </thead>
     
       
          <tbody>
           @if($providers->isNotEmpty())  
             @foreach($providers as $provider) 

		          @if ($provider->status!='inactivo')
		            <tr role="row" class="odd">
		          @else
		            <tr role="row" class="odd" style="background-color: rgb(247, 212, 212);">
		          @endif
		            
		            <td>{{$provider->name}}</td>
		            <td>{{$provider->address}}</td>
		            <td>{{$provider->phone}}</td>
		            <td>{{$provider->province}}</td>
                    <td>
                      <button type="button" title="Ver productos" class="btn btn-info " data-toggle="modal" id="first" data-title="Detail" data-target="#favoritesModalProduct" onclick="list({{$provider->id}})">
                          <i class="fa fa-list"></i>
                      </button>
                      
                    
                     @if ($provider->status!='inactivo')
                        <a href="{{route('providers.addProducts',$provider->id)}}" title="Agregar productos" >
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-barcode"></i>
                                
                            </button>
                        </a> 
                       <a href="{{route('providers.edit',$provider->id)}}" title="Editar" >
                            <button type="submit" class="btn btn-warning">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                                
                            </button>
                        </a> 

                        

                        <a href="{{route('providers.desable',$provider->id)}}" onclick="return confirm('¿Seguro dará de baja este proveedor?')" title="Dar de baja">
                            <button type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                            </button>
                        </a> 
                    @else
                       <a href="{{route('providers.enable',$provider->id)}}" onclick="return confirm('¿Seguro desea dar de alta este proveedor?')" title="Dar de alta">
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </button>
                         </a>

                    @endif
                    @include('admin.providers.providerProduct')
                  </td>
		           
              </tr>
               @endforeach
               @else
                 <tr><td class="text-center" colspan="4">No se encontraron resultados</td></tr>
               @endif
            </tbody>
        </table>
        <div class="text-center">
          {!!$providers->appends(request()->input())->links()!!}
        </div>


    </div>

</div>


@endsection


@section('js')

<script>
function list($id){
 
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/listProducts')}}",
    data:{'provider_id':$id},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
}
</script>
@endsection