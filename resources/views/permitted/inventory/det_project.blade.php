@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View detailed for proyect') )
    {{ trans('message.title_reports') }}
  @else
    {{ trans('message.title_reports') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View detailed for proyect') )
    {{ trans('message.subtitle_detailed_hotel_proyect') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View detailed for proyect') )
    {{ trans('message.breadcrumb_detailed_hotel_proyect') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View detailed for proyect') )
      Contenido de proyecto
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View detailed for proyect') )
    <script src="{{ asset('js/admin/inventory/hotelp.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
