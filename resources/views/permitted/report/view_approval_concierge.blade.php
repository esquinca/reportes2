@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View concierge approval') )
    {{ trans('message.title_concierge_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View concierge approval') )
    {{ trans('message.subtitle_concierge_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View concierge approval') )
    {{ trans('message.breadcrumb_concierge_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View concierge approval') )

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="pull-right">
                    <a href="javascript:void(0);" onclick="enviar_approval(this)"  class="btn btn-success" role="button" data-target="#add_approval">
                      <i class="fa fa-plus-square margin-r5"></i> Nueva Aprobación
                    </a>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      </br>
                      <div class="table-responsive">
                        <table class="table" id="table_approval_c" name='table_approval_c' class="hover" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th> <small>Hotel</small> </th>
                                  <th> <small>Tipo</small> </th>
                                  <th> <small>Mes</small> </th>
                                  <th> <small>Estatus</small> </th>
                                  <th> <small>Opciones</small> </th>
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
    </div>

    @else
      @include('default.denied')
    @endif
@endsection
@push('scripts')
  @if( auth()->user()->can('View concierge approval') )
    <script src="{{ asset('js/admin/report/approval_concierge.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
