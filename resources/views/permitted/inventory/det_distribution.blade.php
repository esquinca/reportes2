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
      Contenido de distribución
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View distribucion') )
    <script src="{{ asset('js/admin/inventory/distribucion.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
