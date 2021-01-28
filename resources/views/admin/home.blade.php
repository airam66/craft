@extends('layouts.main')
 
 
@section('content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">

        <!-- Default box -->
        <div class="box box-info text-center">
          
          <h1> <b>Bienvenido al panel de administración</b></h1>


                  <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Pedido</h3>
                  <p>Nuevo Pedido</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a href="{{route('orders.create')}}" class="small-box-footer Nuevo_pedido">Hacer click aquí <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Venta</h3>
                  <p>Nueva Venta</p>
                </div>
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
                <a href="{{route('invoices.create')}}" class="small-box-footer Nueva_venta">Hacer clik aquí  <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Calendario</h3>
                  <p> Ir a calendario</p>
                </div>
                <div class="icon">
                  <i class="fa fa-calendar"></i>
                </div>
                <a href="{{route('calendar')}}" class="small-box-footer Calendario">Hacer click aquí <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Productos</h3>
                  <p>Lista de Productos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-gift"></i>
                </div>
                <a href="{{route('products.index')}}" class="small-box-footer Lista_productos">Hacer click aquí <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
        </section>  
       </div>
      </div>
    </div>
  </div>
@endsection
