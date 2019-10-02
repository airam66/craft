@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="text-center">NUEVA CATEGORÍA</h3>
          </div>
          <div class="box box-info">
          <div class="box-body box-info">
            
            {!! Form::open(['route'=>'categories.store', 'method'=>'POST','files'=>true])!!}

             <div class="form-group">
              <h4>{!! Field::text('name',null, ['class'=>'form-control'])!!}</h4>
             </div>

              <div class="form-group">

              <h4>{!! Form::label('descriptin','Descripción')!!}</h4>
              {!! Form::text('description'," ", ['class'=>'form-control'])!!}
              </div>
              
              <h4>{!! Field::file('image')!!}</h4>
            
              <div class= "form-group">
  
             <h4> {!! Form::label('status','Estado')!!}
              {!! Form::select('status', ['activo'=>'activo','inactivo'=>'inactivo'],null,['class'=>'form-control'])!!}</h4>
              </div>
              <div class="form-group text-center">
              {!! Form::submit('Registrar',['class'=>'btn btn-primary'])!!}
              <a class="btn btn-danger" href="{{ route('categories.index') }}">Cancelar</a>
              </div>
          
 
              {!! Form::close() !!}

          </div>
        </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
    </div>
  </div>
@endsection
