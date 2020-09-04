/*=============================================
    para la vista nueva orden de compra
    =============================================*/

// autocompletado de producto por proveedor
var options={
    url: function(q){
       $providerid=$('#provider_id').val();
      
 return  baseUrl('admin/autocompleteProdProvider?q='+q+'&p='+$providerid);
         }, getValue:"code",
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                          $('#stock').val(product.stock);
                          $('#product_id').val(product.product_id);
                          $('#name').val(product.product_name);
                          $('#purchase_price').val(product.purchase_price);
                          $('#brand').val(product.brand_name);
                          $('#amount').focus();
                    },
                    onKeyEnterEvent: function () { 
                        var product = $("#code").getSelectedItemData();
                          $('#stock').val(product.stock);
                          $('#product_id').val(product.id);
                          $('#name').val(product.product_name);
                          $('#purchase_price').val(product.purchase_price);
                          $('#brand').val(product.brand_name);
                          $('#amount').focus();

                    }
                }
   };
  
  $("#code").easyAutocomplete(options);

$('#favoritesModalProduct').on('shown.bs.modal', function () {
  $('#searchProducts').focus();
});

function complete($id,$code,$brand,$name,$purchase,$stock){
    $('#code').val($code);
    $('#brand').val($brand);
    $('#product_id').val($id);
    $('#name').val($name);
    $('#stock').val($stock);
    $('#purchase_price').val($purchase);
    $('#favoritesModalProduct').modal('hide');
    $('#amount').focus();
   $('#mostrar').html('');
  };

// busqueda por nombre de productos en el modal

  $('#searchProducts').on('keyup', function(){
  $value=$(this).val();
  $providerid=$('#provider_id').val();
  $url=baseUrl('admin/searchProducts');
  $.ajax({
    type: 'get',
    url:  $url,
    data:{'searchProducts':$value,'provider_id':$providerid},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  })
})

// busqueda de productos por letrasen el modal

 function SearchLetter($letter){
  $value=$letter;
  $providerid=$('#provider_id').val();
   $url=baseUrl('admin/searchLetter');
  $.ajax({
    type: 'get',
    url:  $url,
    data:{'searchL':$value,'provider_id':$providerid},
    success: function(data){
      $('#mostrar').html(data);
    }
    
  });
  }