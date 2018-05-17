@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard travel expenses') )
    {{ trans('message.viaticos_dashboard_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard travel expenses') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard travel expenses') )
    {{ trans('message.breadcrumb_dashboard_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard travel expenses') )
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row">
            <form id="search_info" name="search_info" class="form-inline" method="post">
              {{ csrf_field() }}
              <div class="col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input id="date_to_search" type="text" class="form-control" name="date_to_search">
                </div>
              </div>
              <div class="col-sm-10">
                <button id="boton-aplica-filtro" type="button" class="btn btn-info filtrarDashboard">
                  <i class="glyphicon glyphicon-filter" aria-hidden="true"></i>  Filtrar
                </button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
          <!------------------------------------------------------------------------>
          <div class="row">
            <div class="col-md-3">
              <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <div class="box box-solid">
                    <div class="description-block box-body">
                      <h3 id="total_survey" class="description-header text-blue">0</h3>
                      <b><span class="description-text">Total de solicitudes</span></b>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-12 col-xs-12">
                  <div class="box box-solid">
                    <div class="description-block box-body">
                      <h3 id="answered" class="description-header text-green">0</h3>
                      <b><span class="description-text">Solicitudes aprobadas</span></b>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-12 col-xs-12">
                  <div class="box box-solid">
                    <div class="description-block box-body">
                      <h3 id="unanswered" class="description-header text-orange">0</h3>
                      <b><span class="description-text">Solicitudes pendientes</span></b>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-12 col-xs-12">
                  <div class="box box-solid">
                    <div class="description-block box-body">
                      <h3 id="unanswered" class="description-header text-red">0</h3>
                      <b><span class="description-text">Solicitudes denegadas</span></b>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </div>

            <div class="col-md-9">
              <div class="row">
                <div class="col-md-6">
                  <div class="clearfix" style="background: #ffffff;">
                    <div id="main_venue" style="width: 100%; min-height: 390px; border:1px solid #ccc;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                  <div class="row pt-10">
                    <div class="col-sm-12 col-xs-12">
                      <div class="box box-solid">
                        <div class="description-block box-body">
                          <h3 id="total_survey" class="description-header text-blue">0</h3>
                          <b><span class="description-text">Total de gastos</span></b>
                        </div>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-12 col-xs-12">
                      <div class="box box-solid">
                        <div class="description-block box-body">
                          <h3 id="answered" class="description-header text-green">0</h3>
                          <b><span class="description-text">Gasto Transporte</span></b>
                        </div>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-12 col-xs-12">
                      <div class="box box-solid">
                        <div class="description-block box-body">
                          <h3 id="unanswered" class="description-header text-orange">0</h3>
                          <b><span class="description-text">Gasto Alimentación</span></b>
                        </div>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-12 col-xs-12">
                      <div class="box box-solid">
                        <div class="description-block box-body">
                          <h3 id="unanswered" class="description-header text-red">0</h3>
                          <b><span class="description-text">Gasto Otros</span></b>
                        </div>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
          <!------------------------------------------------------------------------>
        </div>
      </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View dashboard travel expenses') )
  <style media="screen">
    .pt-10 {
      padding-top: 10px;
    }
  </style>
  @else
    <!--NO VER-->
  @endif
@endpush
