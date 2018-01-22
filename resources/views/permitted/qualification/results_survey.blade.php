@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.subtitle_results_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View results survey') )
    {{ trans('message.breadcrumb_results_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View results survey') )
      Content results survey
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View results survey') )
    <script src="{{ asset('js/admin/qualification/resultssurvey.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
