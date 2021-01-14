@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
  <div class="row">
        @if($fecha1 == $fecha2)
             <h2 class="box-title col-md-5">Listado de Ventas</h2>
         @else
             <h2 class="box-title col-md-8">Listado de Ventas desde {{$fecha1}} hasta {{$fecha2}}.</h2>
         @endif
  </div>
      <div class="row">
      <div class='col-sm-4 pull-right'>
          <br>
            <form route='orders.index'  method="GET">
            <div class="input-group">
              <input type="text" name="searchClient" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" title="Buscar comprobantes con el cliente seleccionado." id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
           </form>
       </div>
        
        <br>
        <div class='col-sm-6 pull-left'>
            <form route='invoices.index'  method="GET">
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">
                        <button type="submit" class="btn btn-primary" title="Buscar comprobante entre las fechas seleccionadas.">
                                  <i class="fa fa-search"></i>
                                  </button>
                  </div>
                </div>
              </div>

            </form>

        </div>

      </div>
      <br>
      <div class='col-sm-2 pull-left'>
          <input type ='button' class="btn btn-success "  value = 'Agregar' onclick="location.href = '{{ route('invoices.create') }}'"/> 
        </div>

</div>

<div class="box-body">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th class="text-center">N° Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody id="mostrar">
   @if($invoices->isNotEmpty())
   @foreach ($invoices as $key => $invoice) 
         
                @if ($invoice->status!='inactivo')
                   <tr role="row" class="odd">
                
                @else
                  <tr role="row" class="odd" style="background-color: rgb(247, 212, 212);">
                
                @endif
                 
                        <td class="text-center">{{$invoice->id}}</td>
                        <td>{{$invoice->created_at->format('d/m/Y')}}</td>
                        <td>{{$invoice->client->name}}</td>
                        <td>${{$invoice->total}}</td>
                        <td>
                         

                        <a href="{{route('invoices.show',$invoice->id)}}" > <button  type="button" class="btn btn-info " title="Ver detalle del comprobante." >
                        <span class="fa fa-list" aria-hidden="true" ></span></button></a>

                          @if ($invoice->status!='inactivo')
                             <a href="{{route('invoices.desable',$invoice->id)}}" onclick="return confirm('¿Seguro dara de baja esta venta?')">
                        <button type="submit" class="btn btn-danger" title="Dar de baja un comprobante.">
                          <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>

                     <a href="{{route('invoices.pdf',$invoice->id)}}" target="_blank" > <button  type="button" class="btn btn-primary " title="Imprimir comprobante."  ><i class="fa fa-print"></i> 
                      </button></a>
                       @endif     
        </tr>
        @endforeach

        @else

           <tr> <td class="text-center" colspan="8">No se encontraron resultados</td></tr>

        @endif

     </tbody>
    </table>
    <div class="text-center">
         {!!$invoices->render()!!}
    </div>





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
function myDetail(id){
dir=baseUrl('admin/invoices/'+id);
window.location.replace(dir); 
             
} 


</script>
<script type="text/javascript">
function myDelete(id){
  $.ajax({

type: "POST",
url: "{{ URL::to('invoices/desable')}}",
data: { id: id }
});

}
</script>

@endsection