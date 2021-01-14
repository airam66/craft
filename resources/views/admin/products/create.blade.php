@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">

            <h3 class="box-title">NUEVO PRODUCTO</h3>
          
          </div>
         
          <div class="box-body">
            
          {!! Form::open(['route'=>'products.store', 'method'=>'POST', 'files'=>true])!!}
            
              
              {!! Field::text('name', ['class'=>'form-control','value'=>'old(name)'])!!}
            
              
              {!! Field::select('category_id', $categories, ['class'=>'select-category form-control','empty'=>'Seleccione una categoria'])!!} 
      
              {!! Field::number('code')!!}
  
              {!! Field::file('image')!!}
                        
              {!! Field::select('events[]', $events, ['class'=>'select-tag','multiple'])!!}
            
              {!! Field::select('line_id', $lines ,['class'=>'select-lines','empty'=>'Seleccione una linea'])!!} 

              {!! Field::select('brand_id', $brands, ['class'=>'select-brands','empty'=>'Seleccione una marca'])!!} 

              {!! Field::text('description',null, ['class'=>'form-control'])!!}
              
              <div class="controls col-md-4" style=" padding-left: 0px">
             {!! Field::number('purchase_price',null, ['class'=>'form-control','step'=>'any'])!!}
             </div>
              <div class="col-md-3 col-md-offset-1">
              {!! Field::number('retail_price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>
              <div class="col-md-3 col-md-offset-1">
              {!! Field::number('wholesale_price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>
              <div class="col-md-4" style=" padding-left: 0px">
              {!! Field::number('stock')!!}
                </div>
                <div class="col-md-7 col-md-offset-1">
              {!! Field::number('wholesale_cant')!!}
                </div>
              <div class= "form-group">
              {!! Form::label('status','Estado')!!}
              {!! Form::select('status', ['activo'=>'activo','inactivo'=>'inactivo'],null,['class'=>'form-control'])!!} 
              </div>
              <div class="form-group text-center">
              {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
              <a class="btn btn-danger" href="{{ route('products.index') }}">Cancelar</a>
              </div>
              
              {!! Form::close() !!}
          </div>
          <!-- /.box-body -->
        </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
  $('.select-tag').chosen({
    placeholder_text_multiple: "Seleccione los eventos",
    no_results_text: "No se encontró",
  });
  $('.select-category').chosen();
  $('.select-brands').chosen();
  $('.select-lines').chosen();

</script>
<script >
  $('#purchase_price').on('keyup', function(){$('#wholesale_price').val(parseFloat(this.value)+this.value*{{$porcentage->wholesale_porcentage}}/100);$('#retail_price').val(parseFloat(this.value)+this.value*{{$porcentage->retail_porcentage}}/100);});
</script>
@endsection
