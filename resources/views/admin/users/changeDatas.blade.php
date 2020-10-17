@extends('layouts.main')

@section('content')

 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <!-- Default box -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">MODIFICAR MIS DATOS</h3>
          </div>
          
          <div class="box-body">
            
            {!! Form::open(['route'=>'users.changeMyDatas', 'method'=>'POST', 'files'=>true])!!}

              {!! Field::text('name',Auth::user()->name)!!}

               <label>Foto Actual</label><br>
              <div>             
               <img src="{{ asset('images/users/'.Auth::user()->photo_name)  }}"  width="160" height="150" >
              </div>
              {!! Field::file('photo')!!}
              
               {!! Field::email('email',Auth::user()->email,['disabled'])!!}

              <div class="form-group text-center">
                {!! Form::submit('Guardar cambios',['class'=>'btn btn-primary'])!!}
                <a class="btn btn-danger" href="{{ route('profile') }}">Cancelar</a>
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
  $('.chosen-select').chosen({
  no_results_text: 'No hay resultados'
});
</script>
@endsection