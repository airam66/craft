@extends('layouts.main')

@section('content')

 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">NUEVO USUARIO</h3>
          </div>
          
          <div class="box-body">
            
            {!! Form::open(['route'=>'users.store', 'method'=>'POST','files'=>true])!!}

              {!! Field::text('name')!!}
        
              {!! Field::email('email')!!}

              {!! Field::password('password')!!}

              {!! Field::password('password_confirmation')!!}

              {!! Field::select('role_id', $roles ,['class'=>'select-roles','empty'=>'Seleccione un rol'])!!}
             
              {!! Field::file('photo')!!}
           
             
              <div class="form-group text-center">
                {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
                <a class="btn btn-danger" href="{{ route('users.index') }}">Cancelar</a>
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

@section('js')
<script>
  $('.select-roles').chosen();

</script>
@endsection