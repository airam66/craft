<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCartProduct;
use App\ShoppingCart;
use App\Product;
use App\Order;
use App\OrderProduct;
use App\Client;
use Illuminate\Support\Facades\DB;
use DateTime;
class ShoppingCartsController extends Controller
{
    public function indexWeb()
    {   

        $user=\Auth::user();
        $shoppingcarts=ShoppingCart::all();
        foreach ($shoppingcarts as $value) {
                    $date1 = new DateTime($value->created_at);
                    $date2 = new DateTime("now");
                    $diff = $date1->diff($date2);
            if ($value->status=='online') {
                ShoppingCart::destroy($value->id);
            }
            if (($value->status=='confirmar')&&($diff->days>6)) {
                ShoppingCart::destroy($value->id);
            }
        }

        $dateNow = new DateTime("now");
        $orders=Order::where('client_id','=',$user->client_id)->orderBy('id','ASC')->get();
        $shoppingcarts=ShoppingCart::where('client_id','=',$user->client_id)
                                   ->where('status','=','confirmar')->orderBy('id','ASC')->get();
        return view('main.pagine.shoppingcart.indexWeb')->with('shoppingcarts',$shoppingcarts)
                                                        ->with('orders',$orders)
                                                        ->with('dateNow',$dateNow);

    }


    public function index(Request $request)
    {
       
       $shoppingcarts=ShoppingCart::orderBy('id','DESC')
                                    ->where('status','=','confirmar')
                                    ->paginate(15);
        foreach ($shoppingcarts as $value) {
                    $date1 = new DateTime($value->created_at);
                    $date2 = new DateTime("now");
                    $diff = $date1->diff($date2);
            if ($value->status=='online') {
                ShoppingCart::destroy($value->id);
            }
            if (($value->status=='confirmar')&&($diff->days>6)) {
                ShoppingCart::destroy($value->id);
            }
        }

       $fecha1=$request->fecha1;
       $fecha2=$request->fecha2;

      if ($request->searchClient!=''){
         $client= Client::SearchClient($request->searchClient)->first();
          if ($client != null){
          $shoppingcarts=$client->shoppingcart()->paginate(15);
         }
         else{
            $shoppingcarts = Collection::make();
         }
      }

      if($fecha1!='' and $fecha2!=''){
         $shoppingcarts=ShoppingCart::SearchOrder($fecha1,$fecha2)
                                    ->where('status','=','confirmar')
                                    ->orderBy('id','DESC')->paginate(15);
      }

        return view('admin.orders.indexWeb')->with('shoppingcarts',$shoppingcarts)->with('fecha1',$fecha1)->with('fecha2',$fecha2);
    }

    public function createOrders($id)
    {
        $shoppingcart=ShoppingCart::find($id);
        $shoppingcartproducts=$shoppingcart->ShoppingCartProducts()->get();

        $shoppingcart->delivery_date= str_replace('/','-', $shoppingcart->delivery_date);
        $shoppingcart->delivery_date=date("Y-m-d",strtotime($shoppingcart->delivery_date));
        
        $order=Order::create([
            'client_id'=>$shoppingcart->client_id,
            'delivery_date'=>$shoppingcart->delivery_date,
            'total'=>$shoppingcart->total,
            'status'=>'pendiente',
            'discount'=>0,
        ]);
        foreach ($shoppingcartproducts as $detalle) {
            $orderproduct=OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$detalle->product_id,
                'amount'=>$detalle->amount,
                'subTotal'=>$detalle->subTotal,
                'price'=>$detalle->price,
        ]);
        }

        $shoppingcart->status='pendiente';
        $shoppingcart->save();
        return redirect()->route('orders.index');
    }

    public function edit()
    {
        return view('main.pagine.shoppingcart.edit');
    }

    public function store(Request $request){
        $user=\Auth::user();

        $shoppingcart=ShoppingCart::create([
            'status'=>'confirmar',
            'client_id'=>$user->client_id,
            'total'=>$request->total,
            'delivery_date'=>$request->datepicker,
        ]);

        $idarticulo = $request->get('idproductos');
        $amount = $request->get('cantidad'); 

        $cont =0;
        while ( $cont <count($idarticulo) ) {
            $detalle = new ShoppingCartProduct;
            $detalle->shopping_cart_id = $shoppingcart->id;
            $detalle->product_id = $idarticulo[$cont];

            $product = Product::find($idarticulo[$cont]);

            if ($amount[$cont]>=$product->wholesale_cant){
                $detalle->subTotal=$product->wholesale_price*$amount[$cont];
                $detalle->price=$product->wholesale_price;
            }else{
                $detalle->subTotal=$product->retail_price*$amount[$cont];
                $detalle->price=$product->retail_price;
            }
            $detalle->amount=$amount[$cont];
            $detalle->save();
                           
            $cont = $cont+1;

        }
        $shoppingcart->total=$shoppingcart->total(); 

        if ($shoppingcart->total>0){
             $shoppingcart->save();
        }
        else{
              flash("Debe ingresar al menos un producto" , 'success')->important();
        }

        flash("El carrito ha sido modificada con exito" , 'success')->important();

        $client=Client::find($user->client_id);
        $dateNow = new DateTime("now");
 
        return view('main.pagine.shoppingcart.confirmOrderOnline')->with('user',$user)
                                                                  ->with('shoppingcart',$shoppingcart)
                                                                  ->with('client',$client)
                                                                  ->with('dateNow',$dateNow);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //dd($request);
        $user=\Auth::user();
        $shoppingcart=ShoppingCart::find($id);
         
        $idarticulo = $request->get('product_id');
        $idshoppingcart = $request->get('dproduct_id');
        $amount = $request->get('damount');

            $cont =0;
            while ( $cont <count($idarticulo) ) {
                $detalle = ShoppingCartProduct::find($idshoppingcart[$cont]);
                $product = Product::find($idarticulo[$cont]);

                if ($amount[$cont]>=$product->wholesale_cant){
                    $detalle->subTotal=$product->wholesale_price*$amount[$cont];
                    $detalle->price=$product->wholesale_price;
                }else{
                    $detalle->subTotal=$product->retail_price*$amount[$cont];
                    $detalle->price=$product->retail_price;
                }

                $detalle->amount=$amount[$cont];

                $detalle->save();
                               
                $cont = $cont+1;

            }
        $shoppingcart->total=$shoppingcart->total(); 
        if($shoppingcart->client_id==null){
            $shoppingcart->client_id=$user->client_id;
            }

      if ($shoppingcart->total>0){
                 $shoppingcart->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" , 'success')->important();
            }

        flash("El carrito ha sido modificada con exito" , 'success')->important();
     

       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     

//***************************GENERAR PDF PARA IMPRIMIR PEDIDO****************************************
    public function pdfOrderOnline(){
      $user=\Auth::user();
      $client=Client::find($user->client_id);
      $shoppingCart=$client->shoppingcart->last();
      $details=ShoppingCartProduct::searchOrderOnline($shoppingCart->id)->get();  
      $vistaurl="main.pagine.shoppingcart.pdfOrderOnline";
      $view= \View::make($vistaurl,compact('shoppingCart','details'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream();
    }

    public function updateDatas(Request $request){
      $user=\Auth::user();
      $user->fill($request->all());  
      $client=Client::find($user->client_id);
      $client->fill($request->all());
      $client->save();
      $user->save();

      $dateNow = new DateTime("now");
      $shoppingcart=ShoppingCart::find($request->shoppingcart_id);

      flash("Sus datos se cambiaron correctamente ", 'success')->important();

      return view('main.pagine.shoppingcart.confirmOrderOnline')->with('user',$user)
                                                                  ->with('shoppingcart',$shoppingcart)
                                                                  ->with('client',$client)
                                                                  ->with('dateNow',$dateNow);
   
   }

}
