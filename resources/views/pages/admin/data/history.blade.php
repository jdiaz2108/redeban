@extends('layouts.app')

@section('content')
<div class="page dashboard">
<div class="container">
    <div class="row">
        <div class="col-md-12 m-t-40" style="background-color:#fff;">
          <div class="row">
            <div class="col-md-12 banner-bells">
              <div class="row">
                <div class="col-md-10">
                  <h2 class="title-bells">Historial de cargas</h2>
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12"><hr></div>
                   <table class="table">
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
                    <tbody>
                      @forelse($history as $item)
                        <tr>
                          <td>
                            {{$loop->iteration}}
                          </td>
                          <td>
                            {{$item->original_file_name}}
                          </td>
                          <td>
                            {{$item->records_count}}
                          </td>
                          <td>
                            $item->invalid_records
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
                  <div class="col-md-12 text-right">
                    <div class="pag-prize">
                        $history->links()
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>
@endsection