/*=============================================
    para la vista nueva orden de compra
    =============================================*/

$('#favoritesModalClient').on('shown.bs.modal', function () {
  $('#searchC').focus();
});


  function completeC($id,$number,$name){
    $('#cuit').val($number);
    $('#nombre').val($name);
    $('#provider_id').val($id);
    $('#favoritesModalClient').modal('hide');

  };

// busqueda de proveedor por nombre en el modal
$('#searchC').on('keyup', function(){
  $value=$(this).val();
  $url=baseUrl('admin/searchProvider');
  $.ajax({
    type: 'get',
    url:  $url,
    data:{'searchProvider':$value},
    success: function(data){
      $('#mostrarC').html(data);
    }
    
  });
});