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
              <form class="form-inline" method="post">
                {{ csrf_field() }}
                <div class="col-sm-2">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input id="date_to_search" type="text" class="form-control" name="date_to_search">
                  </div>
                </div>
                <div class="col-sm-10">
                  <button id="boton-aplica-filtro" type="button" class="btn btn-info">
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
                            <span class="info-box-number">410</span>

                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-yellow"><i class="fa fa-meh-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Pasivos</span>
                            <span class="info-box-number">13,648</span>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-red"><i class="fa fa-frown-o"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text pt-10">Defractores</span>
                            <span class="info-box-number">93,139</span>
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
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <th class="text-center">Año</th>
                                  <th class="text-center">NPS</th>
                                </tr>
                                <tr>
                                  <td>2016</td>
                                  <td>65</td>
                                </tr>
                                <tr>
                                  <td>2017</td>
                                  <td>64</td>
                                </tr>
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
    <style media="screen">
      .pt-10 {
        padding-top: 10px;
      }
    </style>
    <script type="text/javascript">
      $(function() {
        data_nps();
        graph_nps();
        graph_nps_per_month();
        main_grap_user_vs_request();
        main_grap_avg_per_month();
      });

      function data_nps(){
        var _token = $('input[name="_token"]').val();
        $('#total_survey').text(200);
        $('#answered').text(181);
        $('#unanswered').text(9);
        graph_gauge('main_nps', 'NPS', '100', '100', '43');
      }
      function graph_nps() {
        var _token = $('input[name="_token"]').val();
        var data_count1 = [{value:98, name:'Promotores = 98'},{value:62, name:'Pasivos = 62'},{value:21, name:'Detractores = 21'}];
        var data_name1 = ["Promotores = 98","Pasivos = 62","Detractores = 21"];
        graph_pie_default_four_with_porcent('main_grap_nps', data_name1, data_count1, 'Grafica', 'NPS', 'left');
      }
      function graph_nps_per_month() {
        var _token = $('input[name="_token"]').val();
        var data_name = ["Promotores","Pasivos","Detractores"];
        var data_month = ["September 2016","October 2016", "November 2016", "December 2016", "January 2017", "February 2017", "March 2017"];

        var value_promotores = [320, 302, 301, 234, 390, 330, 800];
        var value_pasivos = [132, 202, 101, 314, 90, 330, 600];
        var value_detractores = [120, 402, 231, 134, 130, 430, 100];

        graph_bar_with_three_val_insideRight('main_grap_nps_per_month',data_name, data_month, value_promotores, value_pasivos, value_detractores);
      }
      function main_grap_user_vs_request() {
        var _token = $('input[name="_token"]').val();
        var data_name = ["NPS","Request"];
        var data_month = ["April 2017", "May 2017", "June 2017", "July 2017", "August 2017", "September 2017", "October 2017", "November 2017", "December 2017", "January 2018", "February 2018", "March 2018"];
        var value_nps = [48.3,69.2,231.6,46.6,55.4,230,600,10,55,89,147,75];
        var value_requests = [320, 302, 301, 334, 390, 330, 800, 85, 76, 98, 120, 78];
        grap_user_vs_request('main_grap_user_vs_request',data_name, data_month, value_nps, value_requests);
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
