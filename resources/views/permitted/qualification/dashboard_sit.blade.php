@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard sitwifi') )
    {{ trans('message.dashboard') }}
  @else
    {{ trans('message.dashboard') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard sitwifi') )
    {{ trans('message.subtitle_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard sitwifi') )
    {{ trans('message.breadcrumb_survey_sit') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard sitwifi') )
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="row">
            <form id="search_info" name="search_info" class="form-inline" method="post">
              {{ csrf_field() }}
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="select_surveys" class="col-md-4 control-label">{{ trans('message.survey') }}</label>
                  <div class="col-md-8 selectContainer">
                    <select id="select_surveys" name="select_surveys"class="form-control select2">
                      <option value="" selected> Elija </option>
                      @forelse ($surveys as $data_survey)
                      <option value="{{ $data_survey->id }}"> {{ $data_survey->name }} </option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input id="date_to_search" type="text" class="form-control" name="date_to_search">
                </div>
              </div>
              <div class="col-sm-7">
                <button id="boton-aplica-filtro" type="button" class="btn btn-info filtrarDashboard">
                  <i class="glyphicon glyphicon-filter" aria-hidden="true"></i>  Filtrar
                </button>
              </div>
            </form>
          </div>
        </div>

        <div id="preguntithas">

        </div>
      </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View dashboard sitwifi') )
  <style media="screen">
    .pt-10 {
      padding-top: 10px;
    }
  </style>
  <script type="text/javascript">
    $(function() {
      $('#date_to_search').datepicker({
        language: 'es',
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        endDate: '1m',
        autoclose: true,
        clearBtn: true
      });
      $('#date_to_search').val('').datepicker('update');

    });

    $('.filtrarDashboard').on('click', function(){
      consultar();
    });

    function consultar() {
      var objData = $('#search_info').find("select,textarea, input").serialize();

      var date_cor= $('#date_to_search').val();
      var _token = $('input[name="_token"]').val();

      var id_pregunt ="";
      var contenido ="";

      $.ajax({
          type: "POST",
          url: "/get_data_survey_ys",
          data: objData,
          success: function (data){
            // console.log(data);
            $('#preguntithas').empty();
            for (var i = 0; i < data.length; i++) {
              id_pregunt = data[i].id;
              $.ajax({
                 type: "POST",
                 url: "/get_data_result_q",
                 data: { date : date_cor, question: id_pregunt, _token : _token },
                 success: function (data){
                   var des =JSON.parse(data);
                   $("#preguntithas").append(
                     '<div class="col-md-4 pt-10"><div class="box box-widget widget-user-2"><div class="widget-user-header bg-yellow"><h5>'
                        +des[0].pregunta+
                        '</h5></div><div class="box-footer no-padding">'+'<ul class="nav nav-stacked">'
                        +
                        '<li><a href="javascript: void(0);">Promotor<span class="pull-right badge bg-green">'+des[0].PR+'</span></a></li>'
                        +
                        '<li><a href="javascript: void(0);">Pasivo<span class="pull-right badge bg-yellow">'+des[0].PS+'</span></a></li>'
                        +
                        '<li><a href="javascript: void(0);">Detractor<span class="pull-right badge bg-red">'+des[0].D+'</span></a></li>'
                        +'</ul>'+'</div></div></div>');
                 },
                 error: function (data) {
                   console.log('Error:', data);
                 }
              });

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
