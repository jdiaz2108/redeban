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
          <div class="col-md-7">
            <form action="{{ route('admin::users.index') }}" method="GET">
              <div class="form-group row">
                <div class="col-md-7">
                  {{-- <input class="form-control input-custom2" type="search" placeholder="Nombre ó identificación" name="query"> --}}
                </div>
                <div class="col-md-5 text-center">
                  {{-- <button class="btn btn-custom fontSize18" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button> --}}
                </div>
              </div>
            </form>
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
                      </tr>
                      @empty
                      <tr>
                          <td colspan="9" class="alert aler-warning">
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
