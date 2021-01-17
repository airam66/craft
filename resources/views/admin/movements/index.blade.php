@extends('layouts.main')

@section('content')
<div class="box box-primary">

   <div class="box-header ">
      <div class="row">
         @if($fecha1 == $fecha2)
             <h1 class="box-title col-md-5">Movimientos del día</h1>
         @else
             <h1 class="box-title col-md-8">Movimientos desde {{date("d-m-Y",strtotime($fecha1))}} hasta {{date("d-m-Y",strtotime($fecha2))}}</h1>
         @endif
         
      </div>
      <div class="row">
        <br>
        <div class='col-sm-6 pull-left'>
           <form route='movements.index'  method="GET">
              <div class="input-group date">
                 <div class="input-group input-daterange">
                  <div class="input-group-addon">DESDE</div>
                    <input type="text" class="form-control" id="fecha1" name="fecha1" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">HASTA</div>
                  <input type="text" class="form-control" id="fecha2" name="fecha2" data-date-end-date="0d" placeholder="Seleccione una fecha">
                  <div class="input-group-addon">
                        <button type="submit" class="btn btn-primary" name="searchDate" title="Buscar"><i class="fa fa-search"></i>
                        </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
         </div>
         <br>

         <div class="row">
            <div class="col-sm-6">
                <input type ='button' class="btn btn-success"  value='Agregar' onclick="location.href = '{{ route('movements.create') }}'"/>         
            </div>
         </div>
     </div>
       
      <div class="box-body">
       <div class="table-responsive no-padding" id="movements">      
          <table id="table table-striped" class="display table table-hover" cellspacing="0" width="100%">
          
		        <thead>
		            <tr>
		                <th>Concepto</th>
		                <th>Fecha</th>
		                <th>Hora</th>
		                <th>Tipo</th>
                        <th>Monto</th>
                        <th></th>
                   </tr>
		        </thead>
		     
       
            <tbody id="mostrar">
               @if($movements->isNotEmpty()) 
                   @foreach ($movements as $movement) 
                    <tr>
  			              <td>{{$movement->concept}}</td>
  			              <td>{{$movement->created_at->format('d-m-y')}}</td>  
  			              <td>{{date_format($movement->created_at,'H')}}:{{date_format($movement->created_at,'i')}}</td> 
  			              <td>{{$movement->type}}</td>
  			              <td>$<?=number_format($movement->rode,2, ',' , '.')?></td>
			              </tr>     
                    @endforeach
               @else
                    <tr> <td class="text-center" colspan="8">No se encontraron resultados</td></tr>
               @endif
                </tbody>
            </table>
          </div>
            <br>

             @if($movements->isNotEmpty()) 
            <!-- TABLA TOTAL DE CAJA-->
            <div class="row" style="margin-right: 1px;">
              <div class="pull-right" >
	            <table class="table table-bordered" id="box" style="width: 150px;">
                    <tr style="background-color: #f7c26f;">
	                  <th  class="text-center">TOTAL CAJA</th>
	                </tr>
	                <tr>
	                  <td  class="text-center">$<?=number_format($total,2,',','.') ?></td>   
	                </tr>	                
	             </table>
	           </div>
	           <div class=" pull-right">
	             <table class="table table-bordered" id="outcomes" style="width: 150px">
	                <tr style="background-color: #f7c26f;">
	                  <th  class="text-center">TOTAL SALIDAS</th>
	                </tr>
	                <tr>
	                  <td  class="text-center">$<?=number_format($totalOutcomes,2,',','.') ?></td>  
	                </tr>
	             </table>
	            </div>
	            <div class=" pull-right">
	             <table class="table table-bordered" id="incomes" style="width: 150px">
	                <tr style="background-color: #f7c26f;">
	                  <th  class="text-center">TOTAL ENTRADAS</th>
	                </tr>
	                <tr>
	                  <td  class="text-center">$<?=number_format($totalIncomes,2,',','.') ?></td>
	                  
	                </tr>
	             </table>
	            </div>
            </div>
        

          <div class="row">
            <div class="col-md-12">
               <a href="{{route('reportMovements',[$fecha1,$fecha2])}}" target="_blank" class="pull-right" >
                  <button type="button" id="btn_search" class="btn btn-primary"><i class=" fa fa-file-pdf-o"></i> Generar PDF</button></a>
            </div>
          </div>
          @endif
       
         <div class="text-center">
         {!!$movements->appends(request()->input())->links()!!}
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

@endsection