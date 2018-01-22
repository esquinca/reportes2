@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View guest review') )
    {{ trans('message.title_review') }}
  @else
    {{ trans('message.title_review') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View guest review') )
    {{ trans('message.subtitle_guest_review') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View guest review') )
    {{ trans('message.breadcrumb_guest_review') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View guest review') )
      Contenido de revision de huspedes
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View guest review') )
    <script src="{{ asset('js/admin/tools/guest.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
