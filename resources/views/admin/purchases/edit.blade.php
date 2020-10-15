@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">EDITAR ORDEN DE COMPRA</h3>
         </div>
      <div class="box-body">
          {!! Form::model($purchase,['route'=>['purchases.update',$purchase->id], 'method'=>'PATCH', 'files'=>true])!!}
          <section>
              

              <div class="row">
                                   
                      <div class="col-md-3 pull-left">
                         <h3  style="color:gray; font-size: 22px;"><b>Orden de Compra N°:{{$purchase->id}}</b></h3>                       
                      </div>
                      <div class="col-md-6 pull-right">
                       <h3 style="color:gray; font-size: 22px;"> <b>Fecha: {{$purchase->created_at->format('d-m-Y')}}</b></h3>
                      </div>
                      
              </div>
      
              <div class="border">
                <h3>Proveedor</h3>
                <div class="row ">
                         <div class="col-md-3 pull-left" >
                           
                           <h4><strong>Cuit: </strong> {{$purchase->provider->cuit}} </h4>
                           <input id="cuit"  class="form-control myfactura" value="{{$purchase->provider->cuit}}" type="hidden" >
                       </div>
                       
                      <div class="col-md-6  pull-right">
                            
                            <h4><strong>Nombre: </strong> {{$purchase->provider->name}}</h4>
                            <input id="provider_id" name="provider_id" class="form-control myfactura" value=" {{$purchase->provider->id}}" type="hidden" >
                            
                      </div>
                </div>
              </div>
              <hr>

              <!--busqueda producto-->
              <div class="borde">
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
                       {!!Field::number('purchase_price',null,['disabled','step'=>'any'])!!} 
 
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
                    <table id="details" class="table table-striped table-bordered table-condensed table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Eliminar</th>
                          <th>Nombre</th>
                          <th>Marca</th>
                          <th>Precio Estimado</th>
                          <th>Cantidad</th>
                          <th>Subtotal Estimado</th>
                        </tr>
                      </thead>

                      <tbody id="detail">
                      @php ($a = 0)
                      @foreach($details as $detail)
                      <tr class="selected" id={{$a}}>
                          <td><button type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</button></td>
                          <td><input readonly type="hidden" name="dproduct_id[]" value="{{$detail->product_id}}">{{$detail->product_name}}</td> 

                          <td>{{$detail->brand_name}}</td> 

                          <td>$<input readonly type="number" name="dprice[]" value="{{$detail->price}}" class="mi_factura"></td> 
                         <td><input readonly type="number" name="damount[]" value="{{$detail->amount}}" class="mi_factura"></td> 
                         <td>$<input id="dsubTotal{{$a}}" name="dsubtTotal" class="mi_factura" type="number" value="{{$detail->subTotal}}"></td>
                       </tr>

                        @php ($a++) 
                       @endforeach  
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
                          <th class="text-center">Total:</th>
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value="{{$purchase->total}}" step="0.01" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>
        
              <div class="row no-print">
                  <div class="col-xs-12">
                      

                      <div class="form-group text-center">
                        {!! Form::submit('Guardar',['class'=>'btn btn-primary','onclick'=>'verifyProducts()'])!!}
                         <a class="btn btn-danger" href="{{ route('purchases.index') }}">Cancelar</a>
                       </div>
                  </div>
                </div>
             
              {!! Form::close() !!}
              </section><!-- /.content -->
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

<script src="{{asset('js/completeProducts.js')}}"></script>
@endpush

@section('js')

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

      
         Subtotal[cont]=(amount*price).toFixed(2);
        // console.log(Subtotal[cont]);
         TotalCompra= (parseFloat($('#TotalCompra').val())+parseFloat(Subtotal[cont])).toFixed(2);

              var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td><td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+name+'</td> <td>'+brand+'</td> <td>$<input readonly type="number" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$'+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#TotalCompra').val(TotalCompra);
        $('#details').append(fila);

     
  }else{
        alert("Error al ingresar detalle de la cotización, revise los datos del producto");
  }
}

function deletefila(index,subTotal){
  console.log(index);
  TotalCompra= (parseFloat($('#TotalCompra').val())-subTotal).toFixed(2);

  $('#TotalCompra').val(TotalCompra);
   console.log(TotalCompra);
  $('#'+index).remove();
 }

 function verifyProducts(){
  if ($('#TotalCompra').val()==0.00) {
    alert("Debe agregar por lo menos un producto");
    event.preventDefault();
  }
}

 function clear(){
   
    $('#code').val('');
    $('#name').val('');
    $('#purchase_price').val('');
     $('#amount').val('');
    $('#brand').val('');
    $('#stock').val('');
 
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













