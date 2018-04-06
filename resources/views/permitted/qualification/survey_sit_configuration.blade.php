@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View config sitwifi') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View config sitwifi') )
    {{ trans('message.subtitle_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View config sitwifi') )
    {{ trans('message.breadcrumb_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View config sitwifi') )
      <div class="container">
        <div class="row">

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_one" data-toggle="tab"> Registro</a></li>
                <li class="pull-left header"><i class="fa fa-th"></i> Survey record</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_one">
                  <div class="row">
                    <div class="col-xs-12">

                      <form id="form_survey_manualpl" name="form_survey_manualpl" class="form-horizontal" method="POST" action="{{ url('create_manual_survey_record') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_ind_one" class="col-md-2 control-label">{{ trans('message.domain') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_ind_one" name="select_ind_one"class="form-control">
                              <option value="" selected> Elija </option>
                              @forelse ($dominios as $data_domain)
                              <option value="{{ $data_domain->domain }}"> {{ $data_domain->domain }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="select_ind_two" class="col-md-2 control-label">{{ trans('message.user') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_ind_two" name="select_ind_two[]" multiple="multiple" class="form-control">
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="select_idsurvey" class="col-md-2 control-label">{{ trans('message.survey') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_idsurvey" name="select_idsurvey"class="form-control">
                              <option value="" selected> Elija </option>
                              @forelse ($encuestas as $data_survey)
                              <option value="{{ $data_survey->id }}"> {{ $data_survey->name }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-2 control-label" for="month_upload_band">{{ trans('message.period')}} </label>
                          <div class="col-md-10">
                            <div class="input-group input-daterange">
                              <input name="date_start"  type="text" class="form-control" value="">
                              <div class="input-group-addon">to</div>
                              <input name="date_end"  type="text" class="form-control" value="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label" for="month_evaluate">{{ trans('message.monthtoevaluate')}} </label>
                          <div class="col-md-10">
                            <input id="month_evaluate" name="month_evaluate"  type="text"  maxlength="10" placeholder="" class="form-control input-md">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-12 text-center">
                              <button id="capture" type="submit" class="btn btn-success" ><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</button>
                              <a id="clear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                            </div>
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
                                  <table id="survey_personal" name='survey_personal' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                                    <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                                    <thead>
                                        <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                            <th> <small>Hotel</small> </th>
                                            <th> <small>Email</small> </th>
                                            <th> <small>Estatus</small> </th>
                                            <th> <small>Estado</small> </th>
                                            <th> <small>Fecha corresponde</small> </th>
                                            <th> <small>Fecha inicio</small> </th>
                                            <th> <small>Fecha fin</small> </th>
                                            <th> <small>Operación A</small> </th>
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
  @if( auth()->user()->can('View config sitwifi') )
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
  <script type="text/javascript">
    $(document).ready(function() {
      clearmultiselect('select_ind_two');
      $('.input-daterange').datepicker({language: 'es', format: "yyyy-mm-dd",});
      $('#month_evaluate').datepicker({
          language: 'es',
          defaultDate: '',
          format: "yyyy-mm",
          viewMode: "months",
          minViewMode: "months",
          endDate: '1m', //Esto indica que aparecera el mes hasta que termine el ultimo dia del mes.
          autoclose: true
      });
      table_surveyed_sit();
    });

    $('#select_ind_one').on('change', function(e){
        var id = $(this).val();
        var _token = $('input[name="_token"]').val();
        if (id != ''){
          let countC = 0;
          $.ajax({
            type: "POST",
            url: "./search_user_domain",
            data: { domain : id , _token : _token },
            success: function (data){
              countH = data.length;
              if (countH === 0) {
                $('#select_ind_two').empty();
                $("#select_ind_two").multiselect('destroy');
                clearmultiselect('select_ind_two');
              }
              else{
                $("#select_ind_two").multiselect('destroy');
                $('#select_ind_two').empty();
                $.each(JSON.parse(data),function(index, objdata){
                  $('#select_ind_two').append('<option value="'+objdata.id+'">'+ objdata.name +'</option>');
                });
                $('#select_ind_two').multiselect({
                  includeSelectAllOption: true,
                  buttonWidth: '100%',
                  nonSelectedText: 'Elija uno o más',
                  maxHeight: 100,
                 });
              }
            },
            error: function (data) {
              console.log('Error:', data);
            }
          });
        }
        else{
          $('#select_ind_two').empty();
          $("#select_ind_two").multiselect('destroy');
          clearmultiselect('select_ind_two');
        }

    });
    function clearmultiselect(campo){
          $('#'+campo).multiselect({
            buttonWidth: '100%',
            nonSelectedText: 'Elija uno o más',
            maxHeight: 100,
          });
          $('#'+campo).multiselect('deselectAll', false);
          $('#'+campo).multiselect('updateButtonText');
      }

      function table_surveyed_sit(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
          type: "POST",
          url: "./show_survey_table_sit",
          data: { _token : _token },
          success: function (data){
              table_surveys_clients_sit(data, $("#survey_personal"));
          },
          error: function (data) {
            console.log('Error:', data);
          }
        });
      }
      function getValueStatus(qty) {
          var retval;
          var val=qty;
          if (val == '1') { retval = '<span class="label label-success">Activo</span>';}
          if (val == '2') { retval = '<span class="label label-danger">Inactivo</span>';}
          if (val == '') { retval = '';}
          return retval;
      }
      function getV(qty) {
        var retval;
        var val=qty;
        if (val = '1') { retval = '<span class="label label-success">Contestada</span>';}
        if (val = '0') { retval = '<span class="label label-danger">No contestada</span>';}
        if (val == '') { retval = '';}
        return retval;
      }

      function table_surveys_clients_sit(datajson, table){
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_with_pdf_client_hotel);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
          vartable.fnAddData([
            status.name,
            status.email,
            getValueStatus(status.estatus_id),
            getV(status.estatus_res),
            status.fecha_corresponde,
            status.fecha_inicial,
            status.fecha_fin,
            '<a href="javascript:void(0);" onclick="enviarMail(this)" value="'+status.id_eu+'" class="btn bg-navy btn-xs" role="button" data-target="#Send_mailnps"><i class="fa fa-share-square"></i> Reenviar Mail</a>'
          ]);
        });
      }

      function enviarMail(e) {
        var valor= e.getAttribute('value');
        var _token = $('input[name="_token"]').val();
        $.ajax({
          type: "POST",
          url: "./send_mail_sit",
          data: {  uh : valor , _token : _token },
          success: function (data){
              if (data == '1') {
                menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
                table_surveyed_clients();
              }
          },
          error: function (data) {
            console.log('Error:', data);
          }
        });
      }


  </script>
  @else
    <!--NO VER-->
  @endif
@endpush
