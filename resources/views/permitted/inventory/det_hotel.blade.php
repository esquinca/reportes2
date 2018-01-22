@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View detailed for hotel') )
    {{ trans('message.title_reports') }}
  @else
    {{ trans('message.title_reports') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View detailed for hotel') )
    {{ trans('message.subtitle_detailed_hotel') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View detailed for hotel') )
    {{ trans('message.breadcrumb_detailed_hotel') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View detailed for hotel') )
      Contenido de hotel detallado
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View detailed for hotel') )
    <script src="{{ asset('js/admin/inventory/hoteld.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
