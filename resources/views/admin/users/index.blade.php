@extends('layouts.main')

@section('content')

<div class="box box-primary">

<div class="box-header">
<h1 class="box-title">Listado de Usuarios</h1>
  <div class="row"> 
    
         <!--Boton agregar usuario-->
        <input type ='button' class="btn btn-success col-md-1" style=" margin-top: 10px;margin-bottom: 10px;
      margin-left: 15px;"  value = 'Agregar' onclick="location.href = '{{ route('users.create') }}'"/>       
        
        <!-- search name form -->
        <form route='admin.categories.index'  method="GET" class="col-md-4 col-md-offset-6">
            <div class="input-group">
              <input type="text" name="name" class="form-control" placeholder="Nombre..."> 
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
          <!-- /.search form -->
      
    </div>

</div>
<div class="box-body table-responsive no-padding">              

 <table id="tabla table-striped" class="display table table-hover" cellspacing="0">
       
        <thead>
            <tr>
               
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Foto</th> 
                <th></th>
            </tr>
        </thead>
     
       
<tbody>
  @if($users->isNotEmpty())
   @foreach($users as $user) 

            <tr role="row" class="odd">
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td> 
            @if($user->photo_name!=null)
                   <div>
                  
                  <a data-toggle="modal" data-target="#favoritesModalUserImage{{$user->id}}">
                   <img src="{{asset('images/users/'.$user->photo_name)}}" width="40" height="40" style="cursor:pointer;"> 
                   </a>
                   @include('admin.users.imagePopUp')
                   </div>
            @endif
            </td>
            <td>
              <a href="{{route('users.edit',$user->id)}}"  >
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                        </button>
                     </a>
              <a href="{{route('users.destroy',$user->id)}}" onclick="return confirm('¿Seguro dara de baja usuario?')">
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true" ></span>
                        </button>
                     </a>
            </td>         
          
        </tr>
  @endforeach
@else

    <tr><td class="text-center" colspan="4">No se encontraron resultados</td></tr>

@endif
   </tbody>
 </table>
 <div class="text-center">
    {!!$users->appends(request()->input())->links()!!}
 </div>
</div>

</div>


@endsection

