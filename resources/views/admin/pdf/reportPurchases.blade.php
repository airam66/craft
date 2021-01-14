<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Reporte de Compras Mensuales</title>
    <link rel="stylesheet" href="{{'css/pdf.css'}}" media="all" />
  </head>
  <body >
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('images/cotillon.png ') }}" >
      </div>
      <h1>REPORTE DE COMPRAS MENSUALES AÑO {{date('Y')}}</h1>
      
    </header>
     <h3>Fecha de emisión: {{date('d-m-Y')}}</h3>

  @php ($a = 0)   
  @php ($m = 0) 
  @foreach($data2 as $month)

    <h3 class="subtitle">Mes: {{strtoupper(nameMonth($month))}}</h3>
        @php ($total = 0.0)
      <main>
       <table>
              <thead>
               <tr>
                <th>N° Factura</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>

      @foreach($data as $purchase)
      

         @if ($month == date_format($purchase->created_at,'n'))
         @php ($total = $total + $purchase->total)          
       
       

                              <tr>
                              <td class="text-center">{{$purchase->number_invoice}}</td>
                              <td class="text-center">{{date('d-m-Y',strtotime($purchase->created_at))}}</td>
                              <td class="text-center">{{$purchase->provider->name}}</td>
                              <td class="text-center">${{$purchase->total}}</td>
                              </tr>
           @else
           
           @endif
        
      @endforeach
            </tbody>
          </table> 
        @php ($m = $m +1) 
        <div class="pull-right" >
                 <h3>Total del Mes: ${{$total}} </h3>
              </div>

  @endforeach
    
  </body>
</html>