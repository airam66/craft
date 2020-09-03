@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">NUEVA ORDEN DE COMPRA</h3>
         </div>
      <div class="box-body">
          {!! Form::open(['route'=>'purchases.store', 'method'=>'POST', 'files'=>true])!!}
          <section class="invoice">
              <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b>Orden de Compra N°:{{$numberPurchase}}</b><br><br>
                         <b>Fecha: {{$date}}</b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
              </div>
      
              <div class="border">
                <h3>Proveedor</h3>
                <div class="row ">
                       
                      <div class="col-md-3 pull-left" >
                           
                           {!!Field::text('cuit',null)!!}
                       </div>
                       <div class="pull-left">
                       <br>
                            <button type="button" class="btn btn-primary " data-toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalClient"><i class="fa fa-search"></i></button>
                            @include('partials.searchPeople')
                      </div>
                      <div class="col-md-6  pull-right">
                            <input id="provider_id" name="provider_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
                      </div>
                </div>
              </div>
              <hr>
           
           <!--busqueda producto-->
              <div class="borde">
                  <p class="text-aqua">Para agregar productos primero debe seleccionar un proveedor</p>
                  <h3>Producto</h3>
                <div class="row " >
                    <div class="col-md-3 pull-left" >
                         {!! form::label('Código')!!}
                         <input id="code" class="form-control" name="code" type="text" >
                         <input id="product_id" class="form-control " name="product_id" type="hidden" >
                    </div> 
                    <div class="pull-left">
                    <br>
                       <button type="button" class="btn btn-primary pull-left" data-toggle="modal" id="first" data-title="Buscar" data-target="#favoritesModalProduct">
                          <i class="fa fa-search"></i>
                       </button>
                   </div>

                    <div class="col-md-2 pull-right ">
                       {!!Field::number('stock',null,['disabled'])!!}    
                    </div>
                   
                   <div class="col-md-2 pull-right">
                       {!!Field::number('purchase_price',null,['disabled'])!!} 
 
                    </div>
                     <div class="col-md-2 pull-right">
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="">
                      </div>                    
                 </div>
                 <div class="row " >
                    <div class="col-md-6 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                     <div class="col-md-4 pull-left ">
                       {!!Field::text('brand',null,['disabled'])!!}
                     </div>
                     
       
                    <div class="col-md-2 pull-right">
                      <button type="button" id="btn_add" class="btn pull-right" title="agregar producto">
                      <img src="{{ asset('images/images.png ') }}" width="50" height="50">
                      </button>
                    </div>

                 </div>
              </div>
              <hr>

               <!-- Table row -->
                  <div class="col-xs-12 table-responsive">
                    <table id="details" class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Nombre</th>
                          <th>Marca</th>
                          <th>Stock</th>
                          <th>Precio Estimado</th>
                          <th>Cantidad</th>
                          <th>Subtotal Estimado</th>
                        </tr>
                      </thead>

                      <tbody id="detail">
                         
                      </tbody>

                    </table>
                  </div><!-- /.col -->


                  <div class="row">
                 
                  <div class="col-xs-6 pull-right">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total Estimado</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th class="text-center">Total Estimado:</th>
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value=0 step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>
        
              <div class="row no-print">
                  <div class="col-xs-12">
                      

                      <div class="form-group text-center">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                         <a class="btn btn-danger" href="{{ route('purchases.index') }}">Cancelar</a>
                       </div>
                  </div>
                </div>
              </section><!-- /.content -->
              {!! Form::close() !!}
             </div>
 
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>

 @include('partials.searchProductsPurchase')

@endsection

@push('scripts')

<script src="{{asset('js/completeProvider.js')}}"></script>
<script src="{{asset('js/completeProducts.js')}}"></script>
@endpush

@section('js')


<script>
// autocompletado de proveedor
  var options={
    url: function(p){
      return baseUrl('admin/autocompleteProvider?p='+p);
         }, getValue:'cuit',
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var provider = $('#cuit').getSelectedItemData();
                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);
                      
                       $providerid=$('#provider_id').val();
                       $.ajax({
                        type: 'get',
                        url:  "{{ URL::to('admin/detailPurchase')}}",
                        data:{'provider_id':$providerid},
                        success: function(data){
                            $('#detail').html(data);
    
                        }
                       })

                    },
                    onKeyEnterEvent: function () { 
                        var provider = $('#cuit').getSelectedItemData();
                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);

                        $providerid=$('#provider_id').val();
                       $.ajax({
                        type: 'get',
                        url:  "{{ URL::to('admin/detailPurchase')}}",
                        data:{'provider_id':$providerid},
                        success: function(data){
                          $('#detail').html(data);
                         }
                       })
                    }
                }
   };
  
  $("#cuit").easyAutocomplete(options);

</script>




<script>
    $('#btn_add').on('click',function(){
        invoice_detail();
    });

  var cont=2000;
  var TotalCompra=0;
  var Subtotal=[];

  function invoice_detail(){
    stock=$('#stock').val();
     brand=$('#brand').val();
     code=$('#code').val();
    product_id=$('#product_id').val();
    name=$('#name').val();
    price=$('#purchase_price').val();
    amount=$('#amount').val();
    
  if (product_id!="" && code!="" && name!="" && price!="" && amount>0){

      
         Subtotal[cont]=parseFloat(amount)*parseFloat(price);
         Subtotal[cont]=Math.round(Subtotal[cont]*100)/100;
         TotalCompra= parseFloat($('#TotalCompra').val())+Subtotal[cont];
       

              var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td><td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+name+'</td> <td>'+brand+'</td><td>'+stock+'</td> <td>$ <input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$ '+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#TotalCompra').val(TotalCompra);
        $('#details').append(fila);

     
  }else{
        alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a comprar");
  }
}

function deletefila(index,subTotal){
  
  TotalCompra= parseFloat($('#TotalCompra').val())-subTotal;
  
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
 }
function calculateSubtotal(number){

    
    price= $('#dprice'+number).val();
    amount=$('#damount'+number).val();

    if (price=='' || amount==''){
      price=0;
      amount=0;
    }
    subTotal=parseFloat($('#dsubTotal'+number).val());
 
    $('#dsubTotal'+number).val(parseFloat(amount)*parseFloat(price));

    total=parseFloat($('#TotalCompra').val());
    
    total=total-subTotal;
    
    total=total+parseFloat($('#dsubTotal'+number).val());
   
   $('#TotalCompra').val(total);
  }

 function clear(){
    $('#stock').val('');
    $('#code').val('');
    $('#product_id').val('');
    $('#name').val('');
    $('#purchase_price').val('');
    $('#brand').val('');
    $('#amount').val('');
 }
</script>


<script>
  function productStockProvider(){
     $providerid=$('#provider_id').val();
                       $.ajax({
                        type: 'get',
                        url:  "{{ URL::to('admin/detailPurchase')}}",
                        data:{'provider_id':$providerid},
                        success: function(data){
                            $('#detail').html(data);
    
                        }
                       });
  }

</script>


 
@endsection
 

