@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View detailed for hotel with cost') )
    {{ trans('message.title_reports') }}
  @else
    {{ trans('message.title_reports') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View detailed for hotel with cost') )
    {{ trans('message.subtitle_detailed_hotel_costs') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View detailed for hotel with cost') )
    {{ trans('message.breadcrumb_detailed_hotel_costs') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View detailed for hotel with cost') )
      Contenido de hotel detallado con costos
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View detailed for hotel with cost') )
    <script src="{{ asset('js/admin/inventory/hotelc.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
