@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-md-5">
            <h2 class="title">Puntos</h2>
            <hr class="line">
          </div>
          <div class="col-md-7">
            <form action="{{ route('admin::points.index') }}" method="GET">
              <div class="form-group row">
                <div class="col-md-7">
                  <input class="form-control input-custom2" type="search" placeholder="Nombre ó identificación" name="query">
                </div>
                <div class="col-md-5 text-center">
                  <button class="btn btn-custom fontSize18" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('layouts.messages')
              <table class="table table-striped table-custom">
                  <thead>
                      <tr>
                          <th>Evento</th>
                          <th>Valor</th>
                          <th>Usuario Nombre</th>
                          <th>Identificacion</th>
                          <th>Fecha</th>
                      </tr>
                  </thead>
                  <tbody class="content-directory">
                      @forelse($points as $item)
                      <tr>
                          <td>{{$item->event}}</td>
                          <td>{{$item->value}}</td>
                          <td>{{$item->user->name_company}}</td>
                          <td>{{$item->user->identification}}</td>
                          <td>{{$item->created_at}}</td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="5" class="alert aler-warning">
                              <center>No existen registros.</center>
                          </td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
              {{$points->links()}}
          </div>
        </div>
    </div>
</div>
@endsection
