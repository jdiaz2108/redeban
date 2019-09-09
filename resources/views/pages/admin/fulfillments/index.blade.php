@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-6">
            <h2 class="title">Metas y cumplimientos</h2>
            <hr class="line">
          </div>
          <div class="col-6 align-content-end">
            <form action="{{ route('admin::fulfillments.index') }}" method="GET">
              <div class="form-group row">
                <div class="col-md-8">
                  <input class="form-control input-custom2" type="search" placeholder="Nombre ó identificación" name="query">
                </div>
                <div class="col-md-4">
                  <button class="btn btn-custom-green fontSize18" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-6 text-left py-3">
            <a data-toggle="modal" data-target="#upload-fullfilments" class="btn btn-custom-green btn-sm"><i class="fa fa-upload"></i> Cargar Metas</a>
            <a data-toggle="modal" data-target="#upload-fullfilments2" class="btn btn-custom-green btn-sm"><i class="fa fa-upload"></i> Cargar Cumplimientos</a>
          </div>
          <div class="col-6 text-right py-3">
            <a data-toggle="modal" data-target="#upload-fullfilments3" class="btn btn-custom fontSize18"><i class="fa fa-cloud-download"></i> Descargar Metas</a>
            <a class="btn btn-custom fontSize18" href="{{ route('admin::liquidation') }}"><i class="fa fa-cogs"></i> Liquidar</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('layouts.messages')
              <table class="table table-striped table-custom">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Evento</th>
                          <th>Meta</th>
                          <th>Valor</th>
                          <th>Nombre Usuario</th>
                          <th>Identificación Usuario</th>
                      </tr>
                  </thead>
                  <tbody class="content-directory">
                      @forelse($fulfillments as $item)
                      <tr>
                        <td>
                          {{$item->id}}
                        </td>
                        <td>
                          {{$item->event}}
                        </td>
                        <td>
                          {{$item->goal}}
                        </td>
                        <td>
                          {{$item->value ?? 0}}
                        </td>
                        <td>
                          {{$item->user['name_company']}}
                        </td>
                        <td>
                            {{$item->user['identification']}}
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" align="center">No hay registros de carga de datos</td>
                      </tr>
                    @endforelse
                  </tbody>
              </table>
              {{$fulfillments->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Small modal -->
<div class="modal fade modal-custom" id="upload-fullfilments" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cargar Metas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form action="/dashboard/fulfillments" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Nombre <span>*</span> </label>
              <input type="text" name="event" class="form-control" placeholder="Nombre del evento" required>
            </div>
            <div class="form-group">
              <label for="">Archivo <span>*</span> </label>
              <input type="file" name="data" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom fontSize18">Cargar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Small modal -->
<div class="modal fade modal-custom" id="upload-fullfilments2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cargar Cumplimientos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="/dashboard/fulfillments/1" method="POST" enctype="multipart/form-data">
              @csrf @method('PUT')
              <div class="form-group">
                <label for="">Archivo <span>*</span> </label>
                  <input type="file" name="data" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-custom fontSize18">Cargar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Small modal -->
<div class="modal fade modal-custom" id="upload-fullfilments3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Descargar Metas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="/dashboard/csv" method="GET" enctype="multipart/form-data">
            @csrf
              {{-- @method('PUT') --}}
              <div class="form-group">
                <label for="event">Seleccione el evento:</label>
                <select class="form-control" id="event" name="event" required>
                    @forelse ($grouped as $item)
                        <option>{{$item}}</option>
                    @empty
                        <option>2</option>
                    @endforelse
                </select>
              </div>
              <button type="submit" class="btn btn-custom fontSize18">Descargar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
