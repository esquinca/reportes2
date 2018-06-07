@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View cover delivery') )
    {{ trans('message.title_cover_delivery') }}
  @else
    {{ trans('message.title_cover_delivery') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View cover delivery') )
    {{ trans('message.subtitle_cover_delivery') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View cover delivery') )
    {{ trans('message.breadcrumb_cover_delivery') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View cover delivery') )


    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View cover delivery') )

  @else
    <!--NO VER-->
  @endif
@endpush
