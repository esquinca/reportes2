@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View assign report') )
    {{ trans('message.title_reports') }}
  @else
    {{ trans('message.title_reports') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View assign report') )
    {{ trans('message.subtitle_assign_report') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View assign report') )
    {{ trans('message.breadcrumb_assign_report') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View assign report') )
      <div class="container">
          <div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="box box-solid">
                  <div class="box-body">
                    <div class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_one" class="control-label">{{ trans('message.hotel') }}: </label>
                          <select id="select_one" name="select_one"  class="form-control select2" required>
                            <option value="" selected> Elija </option>
                            @forelse ($hotels as $data_hotel)
                              <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="select_two" class="control-label">{{ trans('message.type') }}: </label>
                          <select id="select_two" name="select_two"  class="form-control select2" required>
                            <option value="" selected> Elija </option>
                            @forelse ($types as $data_types)
                              <option value="{{ $data_types->id }}"> {{ $data_types->name }} </option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info btngeneral"><i class="fa fa-bullseye margin-r5"></i> {{ trans('message.generate') }}</button>
                        </div>
                    </div>
                   </div>
                </div>
              </div>


              <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="box box-solid">
                  <div class="box-body">
                    <div class="media">
                      <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                          Generado el día @php
                            $mytime = Carbon\Carbon::now();
                            echo $mytime->toDateTimeString();
                          @endphp
                      </h4>
                      <div class="media">
                          <div class="media-body">
                              <div class="clearfix">
                                  <div style="margin-top: 0">
                                    <div id="main_nationality" style="width: 100%; min-height: 250px; border:1px solid #ccc;padding:10px;"></div>
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
  @if( auth()->user()->can('View assign report') )
    <script src="{{ asset('js/admin/report/view_reports.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
