<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProviderProduct;
use App\Provider;
use App\Product;
use App\Http\Requests\ProviderRequest;
use Illuminate\Support\Facades\DB;

class ProvidersProductsController extends Controller
{
    

    
    public function storeProducts(Request $request, $id)
    {
    	
            $products = $request->get('dproduct_id');
            $provider=Provider::find($id); 
           // var_dump($provider->products);
            $cont = 0;

            $idarticulo = array_values(array_unique($products));

            while ( $cont < count($idarticulo) ) {
                $detalle = new ProviderProduct();
                $detalle->provider_id= $provider->id;
                $detalle->product_id=$idarticulo[$cont];
                $detalle->save();
                $cont = $cont+1;
            }



            flash("Los productos han sido agregados con éxito" , 'success')->important();
       
        return redirect()->route('providers.index');

    }

  public function searchProdName(Request $request){
      if($request->ajax()){
        $output="";
        $comilla="'";

      $products=DB::table('products as p')
                   ->join('brands as b','p.brand_id','=','b.id')
                   ->select('code','p.id as product_id','p.name as product_name','b.name as brand_name','stock','p.status','b.name')
                   ->where('p.name','LIKE', "%".$request->searchProducts."%")
                   ->where('p.status','=','activo')
                   ->where('b.name',"<>","CreaTu")->get();
        
        $result=popUpProductsProvider($products);
         return Response($result);       
   
    }
    }
    
     public function searchProdLetter(Request $request){
   
      if($request->ajax()){
   
         $output="";
        $comilla="'";
        $products=DB::table('products as p')
                   ->join('brands as b','p.brand_id','=','b.id')
                   ->select('code','p.id as product_id','p.name as product_name','b.name as brand_name','stock','p.status','b.name')
                  ->where('p.name','LIKE', $request->searchL."%")
                  ->where('p.status','=','activo')
                  ->where('b.name',"<>","CreaTu")->get();
                         
         $result=popUpProductsProvider($products);
         return Response($result);
              
   
        }
    }


   
   
    
}
