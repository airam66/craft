<!--POPUP-->


 <div class="modal fade" id="favoritesModalCategoryImage{{$category->id}}" tabindex="-1" 

      role="dialog" aria-labelledby="favoritesModalLabel">
  <div class="modal-dialog modal-sm" id="mdialTamanio" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#5cb0c6;">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             <h4 class="modal-title" id="favoritesModalLabel"><b>{{$category->name}}</b></h4>
      </div>
      <div class="modal-body text-center">

        <img src="{{ asset('images/categories/'.$category->extension)  }}" width="250" height="250">
      </div><!--FIN DEL BODY-->
      <div class="modal-footer">
        <button type="button" 
           class="btn btn-default" 
           data-dismiss="modal">SALIR</button>
      </div>
    </div>
  </div>
</div>
<!--FIN POPUP-->
