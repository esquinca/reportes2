@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View distribucion') )
    {{ trans('message.title_distribucion') }}
  @else
    {{ trans('message.title_distribucion') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View distribucion') )
    {{ trans('message.subtitle_detailed_distribucion') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View distribucion') )
    {{ trans('message.breadcrumb_detailed_distribucion') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View distribucion') )
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="media">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                        Distribución de Hoteles
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">
                                {{ csrf_field() }}
                                <div id="googlemap" style="height: 400px; width: 100%;"></div>
                            </div>
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
  @if( auth()->user()->can('View distribucion') )
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD07V9hwyUjrRCXiJHo9YdftE0VJIbRP8"></script>
    <script src="{{ asset('js/admin/inventory/distribucion.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
