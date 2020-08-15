/*=============================================
    para la vista agregar productos a proveedor
    =============================================*/

// buscador por nombre en el modal de productos

$('#favoritesModalProduct').on('shown.bs.modal', function () {
  $('#searchProducts').focus();
});

$('#searchProducts').on('keyup', function(){
  $value=$(this).val();
  $url=baseUrl('admin/searchProdName');
  $.ajax({
    type: 'get',
    url:  $url,
    data:{'searchProducts':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
});

//buscador por letras en e modal de productos

function SearchLetter($letter){
  $value=$letter;
  console.log("entro");
  $url=baseUrl('admin/searchProdLetter');
  $.ajax({
    type: 'get',
    url:  $url,
    data:{'searchL':$value},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
  }


   