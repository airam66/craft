@extends('layouts.main')
 
 
@section('content')
   
 
<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Nueva Factura de Compra</h3>
         </div>
      <div class="box-body">
          {!! Form::open(['route'=>'purchasesInvoice.store', 'method'=>'POST'])!!}
          <section>
              <div class="row">
                  <div class="col-xs-12">
                    <h3 class="page-header" style="color:gray;">
                        <img src="{{ asset('images/cotillon.png ') }}" width="230" height="80"  >
                     
                      <div class="pull-right">
                         <b>Fecha:{{$date}} </b>
                      </div>
                      
                    </h3>
                  </div><!-- /.col -->
              </div>


              <div class="border">
                <div class="row ">
                       
                      <div class="col-md-3 pull-left" >
                           
                           {!!Field::text('number_invoice',null)!!}
                       </div>

                       <div class="col-md-3" >
                         <div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
                            {!! form::label('Fecha')!!}
                             <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" data-date-end-date="0d" value="{{ old('datepicker') }}">
                             
                             </div> 

                              @if ($errors->has('datepicker'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('datepicker') }}</strong>
                                        </span>
                             @endif
                          </div>
                       
                      </div>
                       
                </div>
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
                      <div class="col-md-6  col-md-offset-2">
                            <input id="provider_id" name="provider_id" class="form-control" type="hidden" >
                            {!!Field::text('nombre',null,['disabled'])!!}
                      </div>
                </div>
              </div>
              <hr>

              <div class="panel-body borde"><!--busqueda prorducto-->
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
                   
                   <div class="col-md-2 col-md-offset-2">
                       {!!Field::number('purchase_price',null)!!} 
 
                    </div>
                     <div class="col-md-2">
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="">
                      </div>                    
                 </div>
                 <div class="row " >
                    <div class="col-md-4 pull-left ">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                     
                    <div class="col-md-4  col-md-offset-1 ">
                         {!!Field::text('brand',null,['disabled'])!!}
                    </div>


                    <div class="col-md-2 col-md-offset-1">
                      <button type="button" id="btn_add" class="btn pull-right">
                      <img src="{{ asset('images/images.png ') }}" width="50" height="50">
                      </button>
                    </div>

                 </div>
              </div>
              <hr>

               <!-- Table row -->
                  <div class="col-xs-12 table-responsive">
                    <table id="details" class="display table table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Nombre</th>
                          <th>Marca</th>
                          <th>Precio Compra</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>

                      <tbody id="detail">
                         
                      </tbody>

                    </table>
                  </div><!-- /.col -->


                  <div class="row">
                 
                  <div class="col-xs-6 pull-right">
                      <div class="text-center" style="background-color: gray;">
                        <h3 style="color:white;">Total</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th class="text-center">Total:</th>
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value=0 step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>
        
              <div class="row no-print">
                  <div class="col-xs-12">
                      

                      <div class="form-group">
                        {!! Form::submit('Confirmar',['class'=>'btn btn-primary'])!!}
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

@section('js')


<script>

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
            
                    },
                    onKeyEnterEvent: function () { 
                        var provider = $('#cuit').getSelectedItemData();
                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);

                    }
                }
   };
  
  $("#cuit").easyAutocomplete(options);


</script>
<script type="text/javascript">
  function completeC($id,$number,$name){
    $('#cuit').val($number);
    $('#nombre').val($name);
    $('#provider_id').val($id);
    $('#favoritesModalClient').modal('hide');
  };
</script>


<script >
  function complete($id,$code,$brand,$name,$purchase,$stock){
    $('#code').val($code);
    $('#brand').val($brand);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#purchase_price').val($purchase);
    $('#favoritesModalProduct').modal('hide');
   $('#mostrar').html('');
  };
</script>
<script >
$('#searchC').on('keyup', function(){
  $value=$(this).val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchProvider')}}",
    data:{'searchProvider':$value},
    success: function(data){
      $('#mostrarC').html(data);
    }
    
  })
})

</script>
<script>
$('#searchProducts').on('keyup', function(){
  $value=$(this).val();
  $providerid=$('#provider_id').val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchProducts')}}",
    data:{'searchProducts':$value,'provider_id':$providerid},
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
         TotalCompra= parseFloat($('#TotalCompra').val())+Subtotal[cont];
         console.log(TotalCompra);

              var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td><td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+name+'</td> <td>'+brand+'</td><td>$<input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$ '+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#TotalCompra').val(TotalCompra);
        $('#details').append(fila);

     
  }else{
        alert("Error al ingresar detalle de la cotización, revise la cantidad del producto a vender");
  }
}

function deletefila(index,subTotal){
  console.log(index);
  TotalCompra= parseFloat($('#TotalCompra').val())-subTotal;
  console.log(subTotal);
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
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
     
  }

</script>

<script>

$('#datepicker').datepicker({
     language: "es",
     autoclose: true,
     format:'yyyy/mm/dd'
    ,
    })
</script>

<script>
  function SearchLetter($letter){
  $value=$letter;
  $providerid=$('#provider_id').val();
  $.ajax({
    type: 'get',
    url:  "{{ URL::to('admin/searchLetter')}}",
    data:{'searchL':$value,'provider_id':$providerid },
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
  }
</script>

@endsection
 





