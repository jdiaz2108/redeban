@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">Historial de metas</div>
                            <div class="col-md-10 text-right">
                              <a class="btn btn-primary btn-sm" href="/dashboard/fulfillments/create" role="button">Cargar <i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                            {{$item->invalid_records}}
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
    </div>
@endsection