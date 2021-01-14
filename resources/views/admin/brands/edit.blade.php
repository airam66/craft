@extends('layouts.main')

@section('content')
  
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">EDITAR MARCA</h3>
           
          </div>
          <div class="box-body">
            
            {!! Form::model($brand,['route'=>['brands.update',$brand->id], 'method'=>'PATCH'])!!}

             <div class="form-group">
              {!! Field::text('name',null, ['class'=>'form-control'])!!}
             </div>

             <div class="form-group text-center">
                {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                <a class="btn btn-danger" href="{{ route('brands.index') }}">Cancelar</a>

              </div>
          
 
              {!! Form::close() !!}

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>

@endsection