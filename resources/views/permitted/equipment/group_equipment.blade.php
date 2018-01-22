@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View equipment group') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View equipment group') )
    {{ trans('message.subtitle_group_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View equipment group') )
    {{ trans('message.breadcrumb_group_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View equipment group') )
      Grupo de equipos
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View equipment group') )
    <script src="{{ asset('js/admin/equipment/group_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
