@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-6">
            <h2 class="title">Historial carga de archivos</h2>
            <hr class="line">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              @if (session('status'))
              <div class="alert alert-success status">
                  {{ session('status') }}
              </div>
              @endif
              @if (session('error'))
              <div class="alert alert-warning error">
                  {{ session('error') }}
              </div>
              @endif
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <table class="table table-striped table-custom">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Archivo cargado</th>
                          <th>Total registros</th>
                          <th>Registros inválidos</th>
                          <th>CSV inválidos</th>
                          <th>Fecha</th>
                      </tr>
                  </thead>
                  <tbody class="content-directory">
                      @forelse($history as $item)
                      <tr>
                        <td>
                          {{$item->id}}
                        </td>
                        <td>
                          {{$item->original_file_name}}
                        </td>
                        <td>
                          {{$item->records_count}}
                        </td>
                        <td>
                          {{$item->invalid_records ?? 0}}
                        </td>
                        <td>
                          @if (!is_null($item->invalid_records))
                          <a href="{{url('data/csv/'.$item->id)}}">Descargar</a>
                          @else
                          -
                          @endif
                        </td>
                        <td>
                          {{$item->created_at}}
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" align="center">No hay registros de carga de datos</td>
                      </tr>
                    @endforelse
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Small modal -->
<div class="modal fade" id="upload-fullfilments" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cargar Metas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/fulfillments" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="event" class="form-control" placeholder="Nombre del evento" required>
            </div>
            <div class="form-group">
                <input type="file" name="data" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cargar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Small modal -->
<div class="modal fade" id="upload-fullfilments2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cargar Cumplimientos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/dashboard/fulfillments/1" method="POST" enctype="multipart/form-data">
              @csrf @method('PUT')
              <div class="form-group">
                  <input type="file" name="data" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary">Cargar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
