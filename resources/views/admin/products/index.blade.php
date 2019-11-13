@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h2 class="text-center">LISTADO DE PRODUCTOS</h2>

 <input type ='button' class="btn btn-success col-md-1 col-md-offset-0"   value = 'Agregar' onclick="location.href = '{{ route('products.create') }}'"/> 
                   <!-- search name form -->
      <form route='admin.products.index'  method="GET" class="col-md-3 col-md-offset-5">
            <div class="input-group">
               @if($searchName !=null) 
                  <input id="searchName" type="text" name="name" class="form-control" placeholder="Nombre..." value="{{$searchName}}">
               @else 
                  <input id="searchName" type="text" name="name" class="form-control" placeholder="Nombre...">
               @endif 
              <span class="input-group-btn">
                <button type="submit" name="searchName" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
            <!-- search event form -->
     
        <form  'admin.products.index' method="GET" class="col-md-3 col-md-offset-0 ">
            <div class="input-group">
              @if($searchEvent !=null) 
                <input type="text" id="searchEvent" name="event" class="form-control"  value="{{$searchEvent}}" placeholder="Evento.."> 
              @else
                <input type="text"  id="searchEvent" name="event" class="form-control" placeholder="Evento..">  
              @endif 
              <span class="input-group-btn">
                <button  type="submit"  name="searchEvent" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
        
          
      
</div>
<div class="box-body">
 @if($products->isNotEmpty())              

 <table id="tabla" class="table table-responsive table-hover" cellspacing="0" >
       
        <thead>
            <tr>
             <th>Codigo</th>
                <th >Nombre</th>
                <th>Stock</th>
                <th>Evento</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Línea</th>
                <th>Imagen</th> 
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody>

   @foreach($products as $product) 

          @if ($product->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(255,128,128);">
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
                <a href="{{route('products.desable',$product->id)}}" title="Deshabilitar" onclick="return confirm('¿Seguro dara de baja el producto?')">
                        <button type="submit" class="btn btn-danger">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
            @else

                <a href="{{route('products.enable',$product->id)}}" onclick="return confirm('¿Seguro dar de alta el producto?')">
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
</tbody>
    </table>
<div class="text-center">

  {!!$products->appends(request()->input())->links()!!}

</div>

@else
<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <p>No se encontraron productos.</p>
</div>

@endif
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
<script type="text/javascript">
 var options={
    url: function(name){
      return baseUrl('admin/searchNameLike?name='+name);
         }, getValue:"name",
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var event = $("#searchEvent").getSelectedItemData();
                          $('#searchEvent').val(event.name);
                    },
                    onKeyEnterEvent: function () { 
                        var event = $("#searchEvent").getSelectedItemData();
                          $('#searchEvent').val(event.name);

                    }
                }
   };
  
  $("#searchEvent").easyAutocomplete(options);
</script>

<script type="text/javascript">
 var options={
    url: function(name){
      return baseUrl('admin/searchNameProduct?name='+name);
         }, getValue:"name",
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var product = $("#searchName").getSelectedItemData();
                          $('#searchName').val(product.name);
                    },
                    onKeyEnterEvent: function () { 
                        var product = $("#searchName").getSelectedItemData();
                          $('#searchName').val(product.name);

                    }
                }
   };
  
  $("#searchName").easyAutocomplete(options);
</script>

@endsection