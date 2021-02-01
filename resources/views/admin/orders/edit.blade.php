@extends('layouts.main')

@section('content')

<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Editar pedido</h3>
         </div>
         
      <div class="box-body">
          {!! Form::model($order,['route'=>['orders.update',$order->id], 'method'=>'PATCH'])!!}
          <section class="order">
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b>Pedido N°:{{$order->id}}</b><br>
                      </div>  
                           
                    </h3>
                  </div><!-- /.col -->
                </div>
               
                <!-- FECHAS DEL PEDIDO--> 
				
				  <div class="panel panel-primary" >
				  <div class="panel-body">
				      <div class="pull-left">
				        <h4><b>Fecha de pedido:{{$order->created_at->format('d/m/Y')}} </b></h4>
				      </div>
                
                       
                         <!--Fecha-->
                      
                        <div class='col-sm-4 pull-right '>
                            <div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
                            <div class="form-group">
                                  <div class='input-group date' >
                                      <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="{{date('d/m/Y', strtotime($order->delivery_date))}}">
                                      <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-time"></span>
                                      </span>
                                  </div>
                              </div>
                            @if ($errors->has('datepicker'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('datepicker') }}</strong>
                                    </span>
                          @endif
                          </div>
                      </div>
                        <h4 class="pull-right"> <b>Fecha de entrega: </b></h4>
                         </div> 
                         </div>
                    <!--Fin de Fecha-->    
                    <!--FIN FECHAS PEDIDO-->       
               
                <!-- info row -->
        <div class="panel panel-default">
          <div class="panel-body"><!--busqueda producto-->
         
            <div class="border">
                <h3>Cliente</h3>
                <div class="row ">
                         <div class="col-md-3 pull-left" >
                           
                           <h4><strong>Cuit/Cuil: </strong> {{$order->client->cuil}} </h4>
                           <input id="cuit"  class="form-control myfactura" value="{{$order->client->cuit}}" type="hidden" >
                       </div>
                       
                      <div class="col-md-6  col-md-offset-2">
                            
                            <h4><strong>Nombre: </strong> {{$order->client->name}}</h4>
                            <input id="client_id" name="client_id" class="form-control myfactura" value=" {{$order->client->id}}" type="hidden" >
                            
                      </div>
                </div>
              </div>
              <hr>
                
                  <h3>Producto</h3>
                <div class="row " >
                    <div class="col-md-3 pull-left" >
                         {!! form::label('Codigo')!!}
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
                       {!!Field::number('price',null, ['disabled'])!!} 
                       <input type="number" id="priceW" name="priceW" style="display:none"> 
                       <input type="number" id="priceR" name="priceR" style="display:none"> 
                    </div>
                    <div class="col-md-2 pull-right ">
                          {!! Field::number('stock' , ['disabled'])!!}
                    </div>
                     <div class="col-md-2 pull-right">
                        <input type="number"  id="wholesale_cant" name="wholesale_cant" style="display:none"> 

                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" >
                        </div>
                    
                 </div>

                <div class="row ">
                    <div class="col-md-6 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>

                    <div class="col-md-4 col-md-offset-2">
                      <button type="button" id="btn_add" class="btn pull-right">
                      <img src="{{ asset('images/images.png ') }}" width="50" height="50">
                      </button>
                    </div>

                </div>
                
                   <!--fin busqueda de producto-->
        </div>
                <!-- Table row -->
                  <div class="col-xs-12 table-responsive">
                    <table id="details" class="table table-striped table-bordered table-condensed table-hover">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>

                     <tbody id="detail">
                      @php ($a = 0)
                      @foreach($details as $detail)
                      <tr class="selected" id={{$a}}>
                          <td><button type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</button></td>
                          <td>{{$detail->product_code}}</td> 
                          <td> <input readonly type="hidden" name="dproduct_id[]" value="{{$detail->product_id}}">{{$detail->product_name}}</td>  

                          <td>$ <input readonly type="number" name="dprice[]" value="{{$detail->price}}" class="mi_factura"></td> 
                         <td><input readonly type="number" name="damount[]" value="{{$detail->amount}}" class="mi_factura"></td> 
                         <td>${{$detail->subTotal}}</td>
                       </tr>

                        @php ($a++) 
                       @endforeach  
                      </tbody>

                    </table>
                  </div><!-- /.col -->
               

                <div class="row">
                  <!-- accepted payments column -->
                 
                  <div class="col-xs-6 pull-right">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table" id="table-total">
                        <tr>
                          <th style="width:60%">Total  @if ($order->discount <> 0 )(-10%)@endif:</th>
                          <td>$<input type="number" name="total" id="total"  value="{{$order->total}}" step="any" class="mi_factura"></td>
                        </tr>
                        <tr style="display:none;">
                          <th>Descuento</th>
                          <td><div class="checkbox">
                                  <label>
                                      <input id="discount" name="discount" type="checkbox" value="10" @if ($order->discount <> 0 ) checked @endif:>
                                      10%
                                  </label>
                              </div></td>
                        </tr>
                        <tr>
                          <th>Adelanto</th>
                          <td>
                              $<input disabled id="advance" value="{{$order->totalPayments()}}" name="advance" type="number" class="mi_factura">
                                     
                                
                        </td>
                        </tr>
                        <tr>
                          <th>Saldo a pagar:</th>
                          <td>$<input type="number" name="balance" id="balance" value="{{$order->total-$order->totalPayments()}}" step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <div class="form-group text-center">
                        {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                        <a class="btn btn-danger" href="{{ route('orders.index') }}">Cancelar</a>
                    </div>
                  </div>
                </div>
              </section><!-- /.content -->

         
 
              {!! Form::close() !!}

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>

@include('partials.searchProductsInvoice')


@endsection

@section('js')
 
<script>

$('#datepicker').datepicker({
     language: "es",
     autoclose: true,
     format:'dd/mm/yyyy'
    ,
    })
</script>

         

<script type="text/javascript">
 var options={
    url: function(q){
      return baseUrl('admin/autocomplete?q='+q);
         }, getValue:"code",
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                          $('#stock').val(product.stock);
                          $('#product_id').val(product.id);
                          $('#name').val(product.name);
                          $('#price').val(product.retail_price);//por defecto
                          $('#priceR').val(product.retail_price);
                          $('#priceW').val(product.wholesale_price);
                          $('#amount').val(0);
                          $('#wholesale_cant').val(product.wholesale_cant);
                    },
                    onKeyEnterEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                          $('#stock').val(product.stock);
                          $('#product_id').val(product.id);
                          $('#name').val(product.name);
                          $('#price').val(product.retail_price);//por defecto
                          $('#priceR').val(product.retail_price);
                          $('#priceW').val(product.wholesale_price);
                          $('#amount').val(0);
                          $('#wholesale_cant').val(product.wholesale_cant);
                    }
                }
   };
  
  $("#code").easyAutocomplete(options);
</script>

<script type="text/javascript">
  function complete($id,$code,$name,$wholesale,$retail,$stock,$amount){
    var am=0;
    $('#stock').val($stock);
     $('#code').val($code);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#price').val($retail);//por defecto
    $('#priceR').val($retail);
    $('#priceW').val($wholesale);
    $('#wholesale_cant').val($amount);
    $('#amount').val(am);
    $('#favoritesModalProduct').modal('hide');
  };
</script>


<script type="text/javascript">

$('#favoritesModalClient').on('shown.bs.modal', function () {
  $('#searchC').focus()
})

function productStockProvider(){
}


</script>
<script>


$('#search').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/search')}}",
    data:{'search':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
})
</script>


<script>
    $('#btn_add').on('click',function(){
        invoice_detail();
    });

  var cont=2000;
  var Totalventa=0;
  var Subtotal=[];
  var TotalventaDisc = 0;

  function invoice_detail(){
    stock=$('#stock').val();
    code=$('#code').val();
    product_id=$('#product_id').val();
    name=$('#name').val();
    price=$('#price').val();
    amount=$('#amount').val();
    
  if (product_id!="" && code!="" && name!="" && price!="" && amount>0){
      Subtotal[cont]=parseFloat(amount)*parseFloat(price);
      Subtotal[cont]=Math.round(Subtotal[cont]*100)/100;
      
      
      var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td> <td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+code+'</td> <td>'+name+'</td> <td>$<input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$'+Subtotal[cont]+'</td> </tr>';
          
      cont++;
      $('#details').append(fila);
      clear(); 
      TotalVenta= calcularSubtotal(); 
      TotalVenta= Math.round(TotalVenta*100)/100;
      TotalventaDisc= TotalVenta;
      if($('#discount').is(':checked')){
          TotalventaDisc = TotalventaDisc - parseFloat(TotalventaDisc*0.1);
          TotalventaDisc= Math.round(TotalventaDisc*100)/100; console.log('entro');
      } 
      $('#total').val(TotalventaDisc);
      Balance=parseFloat(TotalventaDisc)-parseFloat($('#advance').val());
      Balance=Math.round(Balance*100)/100;
      $('#balance').val(Balance); 
      


  }else{
    alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a vender");
  }
}

function calcularSubtotal(){
var total = 0;
  // Aplico un ciclo para recorrer todos los elementos del tag th
$('#details tbody tr').each(function() { 
     
    var columnas = $(this).find("td");
    var subtotal= $(columnas[5]).text(); console.log(subtotal.substr(1));
     total += parseFloat(subtotal.substr(1)) 
          
   });

  return total
}

function deletefila(index,subTotal){
  $('#'+index).remove();
  total=calcularSubtotal();
  if(total != 0){
      if($('#discount').is(':checked')){
        TotalDisc =  total - parseFloat( total * 0.1);
        TotalDisc= Math.round(TotalDisc*100)/100;
        total=TotalDisc;
      
      } 
      $('#total').val(total);
       Balance=parseFloat(total)-parseFloat($('#advance').val());
       Balance=Math.round(Balance*100)/100;
       $('#balance').val(Balance);
  }

  else{
     $('#balance').val(0);
     $('#total').val(0);
  }

  

 }

 function clear(){
    $('#stock').val('');
    $('#code').val('');
    $('#product_id').val('');
    $('#name').val('');
    $('#price').val('');
    $('#priceR').val('');
    $('#priceW').val('');
    $('#wholesale_cant').val('');
    $('#amount').val('');
 }
</script>

 <script>
  function SearchLetter($letter){
  $value=$letter;
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchL')}}",
    data:{'searchL':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
  }
</script>
 


@endsection


