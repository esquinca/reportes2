@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View add equipment') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View add equipment') )
    {{ trans('message.subtitle_add_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View add equipment') )
    {{ trans('message.breadcrumb_add_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View add equipment') )
    <form id="reg_provider" name="reg_provider"  class="form-horizontal" action="">
      {{ csrf_field() }}
      <div class="input-group">
        <span class="input-group-addon">MAC <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
        <input name="provider_rfc" type="text" class="form-control" placeholder="MAC">
      </div>
      <br>

      <div class="input-group">
        <span class="input-group-addon">Núm. Serie <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
        <input name="provider_name"  type="text" class="form-control" placeholder="Núm. Serie">
      </div>
      <br>

      <div class="row">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Descripción <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <input name="provider_tf"  type="text" class="form-control" placeholder="Descripción">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Grupo</span>
            <input name="provider_municipality"  type="text" class="form-control" placeholder="Grupo">
          </div>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Modelo <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <select class="form-control select2" id="Modelo">
              <option value="" selected> Elija </option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Marcas <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <select class="form-control select2" id="Marcas">
              <option value="" selected> Elija </option>
            </select>
          </div>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Estado <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <select class="form-control select2" id="estado">
              <option value="" selected> Elija </option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Check IT <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <select class="form-control select2" id="Check IT">
              <option value="" selected> Elija </option>
            </select>
          </div>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Hotel <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <select class="form-control select2" id="estado">
              <option value="" selected> Elija </option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="input-group">
            <span class="input-group-addon">Tipo equipo <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
            <select class="form-control select2" id="type_equipment">
              <option value="" selected> Elija </option>
            </select>
          </div>
        </div>
      </div>
      <br>

    </form>

    <div  class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <hr/>
          <span>
              <strong id="title_table1">Registros</strong>
          </span>
        <hr/>
      </div>
    </div>

    <div class='row'>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="table-responsive">
          <table id="table_cont_user" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Hotel</th>
                <th> <small>mes01</small> </th>
                <th> <small>mes02</small> </th>
                <th> <small>mes03</small> </th>
                <th> <small>mes04</small> </th>
                <th> <small>mes05</small> </th>
                <th> <small>mes06</small> </th>
                <th> <small>mes07</small> </th>
                <th> <small>mes08</small> </th>
                <th> <small>mes09</small> </th>
                <th> <small>mes10</small> </th>
                <th> <small>mes11</small> </th>
                <th> <small>mes12</small> </th>
                <th> <small>Promedio</small> </th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>

    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View add equipment') )
    <script src="{{ asset('js/admin/equipment/add_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
