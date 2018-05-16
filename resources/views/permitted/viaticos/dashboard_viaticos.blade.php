@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard travel expenses') )
    {{ trans('message.viaticos_dashboard_request') }}
  @else
    {{ trans('message.viaticos_dashboard_request') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard travel expenses') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard travel expenses') )
    {{ trans('message.breadcrumb_dashboard_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard travel expenses') )
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View dashboard travel expenses') )

  @else
    <!--NO VER-->
  @endif
@endpush
