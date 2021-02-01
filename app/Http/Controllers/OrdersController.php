<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderProduct;
use App\Client;
use App\Payment;
use App\Movement;
use App\Invoice;
use App\InvoiceProduct;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Collection as Collection;

class OrdersController extends Controller
{
    public function index(Request $request){

      
       $fecha1=$request->fecha1;
       $fecha2=$request->fecha2;
       $orders=Order::orderBy('id','DESC')->paginate(15);
       
       $orders->each(function($orders){
          $orders->client;
        });

      if ($request->searchClient!=''){
         $client= Client::SearchClient($request->searchClient)->first();
          if ($client != null){
          $orders=$client->orders()->paginate(15);
         }
         else{
            $orders = Collection::make();
         }
      }

      if($fecha1!='' and $fecha2!=''){
         $orders=Order::SearchOrder($fecha1,$fecha2)
                            ->orderBy('id','DESC')->paginate(15);
      }
      
      return view('admin.orders.index')->with('orders',$orders)->with('fecha1',$fecha1)->with('fecha2',$fecha2);
    }

    
    public function create()
    {
 	       $numberOrder=Order::all()->pluck('id');
        if (count($numberOrder)!=0){
          $numberOrder=($numberOrder->last()+1);
        }else{
          $numberOrder=1;
        }
        
 	   
     $date=date('d').'/'.date('m').'/'.date('Y');

 	   $products=Product::where('status','=','activo')->orderBy('name','ASC')->get();
        $clients=Client::where('status','=','activo')->orderBy('name','ASC')->get();
       
        $title="BUSCAR CLIENTE";        
        return view('admin.orders.create')->with('date',$date)
                                           ->with('products',$products)
                                           ->with('clients',$clients)
                                          ->with('numberOrder',$numberOrder)
                                          ->with('title',$title);
    }



    public function store(OrderRequest $request){

    	       $order = new Order;
             
            $order->total=$request->get('Totalventa');
            $order->client_id=$request->get('client_id');
            $order->delivery_date= str_replace('/','-', $request->get('datepicker'));
            $order->delivery_date=date("Y-m-d",strtotime($order->delivery_date)); 
            
           
           $order->discount=$request->get('discount');
            if (empty($order->discount)){
              $order->discount=0;
            }

            if ($order->total>0){

                 $order->save();
                 $client=Client::find($order->client_id);
                 $client->bill= $client->bill+$request->get('balance');
                 $client->save();
                  $payment=new Payment;
                  $payment->order_id=$order->id;
                  $payment->amount_paid=$request->get('advance');
                  $payment->balance_paid=$request->get('balance');
                 $payment->save();
            }
            else{
                  flash("Debe ingresar al menos un producto" ,'danger')->important();
                  return redirect()->route('orders.create');
            }

            
            //+++++++++++++INICIAMOS CAPTURA DE VARIABLES ARREGLO[] PARA DETALLEDE orderRequest//++++++++++++++++++
            $idarticulo = $request->get('dproduct_id');
            $amount = $request->get('damount');
            $price = $request->get('dprice');

            $cont = 0;

            while ( $cont < count($idarticulo) ) {
                $detalle = new OrderProduct();
                $detalle->order_id=$order->id; //le asignamos el id de la orderRequest a la que pertenece el detalle
                $detalle->product_id=$idarticulo[$cont];
                $detalle->amount=$amount[$cont];
                $detalle->price=$price[$cont];
                $detalle->subTotal=$amount[$cont]*$price[$cont];
                if ($order->total>0){
                   $detalle->save(); 
                }
               
                $cont = $cont+1;

            }

            return redirect()->route('orders.index',$order->id);


    }

    
//*******************************EDITAR UN PEDIDO******************
  public function edit($id){
     
    $order=Order::find($id);
  
    $details= DB::table('order_product as op')
              ->join('products as p','op.product_id','=','p.id')
              ->select('p.id as product_id','p.name as product_name','p.code as product_code','op.price','op.amount','op.subTotal')
              ->where('op.order_id','=',$id)->get();

    $title="BUSCAR CLIENTE";

    return view('admin.orders.edit')->with('order',$order)
                                    ->with('details',$details)
                                      ->with('title',$title);


  }


  public function update(Request $request,$id){

  	$order=Order::find($id);
    $order->total=$request->get('total');  
    
    if ($order->total>0){
                 
        $order->delivery_date= str_replace('/','-', $request->get('datepicker'));
        $order->delivery_date=date("Y-m-d",strtotime($order->delivery_date));      
        $order->save();

        $client=Client::find($order->client_id);
        $payment=Payment::all()->last();
        $client->bill=$client->bill- $payment->balance_paid;
        $client->bill=$client->bill+$request->get('balance');
        $client->save();
        $payment->balance_paid=$request->get('balance');
        $payment->save();

        DB::table('order_product')->where('order_id','=',$id)->delete();
        $idprod = $request->get('dproduct_id');
        $amount = $request->get('damount');
        $price = $request->get('dprice');

        $cont =0;

        while ( $cont <  count($idprod) ) {
                //dd($cont);
          $detail = new OrderProduct();
          $detail->order_id=$order->id; //le asignamos el id de la venta a la que pertenece el detail
          $detail->product_id=$idprod[$cont];
          $detail->amount=$amount[$cont];
          $detail->price=$price[$cont];
          $detail->subTotal=$amount[$cont]*$price[$cont];

          if ($order->total>0){
            $detail->save(); 
          }
                               
          $cont = $cont+1;

        }

    
        flash("El pedido N° ". $order->id . " ha sido modificado con éxito" , 'success')->important();
     

       return redirect()->route('orders.index');

    }
    else{ 
        flash("Debe ingresar al menos un producto" , 'success')->important();
                   return redirect()->route('orders.edit',$id);
    }
      

  }
  
//*****************************DAR DE BAJA UN PEDIDO*******************************************

  public function destroy($id){

  	Order::destroy($id);

  	flash("El pedido ha sido dado de baja exitosamente" , 'success')->important();
     

      return redirect()->back();
  }

//***************************GENERAR PDF PARA IMPRIMIR PEDIDO****************************************
  public function pdfOrder($id){
      
      $order=Order::find($id);
      $details= DB::table('order_product as op')
      ->join('products as p','op.product_id','=','p.id')
      ->select('p.id as product_id','p.name as product_name','op.price','op.amount','op.subTotal')
      ->where('op.order_id','=',$id)->get();
      $payments=$order->payments()->get(); 

      $date = date('Y-m-d');
      $vistaurl="admin.orders.pdfOrder";
      $view= \View::make($vistaurl,compact('order','details','date','payments'))->render();
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadHTML($view);

      return $pdf->stream();
    }


    // ********************************Registrar Pago*************************************************
     public function registerPayment($id)
    {     
        $order=Order::find($id);
        return view('admin.orders.registerPayment')->with('order',$order);                          
  }

    public function storePayment(Request $request, $id){
     
         $order=Order::find($id);
         $client=Client::find($order->client_id);
                 $payment=new Payment;
                 $payment->order_id=$order->id;
                 if($request->get('totalPayment')=='on'){
                     $payment->amount_paid= $order->total-$order->totalPayments();
                 }else{
                      $payment->amount_paid=$request->get('Rode');
                 }
                 
                 $payment->balance_paid=($order->total-$order->totalPayments())-$payment->amount_paid;//
                 $client->bill=$client->bill-$payment->amount_paid;
                 $payment->save();
                 $client->save();
                 $income=new Movement();
                 $income->concept="Pago Pedido N° ".$order->id;
                 $income->type="entrada";
                 $income->rode= $payment->amount_paid;
                 $income->save();
      
    
        flash("El pago del pedido N° ". $order->id . " de ".$order->client->name." se registró con exito" , 'success')->important();
     

       return redirect()->route('orders.index');


    }

    public function show($id){
      
      $order= Order::find($id);
      $details= DB::table('order_product as dp')
      ->join('products as p','dp.product_id','=','p.id')
      ->select('p.id','p.name as product_name','dp.price','dp.amount','dp.subTotal')
      ->where('dp.order_id','=',$id)->get();

       $payments=$order->payments()->get(); 

      return view('admin.orders.detailOrderRequest')->with('order',$order)
                                                   ->with('details',$details)
                                                   ->with('payments',$payments); 
   

    }
//************************cambiar estado***************************************
    public function changeStatus(Request $request,$id){
        $order=Order::find($id);
    if ($request->status<>'entregado'){ 
        flash("El pedido N°". $order->id . " de ".$order->client->name." cambió de ".$order->status." a ".$request->status , 'success')->important();
        $order->fill($request->all());
        $order->save();
        return redirect()->route('orders.index');

    }else{
          $details= DB::table('order_product as dp')
          ->join('products as p','dp.product_id','=','p.id')
          ->select('p.id','p.name as product_name','dp.price','dp.amount','dp.subTotal')
          ->where('dp.order_id','=',$id)->get();
          //verifica en Stock
          $cant = 0;
          $band = 0;
          while ( $cant< count($details) && $band==0) {
              $product=Product::find($details[$cant]->id);
              if ($details[$cant]->amount>$product->stock) {
                    flash("Actualice el Stock de ".$product->name." antes continuar con la operacion" , 'danger')->important();
                    return redirect()->back();
                    $band=1;
              }
              $cant = $cant+1;
          }
          if ($band==0) {
              $venta = new Invoice;
              $venta->total=$order->total;
              $venta->status='Activo';
              $venta->client_id=$order->client_id;
              $venta->discount=$order->discount;
              $venta->save();
              //detalle de venta
              
              $cont = 0;
              while ( $cont < count($details) ) {
                  $detalle = new InvoiceProduct();
                  $detalle->invoice_id=$venta->id; 
                  $detalle->product_id=$details[$cont]->id;
                  $detalle->amount=$details[$cont]->amount;
                  $detalle->price=$details[$cont]->price;
                  $detalle->subTotal=$details[$cont]->amount*$details[$cont]->price;
                  $detalle->save();
                  $cont = $cont+1;

              }

              flash("El pedido N°". $order->id . " de ".$order->client->name." cambió de ".$order->status." a ".$request->status , 'success')->important();
              
              $order->fill($request->all());
              $order->save();

              
              return redirect()->route('orders.index');
              }      
     }
     
    }

}
