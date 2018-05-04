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

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ocultar data_fact">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-inline">
                 {{ csrf_field() }}
                  <div class="form-group">
                    <label for="nfactura">Factura:</label>
                    <input type="text" class="form-control" id="nfactura" name="nfactura" maxlength="25" >
                  </div>
                  <div class="form-group">
                    <label for="date_fact">Fecha de factura:</label>
                    <input type="text" class="form-control" id="date_fact" name="date_fact" maxlength="10" >
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

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ocultar data_equipament">
          <div class="box box-solid">
            <div class="box-body">
              <div class="form-horizontal">
                 {{ csrf_field() }}
                 <div class="input-group">
                   <span class="input-group-addon">MAC <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                   <input id="add_mac_eq" name="add_mac_eq" type="text" class="form-control" maxlength="15" placeholder="MAC">
                 </div>
                 <br>

                 <div class="input-group">
                   <span class="input-group-addon">Núm. Serie <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                   <input id="add_num_se"  name="add_num_se"  type="text" class="form-control" placeholder="Núm. Serie" maxlength="20">
                 </div>
                 <br>

                 <div class="row">
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Grupo</span>
                       <input id="grupitho" name="grupitho" maxlength="50" type="text" placeholder="Grupo" class="form-control typeahead" data-provide="typeahead">
                     </div>
                   </div>
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Descripción <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <input id="add_descrip" name="add_descrip" maxlength="150" type="text" class="form-control" placeholder="Descripción">
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
                       <span class="input-group-addon">Marcas <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <select class="form-control select2" id="Marcas" name="Marcas">
                         <option value="" selected> Elija </option>

                       </select>
                       <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_marca">
                         <i class="fa fa-plus-square"></i>
                       </button>
                     </div>
                   </div>
                 </div>
                 <br>

                 <div class="row">
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Modelo <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <select class="form-control select2" id="mmodelo" name="mmodelo">
                         <option value="" selected> Elija </option>

                       </select>
                       <button type="button" class="btn btn-warning btn-sm btn_rmd" data-toggle="modal" data-target="#add_modelo">
                         <i class="fa fa-plus-square"></i>
                       </button>
                     </div>
                   </div>
                   <div class="col-lg-6">
                     <div class="input-group">
                       <span class="input-group-addon">Estado <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                       <select class="form-control select2" id="add_estado" name="add_estado">
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
                       <select class="form-control select2" id="venue" name="venue">
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

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ocultar data_temporal">
          <div class="table-responsive">
            <table id="table_temporality" name='table_temporality' class="table table-bordered table-hover" width="100%" cellspacing="0">
              <thead>
                <tr class="bg-primary" style="background: #088A68;">
                  <th> <small>Venue.</small> </th>
                  <th> <small>Equipo.</small> </th>
                  <th> <small>Marca.</small> </th>
                  <th> <small>Mac.</small> </th>
                  <th> <small>Serie.</small> </th>
                  <th> <small>Grupo.</small> </th>
                  <th> <small>Descripción.</small> </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-default fade" id="add_modelo" data-backdrop="static">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Modelo</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  @if( auth()->user()->can('Create model') )
                  <form class="form-inline" id="form_model" name="form_model">
                    {{ csrf_field() }}
                    <div class="form-group">
                     <label for="marcas_current">Marcas:</label>
                     <select class="form-control select2" id="marcas_current" name="marcas_current">
                       <option value="" selected> Elija </option>
                     </select>
                    </div>

                    <div class="form-group">
                      <label class="col-md-2 control-label" for="add_modelitho">{{ trans('message.ingmod')}} </label>
                      <div class="col-md-10">
                        <input id="add_modelitho" name="add_modelitho"  type="text"  maxlength="10" placeholder="{{ trans('message.maxcardiez')}}"
                          class="form-control input-md">
                      </div>
                    </div>
                  </form>
                  @else
                    <div class="col-xs-12">
                      @include('default.deniedmodule')
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            @if( auth()->user()->can('Create model') )
              <button type="button" class="btn bg-navy create_model"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button>
            @endif
            <button type="button" class="btn btn-danger close_model" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-default fade" id="add_marca" data-backdrop="static">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Marcas</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                  @if( auth()->user()->can('Create marcas') )
                  <form class="form-horizontal" id="form_marca" name="form_marca">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="add_marquitha">{{ trans('message.marcas')}} </label>
                      <div class="col-md-8">
                        <input id="add_marquitha" name="add_marquitha"  type="text"  maxlength="50" placeholder="{{ trans('message.maxcarcincuent')}}"
                          class="form-control input-md"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label" for="add_distribuidor">{{ trans('message.distribuidor')}} </label>
                      <div class="col-md-8">
                        <input id="add_distribuidor" name="add_distribuidor"  type="text"  maxlength="50" placeholder="{{ trans('message.maxcarcincuent')}}"
                          class="form-control input-md"/>
                      </div>
                    </div>
                  </form>
                  @else
                    <div class="col-xs-12">
                      @include('default.deniedmodule')
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            @if( auth()->user()->can('Create marcas') )
              <button type="button" class="btn bg-navy create_marca"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button>
            @endif
            <button type="button" class="btn btn-danger close_marca" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal modal-default fade" id="add_provider" data-backdrop="static">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>{{ trans('message.title_provider') }}</h4>
          </div>
          <div class="modal-body">
            <div class="box-body table-responsive">
              <div class="box-body">
                <div class="row">
                @if( auth()->user()->can('Create provider') )
                  <div class="col-xs-12">
                    <form id="reg_provider" name="reg_provider"  class="form-horizontal" action="">
                      {{ csrf_field() }}
                      <div class="input-group">
                        <span class="input-group-addon">RFC <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                        <input id="provider_rfc" name="provider_rfc" type="text" class="form-control" placeholder="RFC" maxlength="500" title=""/>
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon">Razón social (Nombre) <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                        <input id="provider_name" name="provider_name"  type="text" class="form-control" placeholder="Username" >
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Tipo fiscal <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                            <input id="provider_tf" name="provider_tf"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Delegación o Municipio</span>
                            <input id="provider_municipality" name="provider_municipality"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon">Dirección <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                        <input id="provider_address" name="provider_address"  type="text" class="form-control" placeholder="Username">
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Estado <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                            <input id="provider_estate" name="provider_estate"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">País <i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                            <input id="provider_country" name="provider_country"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">C.P</span>
                            <input id="provider_postcode" name="provider_postcode"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Telefono</span>
                            <input id="provider_phone" name="provider_phone"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Fax</span>
                            <input id="provider_fax" name="provider_fax"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input id="provider_email" name="provider_email"  type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                      </div>
                      <h4>Datos del agente o contacto</h4>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Nombre</span>
                            <input id="agent_name" name="agent_name" type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Telefono</span>
                            <input id="agent_phone" name="agent_phone" type="text" class="form-control" placeholder="Username">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                @else
                  <div class="col-xs-12">
                    @include('default.deniedmodule')
                  </div>
                @endif
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            @if( auth()->user()->can('Create provider') )
              <button type="button" class="btn bg-navy create_provider"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button>
            @endif
            <button type="button" class="btn btn-danger delete_provider" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
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
    .ocultar {
      display: none;
    }
   </style>
    <script src="{{ asset('js/admin/equipment/add_equipment.js')}}"></script>
    <script src="{{ asset('bower_components/Bootstrap-3-Typeahead-master/bootstrap3-typeahead.min.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
