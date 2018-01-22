@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View survey configuration') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View survey configuration') )
    {{ trans('message.subtitle_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View survey configuration') )
    {{ trans('message.breadcrumb_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View survey configuration') )
      Content configuration survey
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View survey configuration') )
    <script src="{{ asset('js/admin/qualification/configurationsurvey.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
