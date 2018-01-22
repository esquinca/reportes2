@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View test zd') )
    {{ trans('message.title_review') }}
  @else
    {{ trans('message.title_review') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View test zd') )
    {{ trans('message.subtitle_test_zd') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View test zd') )
    {{ trans('message.breadcrumb_test_zd') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View test zd') )
      Contenido de test zd
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View test zd') )
    <script src="{{ asset('js/admin/tools/zone.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
