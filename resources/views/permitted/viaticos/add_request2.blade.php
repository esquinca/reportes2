@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.viaticos_add_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.breadcrumb_viaticos_add') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View add request of travel expenses') )
    <!--  Content create survey -->
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <div style="padding:10px; width: 100%">
                  @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                  @endif
                  <div id="exampleValidator" class="wizard">
                      <ul class="wizard-steps" role="tablist">
                          <li class="active" role="tab">
                              <h4><span><i class="fa fa-address-card"></i></span>Requerimientos</h4>
                          </li>
                          <li role="tab">
                              <h4><span><i class="fa fa-list-ol"></i></span>Conceptos</h4>
                          </li>
                          <!-- <li role="tab">
                              <h4><span><i class="fa fa-save"></i></span>Password</h4> </li> -->
                      </ul>
                      <form id="validation" name="validation" class="form-horizontal" action="{{ url('create_survey_record') }}" method="POST" >
                        {{ csrf_field() }}
                          <div class="wizard-content">
                              <div class="wizard-pane active" role="tabpanel">
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Servicio</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="service_id" class="form-control">
                                                <option value="" selected></option>
                                                @forelse ($service as $data_service)
                                                  <option value="{{ $data_service->id }}"> {{ $data_service->name }} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Gerente</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="gerente_id" class="form-control">
                                                <option value="" selected></option>
                                                @forelse ($jefe as $data_jefe)
                                                  <option value="{{ $data_jefe->id }}"> {{ $data_jefe->Nombre }} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>


                                  </div>

                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Beneficiario</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="user_id" class="form-control">
                                              <option value="" selected></option>
                                              @forelse ($beneficiary as $data_beneficiary)
                                                <option value="{{ $data_beneficiary->id }}"> {{ $data_beneficiary->name }} </option>
                                              @empty
                                              @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Solicitante</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="user_id" class="form-control">
                                              @forelse ($user as $data_user)
                                                <option value="{{ $data_user->id }}"> {{ $data_user->name }} </option>
                                              @empty
                                              @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>



                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                         <label class="col-xs-3 control-label">Fecha Inicio</label>
                                         <div class="col-xs-9 dateContainer">
                                             <div class="input-group input-append date" id="startDatePicker" name="startDatePicker">
                                                 <input type="text" class="form-control" name="startDate" />
                                                 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                             </div>
                                         </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-3 control-label">Fecha Fin</label>
                                        <div class="col-xs-9 dateContainer">
                                            <div class="input-group input-append date" id="endDatePicker" name="endDatePicker">
                                                <input type="text" class="form-control" name="endDate" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                         <label class="col-xs-3 control-label">Lugar Origen</label>
                                         <div class="col-xs-9">
                                             <input type="text" class="form-control" name="place_o" />
                                         </div>
                                      </div>
                                    </div>

                                    <div class="col-lg-6">
                                      <div class="form-group">
                                         <label class="col-xs-3 control-label">Lugar Destino</label>
                                         <div class="col-xs-9">
                                             <input type="text" class="form-control" name="place_d" />
                                         </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label class="col-xs-1 control-label">Descripción</label>
                                        <div class="col-xs-11">
                                            <textarea class="form-control" name="descripcion" rows="3"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--..........................................................................-->
                              </div>
                              <div class="wizard-pane" role="tabpanel">
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Preguntas</label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="option[]" />
                                    </div>
                                    <div class="col-xs-4">
                                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                  <div class="form-group hide" id="optionTemplate">
                                      <div class="col-xs-offset-3 col-xs-5">
                                          <input class="form-control" type="text" name="option[]" />
                                      </div>
                                      <div class="col-xs-4">
                                          <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                                      </div>
                                  </div>
                              </div>
                              <!-- <div class="wizard-pane" role="tabpanel">
                                  <div class="form-group">
                                      <label class="col-xs-3 control-label">Password</label>
                                      <div class="col-xs-5">
                                          <input type="password" class="form-control" name="password" /> </div>
                                  </div>
                              </div> -->
                          </div>
                      </form>
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
  @if( auth()->user()->can('View add request of travel expenses') )
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/css/wizard.css')}}" >

    <!-- Form Wizard JavaScript -->
    <script src="{{ asset('plugins/jquery-wizard-master/dist/jquery-wizard.js')}}"></script>
    <!-- FormValidation -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}" >
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>
    <style media="screen">
      .wizard-steps{display:table;width:100%}
      .wizard-steps>li{
        display:table-cell;
        padding:10px 20px;
        background:#f7fafc
      }
      .wizard-steps>li span{
        border-radius:100%;
        border:1px solid rgba(120,130,140,.13);
        width:40px;
        height:40px;
        display:inline-block;
        vertical-align:middle;
        padding-top:9px;
        margin-right:8px;
        text-align:center
      }
      .wizard-content{
        padding:25px;
        border-color:rgba(120,130,140,.13);
        margin-bottom:30px
      }
      .wizard-steps>li.current,.wizard-steps>li.done{
        background:#228AE6;
        color:#fff
       }
       .wizard-steps>li.current span,.wizard-steps>li.done span{
         border-color:#fff;color:#fff
       }
       .wizard-steps>li.current h4,.wizard-steps>li.done h4{
         color:#fff
       }
       .wizard-steps>li.done{
         background:#1ED760
       }
       .wizard-steps>li.error{
         background:#E73431
       }
    </style>
    <script type="text/javascript">
      (function() {
       // The maximum number of options
       var MAX_OPTIONS = 5;
       $('#exampleValidator').wizard({
         onInit: function() {
             $('#validation')
             .find('[name="service_id"]')
                .select2()
                .change(function(e) {
                    $('#validation').formValidation('revalidateField', 'service_id');
                })
                .end()
             .find('[name="cadena_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'cadena_id');
                 })
                 .end()
             .find('[name="user_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'user_id');
                 })
                 .end()
             .find('[name="gerente_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'gerente_id');
                 })
                 .end()
             .find('[name="startDate"]')
                 .datepicker({
                     format: 'dd/mm/yyyy'
                 })
                 .on('changeDate', function(e) {
                     $('#validation').formValidation('revalidateField', 'startDate');
                 })
                 .end()
             .find('[name="endDate"]')
                 .datepicker({
                     format: 'dd/mm/yyyy'
                 })
                 .on('changeDate', function(e) {
                     $('#validation').formValidation('revalidateField', 'endDate');
                 })
                 .end()
             .formValidation({
               framework: 'bootstrap',
               excluded: ':disabled',
               icon: {
                   valid: 'glyphicon glyphicon-ok',
                   invalid: 'glyphicon glyphicon-remove',
                   validating: 'glyphicon glyphicon-refresh'
               },
               fields: {
                 service_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a service.'
                         }
                     }
                 },
                 cadena_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a proyect.'
                         }
                     }
                 },
                 user_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a user.'
                         }
                     }
                 },
                 gerente_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a manager.'
                         }
                     }
                 },
                 startDate: {
                    validators: {
                        notEmpty: {
                            message: 'The start date is required'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            max: 'endDate',
                            message: 'The start date is not a valid'
                        }
                    }
                 },
                 endDate: {
                    validators: {
                        notEmpty: {
                            message: 'The end date is required'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            min: 'startDate',
                            message: 'The end date is not a valid'
                        }
                    }
                 },
                 place_o: {
                    validators: {
                        notEmpty: {
                            message: 'The origin place  is required'
                        }
                    }
                 },
                 place_d: {
                    validators: {
                        notEmpty: {
                            message: 'The destination place is required'
                        }
                    }
                 },
                 descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'The description is required'
                        },
                        stringLength: {
                            max: 700,
                            message: 'The description must be less than 700 characters long'
                        }
                    }
                 }
               }
             })
             .on('success.field.fv', function(e, data) {
                if (data.field === 'startDate' && !data.fv.isValidField('endDate')) {
                    // We need to revalidate the end date
                    data.fv.revalidateField('endDate');
                }
                if (data.field === 'endDate' && !data.fv.isValidField('startDate')) {
                    // We need to revalidate the start date
                    data.fv.revalidateField('startDate');
                }
            })
         },
         validator: function() {
             var fv = $('#validation').data('formValidation');
             var $this = $(this);
             // Validate the container
             fv.validateContainer($this);
             var isValidStep = fv.isValidContainer($this);
             if (isValidStep === false || isValidStep === null) {
               //alert('false');
                 return false;
             }
             return true;
         },

        })
      })();
    </script>

  @else
    <!--NO VER-->
  @endif
@endpush
