<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de compras a proveedores</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>REPORTE DE COMPRAS A PROVEEDORES</h1>
      
    </header>
      

      @foreach($data2 as $provider)

             <div class="provider">
           <p class="name"><b>Proveedor:</b>  {{$provider->name}}<b> --   CUIT/CUIL:</b>  {{$provider->cuit}} <b> -- Direccion:</b> {{$provider->address}} </p>
            </div>
         
        
         
            <main>
             <table>
              <thead>
               <tr>
                <th>Factura</th>
                <th>Fecha</th>
                <th>Total</th>
                </tr>
                </thead> 
                 <tbody>
                 
                    @foreach($data as $purchase)

                      
                         @if($provider->provider_id == $purchase->provider_id)
                            <tr>
                            <td class="text-center">{{$purchase->number_invoice}}</td>
                            <td class="text-center">{{$purchase->created_at->format('d/m/Y')}}</td>
                            <td class="text-center">${{$purchase->total}}</td>
                            </tr>
                          @endif
                      

                     @endforeach 
         
                </tbody>

             </table> 
            </main>
      @endforeach
            

    <footer>
     
    </footer>
    
  </body>
</html>