@extends('layouts.my_template')

@section('content')
 <div class="content-wrap centering">
      <div class="mi_letter text-center">
                  <h1>Mi Carrito</h1>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>

<main>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9" style="float: none;margin-left: auto;margin-right: auto;">
                
                
                {!! Form::open(['route'=>'shoppingcarts.store', 'method'=>'POST'])!!}

                    <div id="carrito" class="form-group table-responsive" >
                        <table class="table" id="lista-compra" >
                            <thead>
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col" style="width: 15%;">Cantidad</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody >
                            </tbody>
                        </table>
                    </div>

                        <div class="row">
            
                  <div class="col-xs-5">
                  </div>
                  <div class="col-xs-7">

                     <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Total:</th>
                          <td>$<input id="total" name="total" readonly style="background-color: transparent;outline: none !important;border: none !important; width: 50%"></td>
                        </tr>
                        <tr>
                          <th>Fecha de Entrega</th>
                          <td>   <div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
                                  <div class="form-group">
                                        <div class='input-group date' >
                                          <input required type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Seleccione una fecha" value="{{ old('datepicker') }}">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                  @if ($errors->has('datepicker'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('datepicker') }}</strong>
                                    </span>
                                @endif
                              </div>
                      </div></td>
                        </tr>
                      </table>
                    </div>

              </div>



                    <div class="row text-center" style="margin-bottom:20px;">
                       
                            <a href="{{route('catalogue')}}" class="btn btn-info">Volver al Catálogo</a>
                       
                      
                            <button href="#" class="btn btn-success" id="procesar-compra">Realizar pedido</button>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
</div>


<div class="mi_letter text-center">
     <img src="{{ asset('images/line.png')}}" alt=""> 
</div> 
</div>


@endsection
@section('js')
    <script src="{{asset('js/carrito.js')}}"></script>
    <script src="{{asset('js/compra.js')}}"></script>

    <script>
      $('#datepicker').each(function() {
        $(this).datepicker({
             language: "es",
             autoclose: true,
             format:"yyyy/mm/dd"
        });
      }); 
    </script>
@endsection