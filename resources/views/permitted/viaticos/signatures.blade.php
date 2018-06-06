@extends('layouts.app')

@section('contentheader_title')

@endsection

@section('contentheader_description')

@endsection

@section('breadcrumb_ubication')

@endsection

@section('content')
    
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{ trans('message.clienttype')}}</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <!-- <span class="label label-primary">Label</span> -->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12">
                  <form id="form_img_upload_type" name="form_img_upload_type" class="form-horizontal" enctype="multipart/form-data"  method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="select_one_type" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                      <div class="col-md-10 selectContainer">
                        <select id="select_one_type" name="select_one_type" class="form-control select2">
                          <option value="" selected> Elija </option>

                            <option value="dbff">dfgdg</option>

                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="date_type_device">{{ trans('message.date')}} </label>
                      <div class="col-md-10">
                        <input id="date_type_device" name="date_type_device"  type="text"  maxlength="7"
                          class="form-control input-md">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-12 control-label" for="dropzone_client">{{ trans('message.importarimg')}}  </label>
                      <div class="col-md-12">
                        <div id="dropzone_client" name="dropzone_client" class="dropzone"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <a id="cargarimgclient" class="btn btn-success" type="submit"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                        <a id="generateimgtypeClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- The footer of the box -->
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
          <div class="box box-solid">
              <div class="box-header with-border">
              <h3 class="box-title">{{ trans('message.contentimgband')}}</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <!-- <span class="label label-primary">Label</span> -->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12">
                  <form id="form_img_band_upload" name="form_img_band_upload" class="form-horizontal" enctype="multipart/form-data"  method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="select_one_band" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                      <div class="col-md-10 selectContainer">
                        <select id="select_one_band" name="select_one_band" class="form-control select2">
                          <option value="" selected> Elija </option>
                          
                            <option value="asdasd"> asdasd </option>
                          
                          
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="date_type_banda">{{ trans('message.date')}} </label>
                      <div class="col-md-10">
                        <input id="date_type_banda" name="date_type_banda"  type="text"  maxlength="7"
                          class="form-control input-md">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-12 control-label" for="dropzone_band">{{ trans('message.importarimg')}}  </label>
                      <div class="col-md-12">
                        <div id="dropzone_band" name="dropzone_band" class="dropzone"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <a id="cargarimgband" class="btn btn-success" type="submit"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                        <a id="clearimgband" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- The footer of the box -->
            </div>
          </div>
        </div>


      </div>
    </div>

@endsection

@push('scripts')
@if( auth()->user()->can('View individual general report') )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
<script src="{{ asset('js/admin/report/edit_reports.js')}}"></script>
@else
<!--NO VER-->
@endif
@endpush
