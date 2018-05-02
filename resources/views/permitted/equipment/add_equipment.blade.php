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
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-inline">
                 {{ csrf_field() }}
                 <div class="form-group">
                   <div class="col-sm-12">
                      <label class="control-label">¿Cuenta con factura?</label>
                      <label class="radio-inline"> <input type="radio" name="facturitha" id="yes" value="yes" class="flat-red"> Si </label>
                      <label class="radio-inline"> <input type="radio" name="facturitha" id="no" value="no" class="flat-red"> No </label>
                   </div>
                 </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-inline">
                 {{ csrf_field() }}
                  <div class="form-group">
                    <label for="factura">Factura:</label>
                    <input type="text" class="form-control" id="factura">
                  </div>
                  <div class="form-group">
                    <label for="date_fact">Fecha de factura:</label>
                    <input type="text" class="form-control" id="date_fact">
                  </div>
                  <div class="form-group">
                    <label for="select_one" class="control-label">{{ trans('message.title_provider') }}: </label>
                    <select id="select_one" name="select_one"  class="form-control select2" required>
                      <option value="" selected> Elija </option>
                      @forelse ($proveedores as $data_proveedores)
                        <option value="{{ $data_proveedores->id }}"> {{ $data_proveedores->nombre }} </option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_provider">
                    <i class="fa fa-plus-square margin-r5"></i> Nuevo Proveedor
                  </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-horizontal">
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
                       <span class="input-group-addon">Grupo</span>
                       <input id="provider_municipality" name="provider_municipality" type="text" placeholder="Grupo" class="form-control typeahead" data-provide="typeahead">
                       <!-- <input name="provider_municipality"  type="text" class="form-control" placeholder="Grupo"> -->
                     </div>
                   </div>
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Descripción <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <input name="provider_tf"  type="text" class="form-control" placeholder="Descripción">
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
                         @forelse ($modelos as $data_modelos)
                           <option value="{{ $data_modelos->id }}"> {{ $data_modelos->ModeloNombre }} </option>
                         @empty
                         @endforelse
                       </select>
                       <button type="button" class="btn btn-warning btn-sm">
                         <i class="fa fa-plus-square"></i>
                       </button>
                     </div>
                   </div>
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Marcas <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <select class="form-control select2" id="Marcas">
                         <option value="" selected> Elija </option>
                         @forelse ($marcas as $data_marcas)
                           <option value="{{ $data_marcas->id }}"> {{ $data_marcas->Nombre_marca }} </option>
                         @empty
                         @endforelse
                       </select>
                       <button type="button" class="btn btn-warning btn-sm">
                         <i class="fa fa-plus-square"></i>
                       </button>
                     </div>
                   </div>
                 </div>
                 <br>

                 <div class="row">
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Tipo equipo <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <select class="form-control select2" id="type_equipment">
                         <option value="" selected> Elija </option>
                         @forelse ($especificaciones as $data_especificaciones)
                           <option value="{{ $data_especificaciones->id }}"> {{ $data_especificaciones->name }} </option>
                         @empty
                         @endforelse
                       </select>
                     </div>
                   </div>
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Estado <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <select class="form-control select2" id="estado">
                         <option value="" selected> Elija </option>
                         @forelse ($estados as $data_estados)
                           <option value="{{ $data_estados->id }}"> {{ $data_estados->Nombre_estado }} </option>
                         @empty
                         @endforelse
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
                         @forelse ($hotels as $data_hotel)
                           <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                         @empty
                         @endforelse
                       </select>
                     </div>
                   </div>
                   <div class="col-lg-6">
                     <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-save"><i class="fa fa-save"></i> Guardar</button>
                        <button type="button" class="btn btn-default btn-clear"><i class="fa fa-eraser"></i> Limpiar</button>
                        <button type="button" class="btn btn-danger btn-cancel"><i class="fa fa-times"></i> Cancelar</button>
                     </div>
                   </div>
                 </div>
                 <br>

              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
            <form id="table_check" method="POST">
               <table id="table_temporality" cellspacing="0" class="table table-striped table-bordered table-hover">
                 <thead>
                   <tr class="bg-primary" style="background: #088A68;">
                     <th> <small>Venue.</small> </th>
                     <th> <small>Equipo.</small> </th>
                     <th> <small>Marca.</small> </th>
                     <th> <small>Mac.</small> </th>
                     <th> <small>Serie.</small> </th>
                     <th> <small>Modelo.</small> </th>
                     <th> <small>Estado.</small> </th>
                     <th> <small>Grupo.</small> </th>
                     <th> <small>Descripción.</small> </th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot id='tfoot_average'>
                   <tr>
                   </tr>
                 </tfoot>
               </table>
             </form>
           </div>
         </div>



      </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View add equipment') )
   <style media="screen">
    ul.typeahead.dropdown-menu {
      max-height: 150px;
      overflow: auto;
    }
   </style>
    <script src="{{ asset('js/admin/equipment/add_equipment.js')}}"></script>
    <script src="{{ asset('bower_components/Bootstrap-3-Typeahead-master/bootstrap3-typeahead.min.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
