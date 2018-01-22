@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View server review') )
    {{ trans('message.title_review') }}
  @else
    {{ trans('message.title_review') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View server review') )
    {{ trans('message.subtitle_server_review') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View server review') )
    {{ trans('message.breadcrumb_server_review') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View server review') )
      Contenido de revision de server
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View server review') )
    <script src="{{ asset('js/admin/tools/server.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
