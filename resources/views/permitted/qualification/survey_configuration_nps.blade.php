@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View survey nps configuration') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View survey nps configuration') )
    {{ trans('message.subtitle_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View survey nps configuration') )
    {{ trans('message.breadcrumb_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View survey nps configuration') )
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#tab_3-2" data-toggle="tab">Option - Delete</a></li>
                  <li><a href="#tab_3-1" data-toggle="tab">Step 3 - See assignments</a></li>
                  <li><a href="#tab_2-2" data-toggle="tab">Step 2 - Assign</a></li>
                  <li class="active"><a href="#tab_1-1" data-toggle="tab">Step 1 - Add</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Basic User Configuration</li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1-1">
                    <div class="row">
                    @if( auth()->user()->can('Create user') )
                      <div class="col-xs-12">
                        <form id="creatusersystem" name="creatusersystem" class="form-horizontal" method="POST" data-toggle="validator" action="{{ url('data_create_client_config') }}">
                          <b class="text-center" style="text-decoration: underline;"><i class="fa fa-user-plus"></i> Añadir cliente</b>
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="inputCreatName" class="col-sm-2 control-label">{{ trans('auth.nombre')}}<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputCreatName" name="inputCreatName" placeholder="{{ trans('auth.nombre') }}" maxlength="60" title="" data-minlength="4" required data-error="Por favor ingrese al menos 4 caracteres"/>
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCreatEmail" class="col-sm-2 control-label">{{ trans('auth.email') }}<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="inputCreatEmail" name="inputCreatEmail" placeholder="{{ trans('auth.email') }}" maxlength="60" title="{{ trans('message.maxcarname')}}" required data-error="Por favor ingrese un correo valido.">
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCreatLocation" class="col-sm-2 control-label">{{ trans('auth.location')}}<span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                              <input type="text" id="inputCreatLocation" name="inputCreatLocation" class="form-control"  placeholder="{{ trans('auth.location') }}" maxlength="20" data-minlength="4" required data-error="Por favor ingrese al menos 4 caracteres">
                              <div class="help-block with-errors"></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                <button class="btn bg-navy" type="submit" id="capture_cu"><i class="fa fa-plus-square-o"></i> {{ trans('message.create')}}</button>
                                <a id="cancela_cu" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
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
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2-2">
                    <div class="row">
                      @if( auth()->user()->can('View assign hotel user') )
                      <div class="col-xs-12">
                        <form id="assign_hotel_client" name="assign_hotel_client" class="form-horizontal" method="POST" action="{{ url('creat_assign_surveyed') }}">
                          <b class="text-center" style="text-decoration: underline;"><i class="fa fa-handshake-o"></i> Asignar hotel a cliente</b>
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="select_clients" class="col-md-2 control-label">{{ trans('message.client') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_clients" name="select_clients"class="form-control select2">
                                <option value="" selected> Elija </option>
                                @forelse ($users as $data_users)
                                <option value="{{ $data_users->id }}"> {{ $data_users->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="select_hotels" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                            <div class="col-md-10">
                              <select id="select_hotels" name="select_hotels[]" multiple="multiple" class="form-control">
                                @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                <button id="capture_hc" type="submit" class="btn bg-navy" ><i class="fa fa-plus-square-o"></i> {{ trans('message.create')}}</button>
                                <!-- <a id="capture_hc" class="btn bg-navy create_user_data"><i class="fa fa-plus-square-o"></i> {{ trans('message.create')}}</a> -->
                                <a id="cancela_hc" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
                            </div>
                          </div>
                        </form>

                        <div class="alert alert-info alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-info"></i> Info!</h4>
                          Nota: Si usted selecciona un lugar ya asignado a dicho usuario, no se le volvera añadir.
                        </div>

                      </div>
                      @else
                        <div class="col-xs-12">
                          @include('default.deniedmodule')
                        </div>
                      @endif
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-1">
                    <div class="row">
                      @if( auth()->user()->can('View list assign hotel user') )
                        <div class="col-xs-12">
                          <div class="table-responsive">
                            <table id="see_venue_client" name='see_venue_client' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                              <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                              <thead>
                                <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                  <th> <small>Name User</small> </th>
                                  <th> <small>Venue</small> </th>
                                  <th> <small>Operación A</small> </th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      @else
                        <div class="col-xs-12">
                          @include('default.deniedmodule')
                        </div>
                      @endif
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3-2">
                    <div class="row">
                      @if( auth()->user()->can('View assign delete client') )
                      <div class="col-xs-12">
                        <form id="delete_all_client" name="delete_all_client" class="form-horizontal" method="POST">
                          <b class="text-center" style="text-decoration: underline;"><i class="fa fa-user-times"></i> Eliminar cliente:</b>
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="delete_clients" class="col-md-2 control-label">{{ trans('message.client') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="delete_clients" name="delete_clients"class="form-control">
                                <option value="" selected> Elija </option>
                                @forelse ($users as $data_users)
                                  <option value="{{ $data_users->id }}"> {{ $data_users->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                <a id="capture_dc" class="btn bg-navy create_user_data"><i class="fa fa-user-times"></i> {{ trans('message.eliminar')}}</a>
                                <a id="cancela_dc" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
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
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div>


            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li><a href="#tabs_two" data-toggle="tab">Option 2 - Automatic</a></li>
                  <li class="active"><a href="#tab_one" data-toggle="tab"> Option 1 - Individual</a></li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Sending of surveys </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_one">
                    <div class="row">
                      <div class="col-xs-12">

                        <form id="form_reg_survey" name="form_reg_survey" class="form-horizontal" method="POST">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <label for="select_one" class="col-md-2 control-label">{{ trans('message.vertical') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_one" name="select_one"class="form-control">
                                <option value="" selected> Elija </option>
                                @forelse (  App\Vertical::select('id', 'name')->get(); as $verticals)
                                  <option value="{{ $verticals->id }}"> {{ $verticals->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="select_two" class="col-md-2 control-label">{{ trans('message.user') }}</label>
                            <div class="col-md-10 selectContainer">
                              <select id="select_two" name="select_two[]" multiple="multiple" class="form-control">
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-12 text-center">
                                <a id="capture" class="btn btn-success capture" type="submit"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                                <a id="clear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                              </div>
                            </div>
                          </div>


                        </form>

                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tabs_two">
                    <div class="row">
                      <div class="col-xs-12">
                        <form id="multiselectForm" method="post" class="form-horizontal">
                          <div class="form-group">
                              <label class="col-xs-3 control-label">Language</label>
                              <div class="col-xs-5 selectContainer">
                                  <select name="language" class="form-control select2">
                                      <option value=""></option>
                                      <option value="arabic">Arabic</option>
                                      <option value="english">English</option>
                                      <option value="french">French</option>
                                      <option value="german">German</option>
                                      <option value="other">Other</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-xs-3 control-label">Browser</label>
                              <div class="col-xs-5">
                                  <select class="form-control" name="browsers" multiple>
                                      <option value="chrome">Google Chrome</option>
                                      <option value="firefox">Firefox</option>
                                      <option value="ie">IE</option>
                                      <option value="safari">Safari</option>
                                      <option value="opera">Opera</option>
                                      <option value="other">Other</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-5 col-xs-offset-3">
                                  <button type="submit" class="btn btn-default">Validate</button>
                              </div>
                          </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="media">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                      Ver usuarios encuestados
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                  <table id="example_survey" name='example_survey' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                                    <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                                    <thead>
                                        <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                            <th> <small>Hotel</small> </th>
                                            <th> <small>Email</small> </th>
                                            <th> <small>Estatus</small> </th>
                                            <th> <small>Operación A</small> </th>
                                            <th> <small>Operación B</small> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>

                            </div>
                        </div>
                    </div>
                  </div>
                 </div>
              </div>
            </div>

        </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View survey nps configuration') )
    <script src="{{ asset('js/form-validator.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}" >
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
        <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>

    <script src="{{ asset('js/admin/qualification/configurationsurveynps.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css') }}" type="text/css" />
    <script src="{{ asset('../bower_components/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js') }}"></script>
    <style media="screen">
    .multiselect-container {
        width: 100% !important;
        position: relative !important;
    }
    .select2-container {
      width: 100% !important;
    }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7LGUHYSQjKM4liXutm2VilsVK-svO1XA&libraries=places"></script>
    <script type="text/javascript">
        function initialize() {
            var options = {
                types: ['(cities)'],
                componentRestrictions: {country: "mx"}
            };
            if (document.getElementById("inpuEditlocation")) {
              var input = document.getElementById('inpuEditlocation');
              var autocomplete = new google.maps.places.Autocomplete(input, options);
            }

            if (document.getElementById("inputCreatLocation")) {
              var input_two = document.getElementById('inputCreatLocation');
              var autocomplete_two = new google.maps.places.Autocomplete(input_two, options);
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
      $('#assign_hotel_client')
          .formValidation({
              framework: 'bootstrap',
              excluded: ':disabled',
              icon: {
                  valid: 'glyphicon glyphicon-ok',
                  invalid: 'glyphicon glyphicon-remove',
                  validating: 'glyphicon glyphicon-refresh'
              },
              fields: {
                  'select_hotels[]': {
                      validators: {
                          callback: {
                              message: 'Please choose 1 to 12 hotels that you can assign',
                              callback: function(value, validator, $field) {
                                  // Get the selected options
                                  var options = validator.getFieldElements('select_hotels[]').val();
                                  return (options != null
                                          && options.length >= 1 && options.length <= 12);
                              }
                          }
                      }
                  },
                  select_clients: {
                      validators: {
                          notEmpty: {
                              message: 'Please select a client.'
                          }
                      }
                  }
              }
          })
          .find('[name="select_clients"]')
              .select2({
                placeholder: "Elije",

                  // dropdownAutoWidth : true,
                  // width: 'auto'
              })
              .change(function(e) {
                  /* Revalidate the language when it is changed */
                  $('#assign_hotel_client').formValidation('revalidateField', 'select_clients');
              })
              .end()
          .find('[name="select_hotels[]"]')
              .multiselect({
                  buttonWidth: '100%',
                  nonSelectedText: 'Elija uno o más',
                  maxHeight: 100,
                  // Re-validate the multiselect field when it is changed
                  onChange: function(element, checked) {
                      $('#assign_hotel_client').formValidation('revalidateField', 'select_hotels[]');

                      adjustByScrollHeight();
                  },
                  onDropdownShown: function(e) {
                      adjustByScrollHeight();
                  },
                  onDropdownHidden: function(e) {
                      adjustByHeight();
                  }
              })
              .end();

      // You don't need to care about these methods
      function adjustByHeight() {
          var $body   = $('body'),
              $iframe = $body.data('iframe.fv');
          if ($iframe) {
              // Adjust the height of iframe when hiding the picker
              $iframe.height($body.height());
          }
      }

      function adjustByScrollHeight() {
          var $body   = $('body'),
              $iframe = $body.data('iframe.fv');
          if ($iframe) {
              // Adjust the height of iframe when showing the picker
              $iframe.height($body.get(0).scrollHeight);
          }
      }
      });
    </script>
    <script>
      $(document).ready(function() {
          // You don't need to care about onDropdownShow, onDropdownHide options
          // and adjustByScrollHeight(), adjustByHeight() methods
          // They are for this specific demo
          $('#multiselectForm')
              .formValidation({
                  framework: 'bootstrap',
                  // Exclude only disabled fields
                  // The invisible fields set by Bootstrap Multiselect must be validated
                  excluded: ':disabled',
                  icon: {
                      valid: 'glyphicon glyphicon-ok',
                      invalid: 'glyphicon glyphicon-remove',
                      validating: 'glyphicon glyphicon-refresh'
                  },
                  fields: {
                      browsers: {
                          validators: {
                              callback: {
                                  message: 'Please choose 2-3 browsers you use for developing',
                                  callback: function(value, validator, $field) {
                                      // Get the selected options
                                      var options = validator.getFieldElements('browsers').val();
                                      return (options != null
                                              && options.length >= 2 && options.length <= 3);
                                  }
                              }
                          }
                      },
                      language: {
                          validators: {
                              notEmpty: {
                                  message: 'Please select your native language.'
                              }
                          }
                      }
                  }
              })
              .find('[name="language"]')
                  .select2()
                  .change(function(e) {
                      /* Revalidate the language when it is changed */
                      $('#multiselectForm').formValidation('revalidateField', 'language');
                  })
                  .end()
              .find('[name="browsers"]')
                  .multiselect({
                      enableFiltering: true,
                      includeSelectAllOption: true,
                      // Re-validate the multiselect field when it is changed
                      onChange: function(element, checked) {
                          $('#multiselectForm').formValidation('revalidateField', 'browsers');

                          adjustByScrollHeight();
                      },
                      onDropdownShown: function(e) {
                          adjustByScrollHeight();
                      },
                      onDropdownHidden: function(e) {
                          adjustByHeight();
                      }
                  })
                  .end();

          // You don't need to care about these methods
          function adjustByHeight() {
              var $body   = $('body'),
                  $iframe = $body.data('iframe.fv');
              if ($iframe) {
                  // Adjust the height of iframe when hiding the picker
                  $iframe.height($body.height());
              }
          }

          function adjustByScrollHeight() {
              var $body   = $('body'),
                  $iframe = $body.data('iframe.fv');
              if ($iframe) {
                  // Adjust the height of iframe when showing the picker
                  $iframe.height($body.get(0).scrollHeight);
              }
          }
      });
      </script>



  @else
    <!--NO VER-->
  @endif
@endpush
