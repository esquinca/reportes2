@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View cover') )
    {{ trans('message.title_cover') }}
  @else
    {{ trans('message.title_cover') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View cover') )
    {{ trans('message.subtitle_detailed_cover') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View cover') )
    {{ trans('message.breadcrumb_detailed_cover') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View cover') )
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="form-inline">
                      {{ csrf_field() }}

                      <div class="form-group">
                        <label for="select_one" class="control-label">{{ trans('message.hotel') }}: </label>
                        <select id="select_one" name="select_one"  class="form-control select2" required>
                          <option value="" selected> Elija </option>
                          @forelse ($hotels as $data_hotel)
                            <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                          @empty
                          @endforelse
                        </select>
                      </div>
                      <div class="form-group">
                          <button type="button" class="btn btn-info btngeneral"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.generate') }}</button>
                          <button type="button" class="btn btn-success btn-export hidden-xs"><i class="fa fa-file-pdf-o  margin-r5"></i> {{ trans('message.export') }} Portada</button>
                      </div>
                  </div>
                 </div>
              </div>
            </div>


            <div id="captura_pdf_general" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="hojitha"   style="background-color: #fff; border:1px solid #ccc; border-bottom-style:hidden; padding:10px; width: 100%">
                  <div class="row pad-top-botm ">
                      <div class="col-lg-3 col-md-3 col-sm-3 ">
                         <img class="logo-sit" src="{{ asset('/images/users/logo.svg') }}" style="padding-bottom:20px;" />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <h2> <small>Carta de entrega</small></h2>
                        <strong id="name_htl">Hard Rock Cancún</strong>
                        <br />
                        <strong>Equipo activo</strong>
                        <br />
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 ">
                         <img class="logo-sit" src="{{ asset('images/hotel/Hard_Rock_Punta_Cana.svg') }}" style="padding-bottom:20px;" />
                      </div>
                  </div>

                  <div class="row text-center contact-info">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                          <hr />
                          <span>
                              <strong>Email : </strong>  info@sitwifi.com
                          </span>
                          <span>
                              <strong>Telf : </strong>  8-84-46-30
                          </span>
                           <span>
                              <strong>Expedición: </strong>  @php
                                $mytime = Carbon\Carbon::now();
                                echo $mytime->toDateTimeString();
                              @endphp
                          </span>
                          <hr />
                      </div>
                  </div>

                  <div  class="row pad-top-botm client-info">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <p class="text-center" style="border: 1px solid #FF851B" >Empresa</p>
                      <strong>Nombre: </strong> SITWIFI S.A de C.V
                      <br />
                      <strong>Responsable:</strong> Ricardo Delgado
                      <br />
                      <strong>Área de trabajo:</strong> Cancun, Mexico
                      <br />
                      <strong>Dirección:</strong> Hamburgo 159 Colonia Juarez Código postal 06600, Mexico, Distrito Federal
                      <br />
                      <strong>Teléfono:</strong> 018001121122
                      <br />
                      <strong>Correo:</strong> rdelgado@sitwifi.com
                      <br />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <p class="text-center" style="border: 1px solid #007bff" >Cliente</p>
                      <strong>Nombre: </strong> Hard Rock Cancún
                      <br />
                      <strong>Responsable:</strong> Ricardo Delgado
                      <br />
                      <strong>Ubicación:</strong> Cancun, Mexico
                      <br />
                      <strong>Dirección:</strong> Hamburgo 159 Colonia Juarez Código postal 06600, Mexico, Distrito Federal
                      <br />
                      <strong>Teléfono:</strong> 018001121122
                      <br />
                      <strong>Correo:</strong> rdelgado@sitwifi.com
                      <br />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <br />
                      <p class="text-center" style="border: 1px solid #3D9970" >Información</p>
                      Las instalaciones de los equipos se realizaron acorde a cada uno de los términos y condiciones, respetando así el tiempo estipulado para las instalaciones.
                      <br />
                      <strong>Fecha de inicio del proyecto: </strong> 2018-02-02 08:54:19
                      <br />
                      <strong>Fecha de termino del proyecto:</strong> 2018-02-02 08:54:19
                      <br />
                    </div>

                  </div>

                  <div  class="row text-center contact-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <hr />
                        <span>
                            <strong>Equipamiento</strong>
                        </span>
                      <hr />
                    </div>
                  </div>

                  <div class="row pad-top-botm client-info">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <div id="main_equipos" style="width: 100%; min-height: 400px; border:1px solid #ccc;padding:10px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <div id="main_modelos" style="width: 100%; min-height: 400px; border:1px solid #ccc;padding:10px;"></div>
                        </div>
                    </div>
                  </div>
                  <div class="row pad-top-botm client-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="clearfix">
                          <div id="comentarios" style="width: 100%; min-height: 200px; border:1px solid #ccc;padding:10px;">Observaciones o comentarios:</div>
                        </div>
                    </div>
                  </div>

                  <div class="row pad-top-botm client-info text-center">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <hr>
                          <strong>Nombre y Firma del responsable del proyecto.</strong>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="clearfix">
                          <hr>
                          <strong>Nombre y Firma del cliente.</strong>
                      </div>
                    </div>
                  </div>
              </div>
            </div>



        </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View cover') )
    <script src="{{ asset('bower_components/jsPDF/dist/jspdf.min.js')}}"></script>
    <script src="{{ asset('bower_components/html2canvas/html2canvas.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf.css')}}" >
    <script src="{{ asset('js/admin/inventory/cover.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
