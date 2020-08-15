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
    
    public function index(Request $request)
    {
      
       /* return view('admin.products.index')->with('products',$products)*/

    }

    public function create()
    {
        $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $providers=Provider::where('status','=','activo')->orderBy('name','ASC')->get();
        $title="BUSCAR PROVEEDOR";
        return view('admin.providersproducts.create')->with('products',$products)
                                                     ->with('providers',$providers)
                                                     ->with('title',$title);
    }

    
    public function store(Request $request)
    {
    	
            $idarticulo = $request->get('dproduct_id');

            $cont = 0;

            while ( $cont < count($idarticulo) ) {
                $detalle = new ProviderProduct();
                $detalle->provider_id=$request->provider_id; 
                $detalle->product_id=$idarticulo[$cont];
                $detalle->save();
                $cont = $cont+1;
            }

            flash("Los productos han sido agregados con éxito" , 'success')->important();
       
        return redirect()->route('providersproducts.create');

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
