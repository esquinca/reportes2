@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View individual general report') )
    {{ trans('message.title_edit_capture_indiv') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View individual general report') )
    {{ trans('message.subtitle_edit_capture_indiv') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View individual general report') )
    {{ trans('message.breadcrumb_edit_capture_indiv') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View individual general report') )
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
@if( auth()->user()->can('View individual general report') )

@else
<!--NO VER-->
@endif
@endpush
