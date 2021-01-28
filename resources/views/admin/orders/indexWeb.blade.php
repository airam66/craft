@extends('layouts.main')


@section('content')

<div class="box box-primary">

   <div class="box-header ">
      <div class="row">
          @if($fecha1 == $fecha2)
             <h2 class="box-title col-md-5">Listado de Pedidos Web</h2>
         @else
             <h2 class="box-title col-md-8">Listado de Pedidos Web desde {{$fecha1}} hasta {{$fecha2}}.</h2>
         @endif
      </div>

      <div class="row">
        <div class='col-sm-4 pull-right'>
          <br>
            <form route='shoppingcarts.index'  method="GET">
            <div class="input-group">
              <input type="text" name="searchClient" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
           </form>
       </div>


        <div class='col-sm-6 pull-left'>
          <br>
           <form route='shoppingcarts.index'  method="GET">
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">
                        <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-search"></i>
                                  </button>
                  </div>
                </div>
              </div>

            </form>
         </div>
       </div>

     <div class="box-body" id="shoppingcarts">              
      @if($shoppingcarts->isNotEmpty()) 
        <table id="table table-striped" class="display table table-hover" cellspacing="0" width="100%">
          
		        <thead>
		            <tr>
		                <th>Fecha Pedido</th>
		                 <th>Fecha Entrega</th>
		                <th>Cliente</th>
                    <th>Saldo a pagar</th>
		                <th></th>
		                <th></th>
 
               </tr>
		        </thead>
		     
       
                <tbody id="mostrar">
                   @foreach ($shoppingcarts as $order) 
                         
			                <tr>
                              <td>{{$order->created_at->format('d/m/Y')}}</td>
                              <td>{{date('d/m/Y', strtotime($order->delivery_date))}}</td>
                             <td>
                             @if ($order->client!=null)
                              {{$order->client->name}}
                              @endif
                                </td>
                              <td>${{$order->total}}</td>
                              <th>       
                                 <a href="{{route('shoppingcarts.createOrders',$order->id)}}"> <button  type="button" class="btn btn-success"  ><i class="glyphicon glyphicon-check"></i> 
                                 </button></a>                               
                              </th>
                              <th>
                                  {!!Form::open(['route'=>['orders.destroy',$order->id],'method'=>'DELETE'])!!}
                                        <button type="" onclick="return confirm('¿Seguro dará de baja este pedido?')" class="btn btn-danger" name="delete">
                                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                                        </button> 
                                   {!!Form::close()!!}
			                        </td>
			               </tr>

                 
                         
                    @endforeach

              </tbody>
         </table>
         <div class="text-center">
         {!!$shoppingcarts->render()!!}
        </div>
 
        @else
        <div class="alert alert-dismissable alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <p>No se encontró ningún pedido.</p>
        </div>

        @endif

     </div>
 </div>

@endsection

@section('js')
 <script type="text/javascript">

$('.input-daterange input').each(function() {
    $(this).datepicker({
         language: "es",
         autoclose: true,
         format:"dd/mm/yyyy"
    });
});


</script>

<script type="text/javascript">

$('#favoritesModalStatus').on('shown.bs.modal', function () {
  $('.yo').focus()
})

function productStockProvider(){
}


</script>

@endsection