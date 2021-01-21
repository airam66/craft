@extends('layouts.my_template')

@section('content')
 <div class="content-wrap centering">
      <div class="mi_letter text-center">
                  <h3>Mi Carrito</h3>
                  <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>

<main>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <h2 class="d-flex justify-content-center mb-3">Realizar Compra</h2>
                
                {!! Form::open(['route'=>'shoppingcarts.store', 'method'=>'POST'])!!}

                    <div id="carrito" class="form-group table-responsive" >
                        <table class="table" id="lista-compra" >
                            <thead>
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Sub Total</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody >
                            </tbody>
                            <tr>
                                <th colspan="4" scope="col" class="text-right">TOTAL :</th>
                                <th scope="col">
                                  $ <input id="total" name="total" class="font-weight-bold border-0" readonly style="background-color: white;">
                                </th>
                                <!-- <th scope="col"></th> -->
                            </tr>
                            <tr>
                                <th colspan="4" scope="col" class="text-right">Entrega Pedido:</th>
                                <th scope="col">
                                
                                <div class="form-group{{ $errors->has('datepicker') ? ' has-error' : '' }}">
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
                            </th>
                          </tr>
                        </table>
                    </div>



                    <div class="row justify-content-between">
                        <div class="col-md-4 mb-2">
                            <a href="{{route('catalogue')}}" class="btn btn-info btn-block">Seguir comprando</a>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <button href="#" class="btn btn-success btn-block" id="procesar-compra">Realizar compra</button>
                        </div>
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