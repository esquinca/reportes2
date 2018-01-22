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
      Contenido de carta de entrega
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View cover') )
    <script src="{{ asset('js/admin/inventory/cover.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
