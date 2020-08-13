@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Actualizar Porcentajes de Ventas</h3>
          </div>
          <div class="box-body">
            
            {!! Form::open(['route'=>'porcentages.store', 'method'=>'POST', 'files'=>true])!!}

              <div class= "form-group">
              {!! Field::number('wholesale_porcentage',null, ['class'=>'form-control'])!!}
              </div>

              <div class= "form-group">
              {!! Field::number('retail_porcentage',null, ['class'=>'form-control'])!!}
              </div>

              <div class="form-group text-center">
              {!! Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
               <a class="btn btn-danger" href="{{ route('admin') }}">Cancelar</a>
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
