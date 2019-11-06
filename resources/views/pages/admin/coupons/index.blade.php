@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-md-5">
            <h2 class="title">Cupones y Redenciones</h2>
            <hr class="line">
          </div>
          <div class="col-md-7 text-right">
                <a href="{{url('dashboard/coupons-download')}}" class="btn btn-custom-green btn-sm"><i class="fa fa-cloud-download"></i> Descargar Cupones</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('layouts.messages')
            <div class="table-responsive">
              <table class="table table-striped table-custom">
                  <thead>
                      <tr>
                          <th>Codigo redención</th>
                          <th>Codigo Tienda</th>
                          <th>Nombre premio</th>
                          <th>Nit usuario</th>
                          <th>Nombre usuario</th>
                          <th>Fecha creación</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                      </tr>
                  </thead>
                  <tbody class="content-directory">
                      @forelse($coupons as $item)
                      <tr>
                          <td>
                              {{$item->code}}
                          </td>
                          <td>
                              {{$item->shopcode}}
                          </td>
                          <td>
                              {{$item->prizename}}
                          </td>
                          <td>
                              {{$item->usernit}}
                          </td>
                          <td>
                              {{$item->username}}
                          </td>
                          <td>
                              {{$item->created_at}}
                          </td>
                          <td class="{{($item->redeem) ? 'text-primary' : 'text-warning'}}">
                            {{($item->redeem) ? 'Premio redimido' : 'Premio sin redimir'}}
                        </td>
                          <td>
                            <div class="dropdown">
                                <button class="btn btn-default border border-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{url('dashboard/coupons/'.$item->id.'/changeState')}}">{{($item->redeem) ? 'Cancelar Redención' : 'Redimir'}}</a>
                                </div>
                            </div>
                          </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="7" class="alert aler-warning">
                              <center>No existen registros.</center>
                          </td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
            </div>
              {{$coupons->links()}}
          </div>
          {{-- <div class="col-md-12 text-right">
            <a href="{{ route('admin::user.point') }}" class="btn btn-custom float-left"><i class="fa fa-cloud-download"></i> Descargar usuarios y puntos</a>
          </div> --}}
        </div>
    </div>
</div>
@endsection
