@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.subtitle_move_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.breadcrumb_move_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View move equipment') )
      Mover equipos
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View move equipment') )
    <script src="{{ asset('js/admin/equipment/move_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
