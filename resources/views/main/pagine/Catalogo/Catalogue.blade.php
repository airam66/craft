@extends('layouts.my_template')
   
@section('content') 
    
 <div class="content-wrap centering">
      <div class="mi_letter text-center">
          <h1>Nuestros productos</h1>
          <img src="{{ asset('images/line.png')}}" alt=""> 
      </div>
                     
       <div class="row">  
          <div class="col-md-3">
             @include('main.pagine.Catalogo.aside')
          </div> 

        <div id="lista-productos">
          <div class="col-md-9">
              <div>
                @if(empty($products))
                   <p>No hay datos para mostrar</p>
                @else
                  @foreach($products as $product)

                   @if (!Auth::guest())
                   <div class="card product mystyle">
                    <div>
                       @if($product->extension!=null)
                        <img src="{{ asset('images/products/'.$product->extension)  }}"  width="160" height="150" >
                       @endif
                    </div>
                    <div class="text-center">
                       <h5 style="height: 40px;"><b>{{strtoupper($product->name)}}</b></h5>
                       <div class="mi_letter">
                         <h5 class="precio">
                            $<span class="">{{$product->retail_price}}</span>c/u
                         </h5>
                         <h5 style="display:none;" class="precioSale">
                            $<span class="">{{$product->wholesale_price}}</span>c/u
                         </h5>
                         <h5 style="display:none;" class="cant">
                            <span class="">{{$product->wholesale_cant}}</span>
                         </h5>
                       </div>
                    </div>
                    <a type="submit" class="btn btn-success agregar-carrito" data-id="{{$product->id}}">
                      Agregar al carrito
                      <span class="glyphicon glyphicon-check"></span>
                    </a>
                    <div class="text-right" >
                        <a data-toggle="modal" id="first" data-title="detail" data-target="#favoritesModalProduct{{$product->id}}">
                        <img src="{{ asset('images/informacion3.png ') }}" width="45" height="45">
                        </a>
                    </div>    
                   </div>
                   @else
                    <div class="card product my_style">
                      <div>
                       @if($product->extension!=null)
             
                          <img src="{{ asset('images/products/'.$product->extension)  }}"  width="160" height="150" >
            
                       @endif
                      </div>
                        <div class="text-center">
                           <h5 style="height: 35px;"><b>{{strtoupper($product->name)}}</b></h5>
                        </div>
                        <div class="text-right" >
                            <a data-toggle="modal" id="first" data-title="detail" data-target="#favoritesModalProduct{{$product->id}}">
                              <img src="{{ asset('images/informacion3.png ') }}" width="45" height="45"  >
                            </a>
                        </div>
                    </div>

                  @endif 
                    @include('main.pagine.Catalogo.ProductShow')
                @endforeach
               @endif
             </div>
          </div> 
        </div>
          <div class="text-center">
           {!!$products->links()!!} 
          </div>
        </div>  

        <div class="text-center">
        <img src="{{ asset('images/line.png')}}" alt=""> 
        </div>
</div>

@endsection

@section('js')
 <script src="{{asset('js/carrito.js')}}"></script>
 <script src="{{asset('js/pedido.js')}}"></script>
@endsection