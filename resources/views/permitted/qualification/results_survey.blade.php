@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.subtitle_results_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.breadcrumb_results_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View results survey') )

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <small>Se necesita aplicar un filtro para visualizar datos</small>
          <form id="filasasw" action="{{ url('result_filter') }}" method="post">
            <div id="filtration_container" name="filtration_container">
              <div id="filter_year" name="filter_year" class="row row-separation control-filter">
                <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
      						 <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>Año</strong>
      					</div>
                <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                  <select id="searchyear" name="searchyear" class="form-control">
                    <option value="" selected="selected">{{ trans('message.selectopt') }}</option>
                  </select>
                </div>
              </div>
              <div id="filter_month" name="filter_month" class="row row-separation control-filter">
                <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
      						 <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>Mes</strong>
      					</div>
                <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                  <select id="searchmonth" name="searchmonth" class="form-control">
                    <option value="" selected="selected">{{ trans('message.selectopt') }}</option>
                    @for ($i = 1; $i <=12; $i++)
                        <option value="{{ $i }}">
                          <?php
                          $mes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                          echo $mes = $mes[$i-1];
                          ?>
                        </option>
                    @endfor
                  </select>
                </div>
              </div>
              <div id="filter_vertical" name="filter_vertical" class="row row-separation control-filter">
                <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
      						 <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>Vertical</strong>
      					</div>
                <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                  <select id="searchvertical" name="searchvertical" class="form-control" style="width: 100%;">
                    <option value="" selected="selected">{{ trans('message.selectopt') }}</option>

                  </select>
                </div>
              </div>
              <div id="filter_operation" name="filter_operation" class="row row-separation control-filter">
                <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
      						 <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>Operación</strong>
      					</div>
                <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                  <select id="searchoperation" name="searchoperation" class="form-control" style="width: 100%;">
                    <option value="" selected="selected">{{ trans('message.selectopt') }}</option>
                    <option value="1">Wifi Admin</option>
                    <option value="2">Wifimedia</option>
                  </select>
                </div>
              </div>
              <div id="filter_average" name="filter_average" class="row row-separation control-filter">
                <div class="nowrap col-xs-4 col-sm-2 col-md-1 col-lg-1">
      						 <button id='' type="button" class="boton-mini btn btn-warning" ><i class="fa fa-minus-square" aria-hidden="true"></i></button> <strong>Promedio</strong>
      					</div>
                <div class="col-xs-8 col-sm-2 col-md-11 col-lg-1">
                  <select id="searchaverage" name="searchaverage" class="form-control" style="width: 100%;">
                    <!-- <option value="" selected="selected">{{ trans('message.selectopt') }}</option> -->
                    <option value="0">Sin promedio general</option>
                    <option value="1">Con promedio general</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-inline row-separation">
              <button id="boton-aplica-filtro-visitantes" type="button" class="btn btn-primary">
                <i class="glyphicon glyphicon-filter" aria-hidden="true"></i> Aplicar Filtro
              </button>
              <button id='boton_muestra_selectfiltro' type="button" class="btn btn-success">
                <i class="fa fa-plus-square" aria-hidden="true"></i> Añadir Filtro
              </button>
              <select id='selectfiltro'class ='selectFiltro' class="form-control">
                <option value="" selected="selected">{{ trans('message.selectopt') }}</option>
                <option value="filter_year">Año</option>
                <option value="filter_month">Mes</option>
                <option value="filter_vertical">Vertical</option>
                <option value="filter_operation">Operación</option>
                <option value="filter_average">Promedio General * Mes</option>
              </select>
            </div>
          </form>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="table-responsive">
            <table id="table_qualification" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th> <small>Vertical</small> </th>
                  <th> <small>Sitio</small> </th>
                  <th> <small id="mes01" name="mes01"></small> </th>
                  <th> <small id="mes02" name="mes02"></small> </th>
                  <th> <small id="mes03" name="mes03"></small> </th>
                  <th> <small id="mes04" name="mes04"></small> </th>
                  <th> <small id="mes05" name="mes05"></small> </th>
                  <th> <small id="mes06" name="mes06"></small> </th>
                  <th> <small id="mes07" name="mes07"></small> </th>
                  <th> <small id="mes08" name="mes08"></small> </th>
                  <th> <small id="mes09" name="mes09"></small> </th>
                  <th> <small id="mes10" name="mes10"></small> </th>
                  <th> <small id="mes11" name="mes11"></small> </th>
                  <th> <small id="mes12" name="mes12"></small> </th>
                  <th> <small>Año.</small> </th>
                  <th> <small>Prom.</small> </th>
                  <th> <small>Ind.</small> </th>
                  <th> <small>Ingeniero</small> </th>
                  <th> <small >Comentario</small> </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot id='tfoot_average'>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </div>
    </div>


    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View results survey') )
    <link rel="stylesheet" type="text/css" href="{{ asset('css/filter.css')}}" >
    <script src="{{ asset('js/admin/qualification/resultssurvey.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
