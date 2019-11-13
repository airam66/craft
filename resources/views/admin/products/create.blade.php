@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">

            <h3 class="text-center titulo_h">NUEVO PRODUCTO</h3>
          
          </div>
          <div class="box box-info">
          <div class="box-body">
            
          {!! Form::open(['route'=>'products.store', 'method'=>'POST', 'files'=>true])!!}
            
              <div class= "form-group titulo_h4">
              {!! Field::text('name', ['class'=>'form-control','value'=>'old(name)'])!!}
              </div>
              <div class= "form-group titulo_h4">
              {!! Field::select('category_id', $categories, ['class'=>'select-category','empty'=>'Seleccione una categoria'])!!} 

              </div>
              <div class= "form-group titulo_h4">
              {!! Field::number('code')!!}
              </div>
              <div class= "form-group titulo_h4">
                  {!! Field::file('image')!!}
              </div>
              
              <div class= "form-group titulo_h4">
              {!! Form::label('events','Evento')!!}
              {!! Form::select('events[]', $events ,null, ['class'=>'form-control select-tag','multiple'])!!}
              </div> 
              <div class= "form-group titulo_h4">
              {!! Field::select('line_id', $lines ,['class'=>'select-lines','empty'=>'Seleccione una linea'])!!} 
              </div>
              <div class= "form-group titulo_h4">
              {!! Field::select('brand_id', $brands, ['class'=>'select-brands','empty'=>'Seleccione una marca'])!!} 

               </div>

              <div class="form-group titulo_h4">
              {!! Field::text('description',null, ['class'=>'form-control'])!!}
              </div>
              
              <div class="controls col-md-4 titulo_h4" style=" padding-left: 0px">
             {!! Field::number('purchase_price',null, ['class'=>'form-control','step'=>'any'])!!}
             </div>
              <div class="col-md-3 col-md-offset-1 titulo_h4">
              {!! Field::number('retail_price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>
              <div class="col-md-3 col-md-offset-1 titulo_h4">
              {!! Field::number('wholesale_price',null, ['class'=>'form-control','step'=>'any'])!!}
              </div>
              <div class="titulo_h4 col-md-4" style=" padding-left: 0px">
              {!! Field::number('stock')!!}
                </div>
                <div class="titulo_h4 col-md-7 col-md-offset-1">
              {!! Field::number('wholesale_cant')!!}
                </div>
              <div class= "form-group titulo_h4 ">
              {!! Form::label('status','Estado')!!}
              {!! Form::select('status', ['activo'=>'activo','inactivo'=>'inactivo'],null,['class'=>'form-control'])!!} 
              </div>
              <div class="form-group text-center">
              {!! Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
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
  });
  $('.select-category').chosen();
  $('.select-brands').chosen();
  $('.select-lines').chosen();

</script>
<script >
  $('#purchase_price').on('keyup', function(){$('#wholesale_price').val(parseFloat(this.value)+this.value*{{$porcentage->wholesale_porcentage}}/100);$('#retail_price').val(parseFloat(this.value)+this.value*{{$porcentage->retail_porcentage}}/100);});
</script>
@endsection
