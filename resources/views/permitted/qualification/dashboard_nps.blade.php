@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard survey nps') )
    {{ trans('message.dashboard') }}
  @else
    {{ trans('message.dashboard') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard survey nps') )
    {{ trans('message.subtitle_survey_nps') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard survey nps') )
    {{ trans('message.breadcrumb_survey_nps') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard survey nps') )
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="row">
              <form id="search_info" name="search_info" class="form-inline" method="post">
                {{ csrf_field() }}
                <div class="col-sm-2">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input id="date_to_search" type="text" class="form-control" name="date_to_search">
                  </div>
                </div>
                <div class="col-sm-10">
                  <button id="boton-aplica-filtro" type="button" class="btn btn-info filtrarDashboard">
                    <i class="glyphicon glyphicon-filter" aria-hidden="true"></i>  Filtrar
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <!------------------------------------------------------------------------>
            <div class="row">
              <div class="col-md-3">
                <div class="row">
                  <div class="col-sm-12 col-xs-12">
                    <div class="box box-solid">
                      <div class="description-block box-body">
                        <h3 id="total_survey" class="description-header text-blue">0</h3>
                        <b><span class="description-text">Total encuestas</span></b>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-12 col-xs-12">
                    <div class="box box-solid">
                      <div class="description-block box-body">
                        <h3 id="answered" class="description-header text-green">0</h3>
                        <b><span class="description-text">Respondieron</span></b>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-12 col-xs-12">
                    <div class="box box-solid">
                      <div class="description-block box-body">
                        <h3 id="unanswered" class="description-header text-red">0</h3>
                        <b><span class="description-text">Sin respuesta</span></b>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
              </div>

              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-6">
                    <div class="clearfix" style="background: #ffffff;">
                      <div id="main_nps" style="width: 100%; min-height: 320px; border:1px solid #ccc;"></div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                    <div class="row pt-10">
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-green"><i class="fa fa-smile-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Promotores</span>
                            <span class="info-box-number" id="total_promotores">0</span>

                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-yellow"><i class="fa fa-meh-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Pasivos</span>
                            <span class="info-box-number" id="total_pasivos">0</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-red"><i class="fa fa-frown-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Detractores</span>
                            <span class="info-box-number" id="total_detractores">0</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-sm-12 col-xs-12">
                        <div class="box box-solid">
                          <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                              Comparación Anual
                          </h4>
                          <div class="description-block box-body">
                            <table class="table table-striped" id="tabla_comparativa" name='tabla_comparativa'>
                              <thead>
                                  <tr>
                                    <th class="text-center">Año</th>
                                    <th class="text-center">NPS</th>
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
                  <!-- /.col -->
                </div>
              </div>
            </div>
            <!------------------------------------------------------------------------>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="clearfix" style="background: #ffffff;">
                    <div id="main_grap_nps" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                  </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="clearfix" style="background: #ffffff;">
                    <div id="main_grap_nps_per_month" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                  </div>
              </div>
            </div>
          </div>


          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                    Comparativa NPS vs Encuestados por mes
                </h4>
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="clearfix" style="background: #ffffff;">
                  <div id="main_grap_user_vs_request" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
                </div>
              </div>
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="table-responsive" style="background: #ffffff;">
                  <table id="table_top_aps" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Concepto</th>
                        <th>April 2017</th>
                        <th>May 2017</th>
                        <th>June 2017</th>
                        <th>July 2017</th>
                        <th>August 2017</th>
                        <th>September 2017</th>
                        <th>October 2017</th>
                        <th>November 2017</th>
                        <th>December 2017</th>
                        <th>January 2018</th>
                        <th>February 2018</th>
                        <th>March 2018</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>NPS</td>
                        <td>48.3 </td>
                        <td>69.2</td>
                        <td>231.6</td>
                        <td>46.6</td>
                        <td>55.4</td>
                        <td>230</td>
                        <td>600</td>
                        <td>10</td>
                        <td>55</td>
                        <td>89</td>
                        <td>147</td>
                        <td>75</td>
                      </tr>
                      <tr>
                        <td>Usuarios encuestados</td>
                        <td>320</td>
                        <td>302</td>
                        <td>301</td>
                        <td>334</td>
                        <td>390</td>
                        <td>330</td>
                        <td>800</td>
                        <td>85</td>
                        <td>76</td>
                        <td>98</td>
                        <td>120</td>
                        <td>78</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="box box-solid">

                  <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                      Promedio de calificaciones por vertical
                  </h4>
                  <div class="description-block box-body">
                    <div class="table-responsive" style="background: #ffffff;">
                      <table id="table_top_aps" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Vertical</th>
                            <th>Sitios</th>
                            <th>April 2017</th>
                            <th>May 2017</th>
                            <th>June 2017</th>
                            <th>July 2017</th>
                            <th>August 2017</th>
                            <th>September 2017</th>
                            <th>October 2017</th>
                            <th>November 2017</th>
                            <th>December 2017</th>
                            <th>January 2018</th>
                            <th>February 2018</th>
                            <th>March 2018</th>
                            <th>Identificador</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Hospitalidad</td>
                            <td>63</td>
                            <td>48.3 </td>
                            <td>69.2</td>
                            <td>231.6</td>
                            <td>46.6</td>
                            <td>55.4</td>
                            <td>230</td>
                            <td>600</td>
                            <td>10</td>
                            <td>55</td>
                            <td>89</td>
                            <td>147</td>
                            <td>75</td>
                            <td>SUBIO</td>
                          </tr>
                          <tr>
                            <td>Educacion</td>
                            <td>30</td>
                            <td>320</td>
                            <td>302</td>
                            <td>301</td>
                            <td>334</td>
                            <td>390</td>
                            <td>330</td>
                            <td>800</td>
                            <td>85</td>
                            <td>76</td>
                            <td>98</td>
                            <td>120</td>
                            <td>78</td>
                            <td>BAJO</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="clearfix" style="background: #ffffff;">
                    <div id="main_gra_grade_avg_per_month" style="width: 100%; min-height: 300px; border:1px solid #ccc;padding:10px;"></div>
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
  @if( auth()->user()->can('View capture survey') )

  <script src="{{ asset('plugins/momentupdate/moment.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/momentupdate/moment-with-locales.js') }}" type="text/javascript"></script>
    <style media="screen">
      .pt-10 {
        padding-top: 10px;
      }
    </style>
    <script type="text/javascript">
      $(function() {
        moment.locale('es');
        data_nps();
        data_compare_nps();
        graph_nps();
        graph_nps_per_month();
        main_grap_user_vs_request();
        main_grap_avg_per_month();

        $('#date_to_search').datepicker({
          language: 'es',
          format: "yyyy-mm",
          viewMode: "months",
          minViewMode: "months",
          endDate: '-1m',
          autoclose: true,
          clearBtn: true
        });
        $('#date_to_search').val('').datepicker('update');

      });

      $('.filtrarDashboard').on('click', function(){
        // data_nps();
        // data_compare_nps();
        // graph_nps();
        // graph_nps_per_month();
        modTableCali();
      });


      function data_nps(){
        var _token = $('input[name="_token"]').val();
        var objData = $('#search_info').find("select,textarea, input").serialize();
        $.ajax({
             type: "POST",
             url: '/summary_info_nps',
             data: objData,
             success: function (data) {
                // console.log(data);
                $.each(JSON.parse(data), function(index, status){
                  if(status.Concepto == 'Promotores') {   $('#total_promotores').text(status.Count); }
                  if(status.Concepto == 'Pasivos') {   $('#total_pasivos').text(status.Count); }
                  if(status.Concepto == 'Detractores') {   $('#total_detractores').text(status.Count); }
                  if(status.Concepto == 'NPS') {   graph_gauge('main_nps', 'NPS', '100', '100', status.Count); }
                  if(status.Concepto == 'Abstenidos') {   $('#unanswered').text(status.Count); }
                  if(status.Concepto == 'Respondieron') {   $('#answered').text(status.Count); }
                  if(status.Concepto == 'Encuestas Enviadas') {   $('#total_survey').text(status.Count); }
                });
             },
             error: function (data) {
               menssage_toast('Mensaje', '2', 'Operation Abort' , '3000');
             }
         })
      }
      function data_compare_nps(){
        var _token = $('input[name="_token"]').val();
        var objData = $('#search_info').find("select,textarea, input").serialize();
        // alert(objData);
        $.ajax({
             type: "POST",
             url: '/show_comparative_year',
             data: objData,
             success: function (data) {
              //  console.log(data);
               table_comparative(data, $("#tabla_comparativa"));
             },
             error: function (data) {
               menssage_toast('Mensaje', '2', 'Operation Abort' , '3000');
             }
         })
      }
      function table_comparative(datajson, table){
        table.DataTable().destroy();
        var vartable = table.dataTable(Configuration_table_responsive_simple);
        vartable.fnClearTable();
        $.each(JSON.parse(datajson), function(index, status){
        vartable.fnAddData([
            status.Periodo,
            status.NPS
          ]);
        });
      }
      function graph_nps() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_count1 = [];
        var data_name1 = [];
        // var data_count1 = [{value:98, name:'Promotores = 98'},{value:62, name:'Pasivos = 62'},{value:21, name:'Detractores = 21'}];
        // var data_name1 = ["Promotores = 98","Pasivos = 62","Detractores = 21"];
        $.ajax({
            type: "POST",
            url: "/get_graph_nps",
            data: objData,
            success: function (data){
              $.each(JSON.parse(data),function(index, objdata){
                data_name1.push(objdata.Concepto + ' = ' + objdata.Count);
                data_count1.push({ value: objdata.Count, name: objdata.Concepto + ' = ' + objdata.Count},);
              });
              graph_pie_default_four_with_porcent('main_grap_nps', data_name1, data_count1, 'Grafica', 'NPS', 'left');
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }
      function graph_nps_per_month() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_month = [];
        var value_promotores = [];
        var value_pasivos = [];
        var value_detractores = [];
        var data_name = ["Promotores","Pasivos","Detractores"];
        // var data_month = ["September 2016","October 2016", "November 2016", "December 2016", "January 2017", "February 2017", "March 2017"];
        // var value_promotores = [320, 302, 301, 234, 390, 330, 800];
        // var value_pasivos = [132, 202, 101, 314, 90, 330, 600];
        // var value_detractores = [120, 402, 231, 134, 130, 430, 100];
        $.ajax({
            type: "POST",
            url: "/get_graph_ppd",
            data: objData,
            success: function (data){
              $.each(JSON.parse(data),function(index, objdata){
                data_month.push(objdata.Fecha);
                value_promotores.push(objdata.Promotores);
                value_pasivos.push(objdata.Pasivos);
                value_detractores.push(objdata.Detractores);
              });
              graph_bar_with_three_val_insideRight('main_grap_nps_per_month',data_name, data_month, value_promotores, value_pasivos, value_detractores);
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });
      }

      function modTableCali() {
      	var datepicker3 = $('#date_to_search').val();

        if (datepicker3 == ''){
          var datepicker3 = moment().subtract(1, 'months').format('YYYY-MM');
        }

      	var datemod = datepicker3.split("-");
      	var goodFormat = datemod[0] + "-" + datemod[1];

        var cont = [];
        var meses = [];

        for (var i = 0; i <= 11; i++) {
          meses.push(moment(goodFormat).subtract(i, 'months').format('YYYY MMMM'));
        }
        // console.log(meses);
        return meses;
      }


      function main_grap_user_vs_request() {
        var objData = $('#search_info').find("select,textarea, input").serialize();
        var data_name =[];
        var data_month = [];
        var value_nps = [];
        var value_requests = [];

        $.ajax({
            type: "POST",
            url: "/get_graph_uvsr",
            data: objData,
            success: function (data){
              $.each(JSON.parse(data),function(index, objdata){
                data_name.push(objdata.Concepto);
                if (index == 0) {
                  value_nps.push(objdata.a12);
                  value_nps.push(objdata.a11);
                  value_nps.push(objdata.a10);
                  value_nps.push(objdata.a9);
                  value_nps.push(objdata.a8);
                  value_nps.push(objdata.a7);
                  value_nps.push(objdata.a6);
                  value_nps.push(objdata.a5);
                  value_nps.push(objdata.a4);
                  value_nps.push(objdata.a3);
                  value_nps.push(objdata.a2);
                  value_nps.push(objdata.a1);
                }
                else {
                  value_requests.push(objdata.a12);
                  value_requests.push(objdata.a11);
                  value_requests.push(objdata.a10);
                  value_requests.push(objdata.a9);
                  value_requests.push(objdata.a8);
                  value_requests.push(objdata.a7);
                  value_requests.push(objdata.a6);
                  value_requests.push(objdata.a5);
                  value_requests.push(objdata.a4);
                  value_requests.push(objdata.a3);
                  value_requests.push(objdata.a2);
                  value_requests.push(objdata.a1);
                }
              });
              console.log(data);
              console.log(data_name);
              console.log(value_nps);
              console.log(value_requests);
              data_month = modTableCali();

              console.log(data_month);
              grap_user_vs_request('main_grap_user_vs_request',data_name, data_month.reverse(), value_nps, value_requests);
            },
            error: function (data) {
              console.log('Error:', data);
            }
        });


        // var data_name = ["NPS","Request"];
        // var data_month = ["April 2017", "May 2017", "June 2017", "July 2017", "August 2017", "September 2017", "October 2017", "November 2017", "December 2017", "January 2018", "February 2018", "March 2018"];
        // var value_nps = [48.3,69.2,231.6,46.6,55.4,230,600,10,55,89,147,75];
        // var value_requests = [320, 302, 301, 334, 390, 330, 800, 85, 76, 98, 120, 78];
        // grap_user_vs_request('main_grap_user_vs_request',data_name, data_month, value_nps, value_requests);
      }
      function main_grap_avg_per_month() {
        var _token = $('input[name="_token"]').val();
        var data_count = [{value:75, name:'April 2017 = 75'},
                          {value:2, name:'May 2017 = 2'},
                          {value:1, name:'June 2017 = 1'},
                          {value:46, name:'July 2017 = 46'},
                          {value:1, name:'August 2017 = 1'},
                          {value:3, name:'September 2017 = 3'}];

        var data_name = ["April 2017 = 75","May 2017 = 2","June 2017 = 1","July 2017 = 46","August 2017 = 1","September 2017 = 3"];
        main_gra_grade_avg_per_month('main_gra_grade_avg_per_month', data_name, data_count, 'Promedio de Calificaciones', 'Mensual');
      }

    </script>
  @else
    <!--NO VER-->
  @endif
@endpush
