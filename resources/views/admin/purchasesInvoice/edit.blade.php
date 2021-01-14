@extends('layouts.main')
 
 
@section('content')
   
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-12">

        <!-- Default box -->
      <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">EDITAR FACTURA DE COMPRA</h3>
         </div>
      <div class="box-body">
          {!! Form::model($purchaseInvoice,['route'=>['purchasesInvoice.update',$purchaseInvoice->id], 'method'=>'PATCH'])!!}
          <section>

              <div class="row">
                                   
                      <div class="col-md-3 pull-left">
                         <h3  style="color:gray; font-size: 22px;"><b>Factura N°: {{$purchaseInvoice->number_invoice}}</b></h3>                       
                      </div>
                      <div class="col-md-6 pull-right">
                       <h3 style="color:gray; font-size: 22px;"> <b>Fecha: {{$purchaseInvoice->created_at->format('d-m-Y')}}</b></h3>
                      </div>
                      
              </div>

      
              <div class="border">
                <h3>Proveedor</h3>
                <div class="row ">
                        <div class="col-md-3 pull-left" >
                                  <h4><strong>Cuit: </strong> {{$purchaseInvoice->provider->cuit}} </h4>
                                 <input id="cuit"  class="form-control myfactura" value="{{$purchaseInvoice->provider->cuit}}" type="hidden" >
                                 
                                  
                         </div>

                         <div class="col-md-6  pull-right">
                           
                            <h4><strong>Proveedor: </strong> {{$purchaseInvoice->provider->name}}</h4>

                             <input id="provider_id" name="provider_id" class="form-control myfactura" value=" {{$purchaseInvoice->provider->id}}" type="hidden" >
                            
                       </div>
                       
                    
                </div>
              </div>
              <hr>

              <div class="panel-body borde"><!--busqueda prorducto-->
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

                   <div class="col-md-2" style="margin-left: 220px;">
                        {!! form::label('Cantidad')!!}
                        <input class="form-control" id="amount" name="amount" type="number" 
                        onkeyup="">
                    </div>
                   
                   <div class="col-md-2">
                       {!!Field::number('purchase_price',null, ['step'=>'any'])!!} 
 
                    </div>
                                         
                 </div>
                 <div class="row " >
                    <div class="col-md-6 pull-left">
                         {!!Field::text('name',null,['disabled'])!!}
                    </div>
                     
                    <div class="col-md-4  pull-left">
                         {!!Field::text('brand',null,['disabled'])!!}
                    </div>


                    <div class="col-md-2 pull-right">
                      <button type="button" id="btn_add"  class="btn pull-right" title="Agregar producto">
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
                      @php ($a = 0)
                      @foreach($details as $detail)
                      <tr class="selected" id={{$a}}>
                          <td><button type="button" class="btn btn-danger" onclick="deletefila({{$a}},{{$detail->subTotal}});">X</button></td>
                          <td> <input readonly type="hidden" name="dproduct_id[]" value="{{$detail->product_id}}">{{$detail->product_name}}</td> 

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
                        <h3 style="color:white;">Total</h3>
                      </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th class="text-center">Total:</th>
                          <td class="text-center">$<input type="number" id="TotalCompra" name="TotalCompra" value="{{$purchaseInvoice->total}}" step="any" class="mi_factura"></td>
                        </tr>
                      </table>
                    </div>
                  </div><!-- /.col -->
              </div>
        
              <div class="row no-print">
                  <div class="col-xs-12">
                        <div class="form-group text-center">
                        {!! Form::submit('Guardar',['class'=>'btn btn-primary','onclick'=>'verifyProducts()'])!!}

                        <a class="btn btn-danger" href="{{ route('purchasesInvoice.index') }}">Cancelar</a>
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
         TotalCompra= (parseFloat($('#TotalCompra').val())+parseFloat(Subtotal[cont])).toFixed(2);

              var fila='<tr class="selected" id="'+cont+'"><td><button type="button" class="btn btn-danger" onclick="deletefila('+cont+','+Subtotal[cont]+');">X</button></td><td> <input readonly type="hidden" name="dproduct_id[]" value="'+product_id+'">'+name+'</td> <td>'+brand+'</td> <td>$<input readonly type="number" step="any" name="dprice[]" value="'+price+'" class="mi_factura"></td> <td><input readonly type="number" name="damount[]" value="'+amount+'" class="mi_factura"></td> <td>$'+Subtotal[cont]+'</td> </tr>';
          cont++;
          clear();
        $('#TotalCompra').val(TotalCompra);
        $('#details').append(fila);

     
  }else{
        alert("Error al ingresar detalle de la cotización, revise los datos del producto");
  }
}

function deletefila(index,subTotal){
 
  TotalCompra= (parseFloat($('#TotalCompra').val())-subTotal).toFixed(2);
  $('#TotalCompra').val(TotalCompra);
  $('#'+index).remove();
 }

 function clear(){
   
    $('#code').val('');
    $('#name').val('');
    $('#purchase_price').val('');
     $('#amount').val('');
    $('#brand').val('');
 
 }

 
 //verificar que se haya agregado por lo menos un producto
  function verifyProducts(){
    
  if ($('#TotalCompra').val()==0.00) {
    alert("Debe agregar por lo menos un producto");
    event.preventDefault();
  }

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