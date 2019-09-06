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
            @include('layouts.messages')
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

@endsection
