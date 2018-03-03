@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View report concat') )
    {{ trans('message.title_reports') }}
  @else
    {{ trans('message.title_reports') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View report concat') )
    {{ trans('message.subtitle_view_report') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View report concat') )
    {{ trans('message.breadcrumb_view_report') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View report concat') )
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="form-inline">
                      {{ csrf_field() }}
                      <div class="form-group">
                        <label for="select_one" class="control-label">{{ trans('message.cadena') }}: </label>
                        <select id="select_one" name="select_one"  class="form-control select2" required>
                          @forelse ($cadena as $data_cadena)
                            <option value="{{ $data_cadena->id }}"> {{ $data_cadena->name }} </option>
                          @empty
                          @endforelse
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="calendar_fecha" class="control-label">{{ trans('message.date') }}:</label>
                        <input type="text" class="form-control datepickermonth" id="calendar_fecha" placeholder="Example: 2017-12">
                      </div>
                      <div class="form-group">
                          <button type="button" id="btn_generar" class="btn btn-info btngeneral"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.generate') }}</button>
                          <button type="button" class="btn btn-success btn-export hidden-xs"><i class="fa fa-file-pdf-o  margin-r5"></i> {{ trans('message.export') }}</button>
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
                        <h2><strong id='title'> Reporte concentrado anual</strong></h2>
                        <strong style="font-style: italic;">Red wifi colaboradores</strong>
                        <br />
                        <p id="client_name">name cadena</p>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-3 ">
                         <img class="logo-sit" id="client_img" src="{{ asset('images/hotel/Hard_Rock_Punta_Cana.svg') }}" style="padding-bottom:20px;" />
                      </div>
                  </div>

                  <div class="row text-center contact-info">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                          <hr />
                          <span>
                              <strong>Email : </strong><small id="email"></small>
                          </span>
                          <span>
                              <strong>Telf : </strong><small id="tel"></small>
                          </span>
                           <span>
                              <strong>Expedición: </strong>  <small id='date'> @php
                                $mytime = Carbon\Carbon::now();
                                echo $mytime->toDateTimeString();
                              @endphp
                              </small>
                          </span>
                          <hr />
                      </div>
                  </div>

                  <div  class="row pad-top-botm text-center contact-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <hr />
                        <span>
                            <strong id="title_table1">Concentrado Usuarios</strong>
                        </span>
                      <hr />
                    </div>
                  </div>
                  <div class="row pad-top-botm client-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="table-responsive">
                        <table id="table_cont_user" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Hotel</th>
                              <th> <small id="mes01" name="mes01">mes01</small> </th>
                              <th> <small id="mes02" name="mes02">mes02</small> </th>
                              <th> <small id="mes03" name="mes03">mes03</small> </th>
                              <th> <small id="mes04" name="mes04">mes04</small> </th>
                              <th> <small id="mes05" name="mes05">mes05</small> </th>
                              <th> <small id="mes06" name="mes06">mes06</small> </th>
                              <th> <small id="mes07" name="mes07">mes07</small> </th>
                              <th> <small id="mes08" name="mes08">mes08</small> </th>
                              <th> <small id="mes09" name="mes09">mes09</small> </th>
                              <th> <small id="mes10" name="mes10">mes10</small> </th>
                              <th> <small id="mes11" name="mes11">mes11</small> </th>
                              <th> <small id="mes12" name="mes12">mes12</small> </th>
                              <!-- <th> <small id="mes13" name="mes13">Promedio</small> </th> -->
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="row pad-top-botm text-center contact-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <hr />
                        <span>
                            <strong id="title_table2">Concentrado GB</strong>
                        </span>
                      <hr />
                    </div>
                  </div>
                  <div class="row pad-top-botm client-info">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="table-responsive">
                        <table id="table_cont_gb" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Hotel</th>
                              <th> <small id="mes01b" name="mes01">Diciembre</small> </th>
                              <th> <small id="mes02b" name="mes02">Diciembre</small> </th>
                              <th> <small id="mes03b" name="mes03">Diciembre</small> </th>
                              <th> <small id="mes04b" name="mes04">Diciembre</small> </th>
                              <th> <small id="mes05b" name="mes05">Diciembre</small> </th>
                              <th> <small id="mes06b" name="mes06">Diciembre</small> </th>
                              <th> <small id="mes07b" name="mes07">Diciembre</small> </th>
                              <th> <small id="mes08b" name="mes08">Diciembre</small> </th>
                              <th> <small id="mes09b" name="mes09">Diciembre</small> </th>
                              <th> <small id="mes10b" name="mes10">Diciembre</small> </th>
                              <th> <small id="mes11b" name="mes11">Diciembre</small> </th>
                              <th> <small id="mes12b" name="mes12">Diciembre</small> </th>
                              <th> <small id="prom" name="prom">Promedio</small> </th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                        </table>
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
  @if( auth()->user()->can('View report concat') )
    <script src="{{ asset('bower_components/jsPDF/dist/jspdf.min.js')}}"></script>
    <script src="{{ asset('bower_components/html2canvas/html2canvas.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf.css')}}" >
    <script src="/plugins/momentupdate/moment-with-locales.js"></script>
    <script src="{{ asset('js/admin/report/view_reports_cont.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
