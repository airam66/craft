$('#favoritesModalClient').on('shown.bs.modal', function () {
  $('#searchC').focus();
});

   var options={
    url: function(p){
      return baseUrl('admin/autocompleteProvider?p='+p);
         }, getValue:'cuit',
            list: {
                    match: {
                        enabled: true
                    },
                    onClickEvent: function () { 
                        var provider = $('#cuit').getSelectedItemData();
                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);
                      
                       $providerid=$('#provider_id').val();
                       $.ajax({
                        type: 'get',
                        url:  "{{ URL::to('admin/detailPurchase')}}",
                        data:{'provider_id':$providerid},
                        success: function(data){
                            $('#detail').html(data);
    
                        }
                       })

                    },
                    onKeyEnterEvent: function () { 
                        var provider = $('#cuit').getSelectedItemData();
                        $('#nombre').val(provider.name);
                        $('#provider_id').val(provider.id);

                        $providerid=$('#provider_id').val();
                       $.ajax({
                        type: 'get',
                        url:  "{{ URL::to('admin/detailPurchase')}}",
                        data:{'provider_id':$providerid},
                        success: function(data){
                          $('#detail').html(data);
                         }
                       })
                    }
                }
   };
  
  $("#cuit").easyAutocomplete(options);


  function completeC($id,$number,$name){
    $('#cuit').val($number);
    $('#nombre').val($name);
    $('#provider_id').val($id);
    $('#favoritesModalClient').modal('hide');
  };