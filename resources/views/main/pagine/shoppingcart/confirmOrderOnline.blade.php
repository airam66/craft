@extends('layouts.my_template')

@section('content')
 <div class="content-wrap centering">
      <div class="mi_letter text-center">
                  <h1>Confirmar pedido</h1>
       <img src="{{ asset('images/line.png')}}" alt=""> 
      <br>
      <div style="width: 70%; margin:5px auto;">
         <img src="{{ asset('images/advertencia.png')}}" alt="" width="40px"> 
           Señor/a {{\Auth::user()->name}} Ud. tiene 6 días desde el día de la fecha para acercarse a nuestro local y confirmar su pedido. Muchas Gracias.
      </div>
        </div>

@if($dateNow->diff($user->updated_at)->days>180)
    {!! Form::model(Auth::user(),['route'=>'updateDatas', 'method'=>'PUT'])!!}
        
          <div class="row">              
            <div class="col-md-6 col-md-offset-3" >
               <h3 class="text-center">CONFIRMAR MIS DATOS</h3>
               <hr> 
               
              {!! Field::text('name',$user->name)!!}
              
              <label> Localidad</label><br>
              {!! Form::select('location',['Rosario de Lerma'=>'Rosario de Lerma','Salta'=>'Salta','San Lorenzo'=>'San Lorenzo','Cerrillos'=>'Cerrillos','Chicoana'=>'Chicoana','La Merced'=>'La Merced'],$client->location,['class'=>'form-control chosen-select'])!!} 
            
               {!! Field::text('address',$client->address)!!}
             
              {!! Field::number('phone',$client->phone)!!}
              
               {!! Field::email('email',Auth::user()->email,['disabled'])!!}

               <input hidden type="number" name="shoppingcart_id"  value="{{$shoppingcart->id}}">
         
              <div class="form-group">
              <input class="btn btn-success" type="submit" value="Guardar cambios" id="Confirmar">
              </div>
            </div> 
        </div>
        
            {!! Form::close() !!}
@else
      <br>
      <br>
			<div class="form-group">
            <a href="{{route('my_order.pdf')}}" target="_blank" > 
            <div class="text-center">
               <button  type="button" class="btn btn-success "><i class="fa fa-print" style="color:#fff;"></i>  Generar comprobante PDF</button>
            </div>
            </a>
      </div>
           <br><br>
    
@endif

<div class="mi_letter text-center">
     <img src="{{ asset('images/line.png')}}" alt=""> 
</div> 
</div>
@endsection
