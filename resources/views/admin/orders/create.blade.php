@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nuevo Pedido</h3>
         </div>
         
      <div class="box-body">
          {!! Form::open(['route'=>'orders.store', 'method'=>'POST', 'files'=>true])!!}
     
                <!-- title row -->
                <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b>Pedido N°:{{$numberOrder}}</b><br>
                        </div>  
                           
                    </h3>
                  </div><!-- /.col -->
                </div>
                <!-- FECHAS DEL PEDIDO--> 
            <div class="panel panel-primary" >
               <div class="panel-body">
                  <div class="pull-left">
                     <h4><b>Fecha: {{$date}}</b></h4>
                  </div>
                
                       
                         <!--Fecha-->
                      
                        <div class='col-sm-4 pull-right '>
                         <div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
                            <div class="form-group">
                                  <div class='input-group date' >
                                      <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="{{ old('datepicker') }}">
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
                      <h4 class="pull-right"> <b>Entrega Pedido: </b></h4>
                         
              </div> 
           </div>    
      
      <div class="panel panel-default">
          <div class="panel-body"><!--busqueda producto-->
         
             <div class="border">
                <h3>Cliente</h3>
                <div class="row ">
                       @include('partials.searchPeople')
                      <div class="col-md-3 pull-left" >
                          
                           {!!Field::text('cuil',null)!!}
                       </div>
                       <div class="pull-left">
                       <br>
                            <button type="button" class="btn btn-primary " data-toggle="modal" id="second" data-title="Buscar" data-target="#favoritesModalClient"><i class="fa fa-search"></i></button>
                           @include('partials.searchPeople')
                      </div>
                      <div class="col-md-6  pull-right">
                            <input id="client_id" name="client_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
                      </div>
               </div>
            </div>
                
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
                
<!--find busqueda de producto-->
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

                      <tbody>
                         
                      </tbody>

                    </table>
                  </div><!-- /.col -->
               

                <div class="row">
                    <div class="col-xs-6">
                    </div>
                  <div class="col-xs-6">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td>$<input disabled type="number" id="Subtotalventa" name="Subtotalventa" step="any" class="mi_factura" value="0"></td>
                        </tr>
                        <tr>
                          <th>Descuento</th>
                          <td><div class="checkbox">
                                  <label>
                                      <input id="discount" name="discount" type="checkbox" value="10">
                                      10%
                                  </label>
                              </div></td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td>$<input type="number" id="Totalventa" name="Totalventa" step="any" class="mi_factura" value="0"></td>
                        </tr>

                        <tr>
                          <th>Adelanto</th>
                          <td>$<input id="advance" value="0" name="advance" type="number"/></td>
                        </tr>
                       

                        <tr>
                          <th>Saldo:</th>
                          <td>$<input type="number" name="balance" id="balance"  value="0" step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-xs-12">
                    <div class="form-group text-center">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
                        <a class="btn btn-danger" href="{{ route('orders.index') }}">Cancelar</a>
                    </div>
                    
                  </div>
                </div>
         
              </div>
              {!! Form::close() !!}

         
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
                          document.getElementById(id).focus('#amount');
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
$('#amount').on('keyup', function(){
  var am=parseInt($('#amount').val());
  var maxW=parseInt($('#wholesale_cant').val());
  var pW=$('#priceW').val();
  var pR=$('#priceR').val();
   if (am >= maxW){
   
        $('#price').val(pW);
  }
  else{
    
        $('#price').val(pR);
  }
});
</script>

<script>
$('#advance').on('keyup', function(){ 
  if ($('#advance').val()==''){
    $('#advance').val(0); 
  }
  total=parseFloat($('#Totalventa').val());
  
  balance=parseFloat($('#advance').val());
  
  outStandingBalance=total-balance;
  outStandingBalance=Math.round(outStandingBalance*100)/100;
  
  $('#balance').val(outStandingBalance);
  });
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

<script type="text/javascript">
$('#searchC').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchClient')}}",
    data:{'searchClient':$value},
    success: function(data){
      $('#mostrarC').html(data);
    }
    
  })
})
</script>

<script>
    $('#btn_add').on('click',function(){
        invoice_detail();
    });
  var cont=0;
  var Totalventa=0;
  var TotalventaDisc = 0;
  var Subtotal=[];
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
        
        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+');">X</button></td> <td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+code+'</td> <td>'+name+'</td> <td>$<input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$'+Subtotal[cont]+'</td> </tr>';

        cont++;
        $('#details').append(fila);
        clear();
        Totalventa= calcularSubtotal();
        Totalventa= Math.round(Totalventa*100)/100;
        $('#Subtotalventa').val(Totalventa);
        if($('#discount').is(':checked')){
          TotalventaDisc = Totalventa - parseFloat(Totalventa*0.1);
          TotalventaDisc= Math.round(TotalventaDisc*100)/100;
          $('#Totalventa').val(TotalventaDisc); 
          TotalventaDisc -=  $('#advance').val();
          TotalventaDisc= Math.round(TotalventaDisc*100)/100;
          $('#balance').val(TotalventaDisc);  
        }else{
          $('#Totalventa').val(Totalventa); 
          Totalventa -= $('#advance').val();
          Totalventa= Math.round(Totalventa*100)/100;
          $('#balance').val(Totalventa);    
        } 
  }else{
        alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a vender");
  }
}


function calcularSubtotal(){
var total = 0;
  // Aplico un ciclo para recorrer todos los elementos del tag th
$('#details tbody tr').each(function() { 
     
    var columnas = $(this).find("td"); 
    var subtotal= $(columnas[5]).text();
     total += parseFloat(subtotal.substr(1)) 
          
   });
 
  return total
}

function deletefila(index){
  var Totalventa =0;
   var TotalDisc =0; //hola
  $('#fila'+index).remove();
  Totalventa=calcularSubtotal();
  Totalventa= Math.round(Totalventa*100)/100;
  $('#Subtotalventa').val(Totalventa);
  if($('#discount').is(':checked')){
      TotalDisc = Totalventa - parseFloat(Totalventa*0.1);
      TotalDisc= Math.round(TotalDisc*100)/100;
       $('#Totalventa').val(TotalDisc);
      
  } else{
    $('#Totalventa').val(Totalventa);
  }
       
  if(Totalventa == 0)
  {
    $('#balance').val(0);
    $('#advance').val(0);
    if($('#discount').is(':checked')){
      $('#discount').prop("checked", false);
    }
    
  }
  else{
    TotalDisc -= $('#advance').val();
    TotalDisc= Math.round(TotalDisc*100)/100;
    $('#balance').val(TotalDisc);
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

 <script>
$('#discount').on('click', function(){
 St=$('#Subtotalventa').val();
 St=Math.round(St*100)/100;
 
  if (document.getElementById('discount').checked){
          Tvn=parseFloat(St)-parseFloat(St*0.1);
          Tvn=Math.round(Tvn*100)/100;
            $('#Totalventa').val(Tvn);
            Tvn -= $('#advance').val();
            $('#balance').val(Tvn);
         
  }
  else{
            $('#Totalventa').val(St);
            St -= $('#advance').val();
            St=Math.round(St*100)/100;
            $('#balance').val(St);
         }
});
 </script>


@endsection
 

@push('scripts')

<script src="{{asset('dist/js/completePerson.js')}}"></script>
@endpush