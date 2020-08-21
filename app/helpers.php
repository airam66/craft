<?php

function listPopup($products){
              $output="";
        $comilla="'";
        
        if($products){
        foreach ($products as $key => $product) {
                   
                  $output.='<tr>'.
                        
                        '<td>'.$product->name.'</td>'.
                        '<td> $ '.$product->retail_price.'</td>'.
                        '<td> $ '.$product->wholesale_price.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }
           return $output;

      }

   
     

      }

function popUpProductsInvoice($products){
        
        $output="";
        $comilla="'";
        
        if ($products) {
        foreach ($products as $key => $product) {
                  $output.='<tr>'.
                         '<td>'.$product->name.'</td>'.
                         '<td>'.$product->brand->name.'</td>'.
                        '<td>$ '.$product->retail_price.'</td>'.
                        '<td>'.$product->wholesale_cant.'</td>'.
                        '<td>$ '.$product->wholesale_price.'</td>'.
                        '<td>'.$product->stock.'</td>'.
                        
                        '<td><a onclick="complete('.$product->id.','.$comilla.$product->code.$comilla.','.$comilla.$product->name.$comilla.','.$product->wholesale_price.','.$product->retail_price.','.$product->stock.','.$product->wholesale_cant.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return $output;
          
   }
}

function popUpProductsPurchases($products){
  
        $output="";
        $comilla="'";
        
        if ($products) {
        foreach ($products as $key => $product) {
                   $output.='<tr>'.
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->brand_name.'</td>'.
                        '<td>$'.$product->purchase_price.'</td>'.
                        '<td>'.$product->stock.'</td>'.
                       

                        '<td><a onclick="complete('.$product->product_id.','.$product->code.','.$comilla.$product->brand_name.$comilla.','.$comilla.$product->product_name.$comilla.','.$product->purchase_price.','.$product->stock.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return $output;
          
   }
}

function popUpProductsProvider($products){
  
        $output="";
        $comilla="'";
        
        if ($products) {
        foreach ($products as $key => $product) {
                   $output.='<tr>'.
                        '<td>'.$product->product_name.'</td>'.
                        '<td>'.$product->brand_name.'</td>'.
                        '<td>'.$product->stock.'</td>'.

                        '<td><a onclick="add_product('.$product->product_id.','.$product->code.','.$comilla.$product->product_name.$comilla.','.$comilla.$product->brand_name.$comilla.')'.'"'.' type="button" class="btn btn-primary"> Agregar </a></td>'


                    .'</tr>';
        }

   
        return $output;
          
   }
}


function popUpPeople($people,$type){
        
        $output="";
        $comilla="'";
      
        
      if ($people) {
        foreach ($people as $key => $person) {
                 if($type!='Client'){
                  $numberPerson=$person->cuit;
                  $infoPerson=$person->province;
                 }else{
                  $numberPerson=$person->cuil;
                  $infoPerson=$person->phone;
                 }
                  $output.='<tr>'.
                        '<td>'.$numberPerson.'</td>'.
                        '<td>'.$person->name.'</td>'.
                        '<td>'.$person->address.'</td>'.
                        '<td>'.$infoPerson.'</td>'.
                     
                         '<td><a onclick="completeC('.$comilla.$person->id.$comilla.','.$numberPerson.','.$comilla.$person->name.$comilla.'); productStockProvider() " type="button" class="btn btn-primary"> Agregar </a></td>'
                      
                    .'</tr>';
        }

   
        return $output;
          
       } 
}

function nameMonth($mes){
  setlocale(LC_TIME,"spanish");
  $name=strftime(' %B',mktime(0,0,0,$mes,1,2000));
  return $name;

}
