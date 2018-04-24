@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.subtitle_move_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.breadcrumb_move_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View move equipment') )
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
                </div>
                </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="hojitha" style="background-color: #fff; border:1px solid #ccc; border-bottom-style:hidden; padding:10px; width: 100%">
             <div class="row">
               <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                 <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                   Equipamiento - Actual
                 </h4>
               </div>
               <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                   <form id="table_check" method="POST">
                      <table id="table_qualification" cellspacing="0" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr class="bg-primary" style="background: #088A68;">
                            <th> <small>0</small> </th>
                            <th> <small>Cliente.</small> </th>
                            <th> <small>Equipo.</small> </th>
                            <th> <small>Marca.</small> </th>
                            <th> <small>Mac.</small> </th>
                            <th> <small>Serie.</small> </th>
                            <th> <small>Modelo.</small> </th>
                            <th> <small>Estado.</small> </th>
                            <th> <small>Fecha Alta.</small> </th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot id='tfoot_average'>
                          <tr>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="select_two" class="control-label">Hotel Destino: </label>
                          <select id="select_two" name="select_two"  class="form-control select2" required>
                             <option value="" selected> Elija </option>
                             @forelse ($hotels as $data_hotel_two)
                               <option value="{{ $data_hotel_two->id }}"> {{ $data_hotel_two->Nombre_hotel }} </option>
                             @empty
                             @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="select_two" class="control-label">Estatus: </label>
                          <select id="select_two" name="select_two"  class="form-control select2" required>
                             <option value=""> Elija </option>
                             <option value="999" selected> Conservar estados </option>
                             @forelse ($estados as $data_estados)
                               <option value="{{ $data_estados->id }}"> {{ $data_estados->Nombre_estado }} </option>
                             @empty
                             @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                           <button type="button" class="btn btn-info btnconf">Mover</button>
                        </div>
                        <pre id="example-console-rows"></pre>
                      </div>
                      <!-- <p><b>Selected rows data:</b></p>
                      <pre id="example-console-rows"></pre> -->
                   </form>
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
  @if( auth()->user()->can('View move equipment') )
    <script src="{{ asset('js/admin/equipment/move_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
