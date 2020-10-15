@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
      <div class="row">
          @if($fecha1 == $fecha2)
                   <h2 class="box-title col-md-5">Listado de Facturas de Compra</h2>
          @else
                   <h2 class="box-title col-md-8">Listado de Facturas de Compra desde {{$fecha1}} hasta {{$fecha2}}..</h2>
          @endif
      </div>
      <div class="row">
       <br>
      <div class='col-sm-6 pull-left'>
           <form route='purchasesInvoice.index'  method="GET">
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">
                        <button type="submit" title="Buscar factura entre las fechas seleccionadas" class="btn btn-primary">
                                  <i class="fa fa-search"></i>
                                  </button>
                  </div>
                </div>
              </div>

            </form>

        </div>
      </div>
      <br>
      <div class="row">
        <div class='col-sm-6'>
           <input type ='button' class="btn btn-success"  title="Agregar" value = 'Agregar' onclick="location.href = '{{ route('purchasesInvoice.create') }}'"/> 
        </div>
      </div>

</div>

<div class="box-body table-responsive no-padding">              
 <table id="tabla table-striped" class="display table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th width="15%" class="text-center">N° Factura Compra</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Total</th>
                <th></th>

                 
            </tr>
        </thead>
     
       
<tbody id="mostrar">
  @if($purchases->isNotEmpty())
   @foreach ($purchases as $key => $purchase) 
         
                @if ($purchase->status!='rechazada' )
                  
                <tr>
                              
                        <td class="text-center">{{$purchase->number_invoice}}</td>
                        
                        <td>{{$purchase->created_at->format('d/m/Y')}}</td>
                        <td>{{$purchase->provider->name}}</td>
                        <td>${{$purchase->total}}</td>
                       
                        <td><a href="{{route('purchasesInvoice.show',$purchase->id)}}" > <button  type="button" title="Ver detalle" class="btn btn-info "  ><span class="fa fa-list" aria-hidden="true" ></span></button></a>
                        <a href="{{route('purchasesInvoice.edit',$purchase->id)}}"  >
                                <button type="submit" title="Editar" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                                </button>
                        </a>

                        </td>
                  </tr>

                    @endif
                         
        @endforeach
       @else

         <tr> <td class="text-center" colspan="8">No se encontraron resultados</td></tr>

      @endif

      </tbody>
    </table>
    <div class="text-center">
        {!!$purchases->appends(request()->input())->links()!!}
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
function myDelete(id){
  $.ajax({

type: "POST",
url: "{{ URL::to('admin/purchases/desable')}}",
data: { id: id }
});

}
</script>


@endsection