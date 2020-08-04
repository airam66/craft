@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header ">
<h1 class="box-title">Listado de Eventos</h1>
<div class="row"> 
       <input type ='button' class="btn btn-success col-md-1" style=" margin-top: 10px;margin-bottom: 10px;
      margin-left: 15px;"  value = 'Agregar' onclick="location.href = '{{ route('events.create') }}'"/>
                   <!-- search name form -->
     
        <form route='admin.events.index'  method="GET" class="col-md-4 col-md-offset-6">
            <div class="input-group">
               @if($searchName !=null) 
                  <input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{$searchName}}">
               @else 
                  <input type="text" name="name" class="form-control" placeholder="Nombre...">
               @endif 
             
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
        
</div>
</div>
<div class="box-body table-responsive no-padding">

 <table id="tabla" class="table table-hover" cellspacing="0" width="100%">
       
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th></th>
                   
            </tr>
        </thead>
     
       
<tbody>
  @if($events->isNotEmpty()) 
   @foreach($events as $event) 

          @if ($event->status!='inactivo')
            <tr role="row" class="odd">
          @else
            <tr role="row" class="odd" style="background-color: rgb(247, 212, 212);">
          @endif
            <td>{{$event->name}}</td>
            <td>{{$event->status}}</td>

            <td>
            @if ($event->status!='activo')
                   <a href="{{route('events.enable',$event->id)}}" onclick="return confirm('¿Seguro dar de alta este evento?')">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                        </button>
                     </a>
               
            @else
                    <a href="{{route('events.edit',$event->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                            
                        </button>
                     </a>

                   <a href="{{route('events.desable',$event->id)}}" onclick="return confirm('¿Seguro dara de baja este evento?')">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>


            @endif
            </td>
           
        </tr>
  @endforeach
  @else

 <tr> <td class="text-center" colspan="2">No se encontraron resultados para {{$searchName}}</td></tr>

@endif
   </tbody>
 </table>
<div class="text-center">
    {!!$events->appends(request()->input())->links()!!}
</div>



</div>

</div>


@endsection