@extends('layouts.my_template')

@section('style')
  <link rel="stylesheet" href="{{asset('css/carousel.css')}}">
@endsection

@section('content')

 <section class="home" id="home">
      <div class="content-wrap centering">
            <div class="mi_letter text-center">
              <h1>Bienvenidos</h1>
              <img src="{{ asset('images/line.png')}}" alt=""> 
            </div> 
            <div>
              <!--inicio carrucel-->
         
<div class="banner">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div align="center">
    <div class="carousel-inner row justify-content-center">
    @foreach($imagenes as $imagen)
      @if($imagen->id==1)
        <div class="item active text-center">
      @else
        <div class="item text-center">
      @endif
        <img src="{{ asset('images/carrusel/'.$imagen->extension)  }}">
        </div>
    @endforeach

    </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>

    </div>
  </div>
</div>
     
      
  
            <!---->
              
              <div class="content-wrap">
                <div class="heading text-center">
                   <div class="titulo"> Vení y lleva lo que más te guste.</div>
                      <div class="contenido"> Tenemos diversos productos personalizados.<br> 
                     Hace de tu fiesta un recuerdo inolvidable.</div>

            </div>
            </div>
             <div class="text-center">
               <img src="{{ asset('images/line.png')}}" alt=""> 
             </div>
        
      </div>
    </section>

@endsection



