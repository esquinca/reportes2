@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View history travel requests') )
    {{ trans('message.viaticos_history_request') }}
  @else
    {{ trans('message.viaticos_history_request') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View history travel requests') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View history travel requests') )
    {{ trans('message.breadcrumb_viaticos_hist') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View history travel requests') )
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View history travel requests') )

  @else
    <!--NO VER-->
  @endif
@endpush
