@extends('layouts.my_template')

@section('style')
  <link rel="stylesheet" href="{{asset('css/carousel.css')}}">
@endsection

@section('content')

 <section id="contact" class="contact">
                     
  <div class="content-wrap centering">
       <div class="mi_letter text-center">
           <h1>Contacto</h1>
           <img src="{{ asset('images/line.png')}}" alt=""> 
           <br>
      </div> 

  <div class="row">
     <div class="col-md-6 mi_letter text-center">

         
                <h3>Te invitamos a conocernos</h3>

                   <h4><b>Direccion</b></h4>
                   <i class="glyphicon glyphicon-home"></i><h4>{{$cotillon->address}}</h4>

                   <h4><b>Telefonos</b></h4>
                    <i class="glyphicon glyphicon-earphone"></i><h4>{{$cotillon->phones}}</h4>

                   <h4><b>Email</b></h4>
                    <i class="glyphicon glyphicon-envelope"></i><h4>{{$cotillon->email}}</h4>


                   <h4><b>Horarios de atencion</b></h4>
                
                    <i class="glyphicon glyphicon-time"></i> <h4>{{$cotillon->business_hours}}</h4>
                  
                    <h4><b>Redes sociales</b></h4>
                    <a  target="_blank" href="{{$cotillon->facebook}}" class="btn btn-face"></a>
                    
                   <h4><b>Ubicación</b></h4>
                    

                 <iframe class="mapa" src="{{$cotillon->position}}" frameborder="0" style="border:0" allowfullscreen></iframe>

                </div>
    
      <div class="col-md-5 mi_letter">
          <br>
              <div class="text-center">
              <img  class="imagen" src="{{asset('images/portada.jpg')}}">
              </div>
               <br><br>
            <div align="center">
              <div>
                 <h3>Enviános tu consulta</h3>

                @include('flash::message')

                {!! Form::open(['route' => 'send', 'method' => 'post']) !!}

            
                  <div class="form-group">

                      <h4>  {!! Form::label('name','Nombre (*)')!!}</h4>
                        {!! Form::text('name',null, ['class'=>'get form-control','title'=>'El nombre es obligatorio','placeholder'=>'Ingrese un nombre..','required'])!!}
                  </div>
                 
                <div class="form-group">

                     <h4> {!! Form::label('email','Email (*)')!!}</h4>
                      {!! Form::email('email',null, ['class'=>'get form-control', 'placeholder'=>'ejemplo@gmail.com','required'])!!}
                </div>
                 <div class="form-group ">
                      <h4> {!! Form::label('subject','Asunto (*)')!!}</h4>
                      {!! Form::text('subject',null, ['class'=>'get form-control','placeholder'=>'Ingrese un asunto','required'])!!}
                 </div>
                <div class="form-group">

                     <h4> {!! Form::label('body','Mensaje')!!}</h4>
                     {!! Form::textarea('body',null, ['class'=>'get form-control'])!!}
                      
                </div>
                 <div class="form-group">
                     {!! Form::submit('Enviar',['class'=>'btn btn-lg btn-success'])!!}
                 </div>

                {!! Form::close()!!}
                </div>
              </div>

   
                </div>
  
</div>
<div class="text-center">
<img src="{{ asset('images/line.png')}}" alt=""> 
  
</div>
</div>

          

        </section>
@endsection

