@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View history travel requests') )
    {{ trans('message.viaticos_history_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View history travel requests') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View history travel requests') )
    {{ trans('message.breadcrumb_viaticos_hist') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View history travel requests') )
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="table-responsive">
            <form id="table_check" method="POST">
               <table id="table_qualification" cellspacing="0" class="table table-striped table-bordered table-hover">
                 <thead>
                   <tr class="bg-primary" style="background: #088A68;">
                     <th> <small>Folio</small> </th>
                     <th> <small>Id Proyecto.</small> </th>
                     <th> <small>Servicio.</small> </th>
                     <th> <small>Proyecto.</small> </th>
                     <th> <small>Fecha Inicio.</small> </th>
                     <th> <small>Fecha Fin.</small> </th>
                     <th> <small>Lugar Destino.</small> </th>
                     <th> <small>Monto.</small> </th>
                     <th> <small></small> </th>
                   </tr>
                 </thead>
                 <tbody>
                 </tbody>
                 <tfoot id='tfoot_average'>
                   <tr>
                   </tr>
                 </tfoot>
               </table>
               
            </form>
          </div>
        </div>
      </div>
    </div>

    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View history travel requests') )

  @else
    <!--NO VER-->
  @endif
@endpush
