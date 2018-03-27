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

                      <form id="form_reg_survey" name="form_reg_survey" class="form-horizontal" method="POST" action="{{ url('create_data_client') }}">
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
                          <label class="col-md-2 control-label" for="month_upload_band">{{ trans('message.domic')}} </label>
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


        </div>
      </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View config sitwifi') )
  <script type="text/javascript">
    $('#select_ind_one').on('change', function(e){
        var domain= $(this).val();

    });
  </script>
  @else
    <!--NO VER-->
  @endif
@endpush
