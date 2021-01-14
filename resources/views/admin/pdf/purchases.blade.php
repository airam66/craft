@extends('layouts.main')
@section('content')
<section class="content">
 <div class="row">
  <!--COMPRAS MENSUALES-->
            <div class="col-md-6">

              <div class="box box-warning">
                <div class="box-header">
                  <h4 class="text-center"><b>REPORTE DE COMPRAS MENSUALES AÑO</b></h4>
                </div>
                <div class="box-body">
                    <form action="viewReportPurchase"  method="GET" id="reportPurchases">
                
                         {!! Field::select('from_number', $months, ['empty'=>'Seleccione un mes'])!!}
                         {!! Field::select('to_number', $months, ['empty'=>'Seleccione un mes'])!!} 
                    <div class="text-center">
                          <button type="submit" class="btn btn-primary" id="buttonPurchases">
                                        Ver Reporte
                          </button>
                    </div>
                     </form>  
                           
                              
                </div><!-- /.box-body -->
              </div><!-- /.box -->    
            </div><!-- /.col (left) -->
            <!-- FIN REPORTE COMPRAS MENSUALES-->

            <!--REPORTE COMPRAS A PROVEEDORES-->
            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header">
                  <h4 class="text-center"><b>REPORTE DE COMPRAS A PROVEEDORES</b></h4>
                </div>
                <div class="box-body">
                   <form action='createReportPPurchase'  method="GET" id="reportPPurchases">
                          
                              <div class="input-daterange">
                                {!! Field::text('from_date', ['data-date-end-date'=>'0d','placeholder'=>'Seleccione una fecha'])!!}
                              </div> 

                              <div class="input-daterange">
                                {!! Field::text('to_date', ['data-date-end-date'=>'0d','placeholder'=>'Seleccione una fecha'])!!}
                              </div>
                              
                              <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="buttonPPurchases">
                                      Ver Reporte
                                  </button>
                              </div>
                    </form>

                </div><!-- /.box-body -->
              </div><!-- /.box COMPRAS A PROVEEDORES-->

            </div><!-- /.col (right) -->

    </div><!-- /.row -->
</section>

 @endsection
 @section('js')
<script>
  $('.input-daterange input').each(function() {
    $(this).datepicker({
         language: "es",
         autoclose: true,
         format:"dd/mm/yyyy"
    });
});

$('#buttonPPurchases').click(function(){
    var date1=$('#from_date').val();
    var date2=$('#to_date').val();

    if((date1 && date2) && (date1 < date2 )){
       $('#reportPPurchases').attr('target','_blank');
    }
});

$('#buttonPurchases').click(function(){
    var mes1=$('#from_number').val();
    var mes2=$('#to_number').val();

    if((mes1 && mes2) && (mes1 < mes2 )){
       $('#reportPurchases').attr('target','_blank');
    }
});

</script>


 @endsection