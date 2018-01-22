@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View create survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View create survey') )
    {{ trans('message.subtitle_create_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View create survey') )
    {{ trans('message.breadcrumb_create_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View create survey') )
      Content create survey
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View create survey') )
    <script src="{{ asset('js/admin/qualification/createsurvey.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
