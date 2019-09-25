@extends('layouts.main')

@section('content')
<!-- Main content -->
        <section class="content">

          <div class="row">
            <!--PAGINA SOBRE NOSOSTROS-->
            <div class="col-md-6">

              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="text-center">PÁGINA "SOBRE NOSOTROS"</h3>
                </div>
                <div class="box-body">
                    
                    <!-- PARA AGREGAR UNA DESCRIPCION-->
                   <div class="form-group">
                    <h4><strong>Descripción</strong></h4>
                     <form>
                      <textarea class="textarea" placeholder="Escribe una descripción" style="width: 100%; height: 345px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        @if ($cotillon && $cotillon->description_AboutUs)
                          {!!$cotillon->description_AboutUs!!}
                        @endif
                      </textarea>
                     </form>
                    </div><!-- /.form group description -->

                   <!-- PARA AGREGAR UNA IMAGEN-->
                  <div class="form-group" style="height: 400%;">
                    <h4><strong>Imagen</strong></h4>
                        <input type="file" class="foto" name="fotoContacto" required>
                        <!-- <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>-->
                        @if ($cotillon && $cotillon->image_AboutUs)
                            <img src="{{asset('images/'.$cotillon->image_AboutUs)}}" class="img-thumbnail previsualizarFoto" width="100%">
                        @endif
                  </div><!-- /.form group imagen -->

                </div><!-- /.box-body -->
              </div><!-- /.box sobre nosotros -->    
            </div><!-- /.col (left) -->
            <!-- FIN PAGINA SOBRE NOSOTROS-->

            <!--PAGINA DE CONTACTO-->
            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="text-center">  PAGINA "CONTACTO" </h3>
                </div>
                <div class="box-body">

                  <!-- HORARIO DE ATENCION -->
                  <div class="form-group">
                    <h4> <strong>Horario de atención</strong> </h4>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                         <input type="text" class="form-control pull-right" id="reservationtime"
                           @if ($cotillon && $cotillon->business_hours) 
                              value="{{ $cotillon->business_hours}}"
                           @endif
                          >   
                    </div><!-- /.input group -->
                  </div><!-- /.form group HORARIO DE ATENCION -->


                  <!-- TELEFONO -->
                  <div class="form-group">
                    <h4> <strong> Teléfono</strong> </h4>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationphones"
                          @if ($cotillon && $cotillon->phones) 
                              value="{{ $cotillon->phones}}"
                          @endif
                      >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <!-- DIRECCION -->
                  <div class="form-group">
                    <h4> <strong> Dirección</strong> </h4>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationphones"
                          @if ($cotillon && $cotillon->address) 
                              value="{{ $cotillon->address}}"
                          @endif
                      >
                    </div><!-- /.input group -->
                  </div><!-- /.form group DIRECCION -->

                   <!-- UBICACION -->
                  <div class="form-group">
                    <h4> <strong> Ubicación en el mapa</strong> </h4>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationphones"
                          @if ($cotillon && $cotillon->position) 
                              value="{{ $cotillon->position}}"
                          @endif
                      >
                    </div><!-- /.input group -->
                  </div><!-- /.form group UBICACION -->

                  <!-- EMAIL -->
                  <div class="form-group">
                    <h4> <strong> Email </strong> </h4>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-at"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationphones"
                          @if ($cotillon && $cotillon->email) 
                              value="{{ $cotillon->email}}"
                          @endif
                      >
                    </div><!-- /.input group -->
                  </div><!-- /.form group EMAIL -->

                  <!-- FACEBOOK -->
                  <div class="form-group">
                    <h4> <strong> Facebook </strong> </h4>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-facebook"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="reservationphones"
                          @if ($cotillon && $cotillon->facebook) 
                              value="{{ $cotillon->facebook}}"
                          @endif
                      >
                    </div><!-- /.input group -->
                  </div><!-- /.form group FACEBOOK -->

                   <!-- PARA AGREGAR UNA IMAGEN contacto-->
                  <div class="form-group">
                    <h4><strong>Imagen</strong></h4>
                        <input type="file" class="fotoContacto" name="fotoContacto" required>
                        <!-- <p class="help-block">Tamaño recomendado 1280px * 720px <br> Peso máximo de la foto 2MB</p>-->
                        @if ($cotillon && $cotillon->image_AboutUs)
                            <img src="{{asset('images/'.$cotillon->image_Contact)}}" class="img-thumbnail previsualizarFotoC" width="100%">
                        @endif
                  </div><!-- /.form group imagen contacto -->

                </div><!-- /.box-body -->
              </div><!-- /.box PAGINA CONTACTO -->

            </div><!-- /.col (right) -->
          </div><!-- /.row -->


        </section><!-- /.content -->



@endsection