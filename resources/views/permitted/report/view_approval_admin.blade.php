@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View admin approval') )
    {{ trans('message.title_admin_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View admin approval') )
    {{ trans('message.subtitle_admin_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View admin approval') )
    {{ trans('message.breadcrumb_admin_approval') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View admin approval') )
    @else
      @include('default.denied')
    @endif
@endsection
@push('scripts')
  @if( auth()->user()->can('View admin approval') )

  @else
    <!--NO VER-->
  @endif
@endpush
