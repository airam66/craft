@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h1 class="box-title">Listado de Productos</h1>
<div class="row">

 <input type ='button' class="btn btn-success col-md-1"  style=" margin-top: 10px;margin-bottom: 10px;
    margin-left: 15px;" value = 'Agregar' onclick="location.href = '{{ route('products.create') }}'"/> 

                   <!-- search name form -->
      <form route='admin.products.index'  method="GET" class="col-md-4 col-md-offset-6">
            <div class="input-group">
               @if($searchName !=null) 
                  <input id="searchName" type="text" name="name" class="form-control" placeholder="Producto o Evento..." value="{{$searchName}}">
               @else 
                  <input id="searchName" type="text" name="name" class="form-control" placeholder="Producto o Evento...">
               @endif 
              <span class="input-group-btn">
                <button type="submit" name="searchName" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
            
     </div>   
          
  
</div>
<div class="box-body table-responsive no-padding">
              

 <table id="tabla" class="table table-hover" cellspacing="0" >
       
        <thead>
            <tr>
             <th>Codigo</th>
                <th >Nombre</th>
                <th>Stock</th>
                <th>Evento/s</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Línea</th>
                <th>Imagen</th> 
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody>
   @if($products->isNotEmpty()) 
   @foreach($products as $product) 

          @if ($product->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(247, 212, 212);">
          @endif
            <td class="sorting_1">{{$product->code}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->stock}}</td>
            <td style="width:15%">  @foreach($productEvent as $event)
                    
                    @if($event->product_id == $product->id)
                       {{$event->event_name}}. <br>         
                      
                   @endif
                  @endforeach</td>
            <td>{{$product->category->name}}</td>   
            <td>{{$product->brand->name}}</td>
            <td>{{$product->line->name}}</td>
            <td> 
            @if($product->extension!=null)
                    
                    <a  data-toggle="modal" id="first" data-title="detail" title="Ver detalle.." data-target="#favoritesModalProduct{{$product->id}}">
                    <img src="{{asset('images/products/'.$product->extension)}}" width="40" height="40" >
                    </a>
                    
            @endif
            </td>

            <td>
                

            @if ($product->status!='inactivo')
             
                <a href="{{route('products.edit',$product->id)}}" title="Editar"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>
                <a href="{{route('products.desable',$product->id)}}" title="Deshabilitar" onclick="return confirm('¿Seguro desea dar de baja el producto?')">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
            @else

                <a href="{{route('products.enable',$product->id)}}" title="Habilitar" onclick="return confirm('¿Seguro desea dar de alta el producto?')">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                        </button>
                     </a>

            @endif
            @include('admin.products.detailProduct')
            </td>
            <td></td>
           
        </tr>
  @endforeach
  @else

    <tr> <td class="text-center" colspan="8">No se encontraron resultados</td></tr>

  @endif
</tbody>
    </table>
<div class="text-center">

  {!!$products->appends(request()->input())->links()!!}

</div>


</div>

</div>


@endsection

@section('js')

<script>
function list($id){
 
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/listDetailProduct')}}",
    data:{'product_id':$id},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
}
</script>


@endsection