@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">Historial de puntos</div>
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
                                            <th>Concepto</th>
                                            <th>Puntos</th>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody class="content-directory">
                                        @forelse($historyPoints as $point)
                                        <tr>
                                          <td>
                                            {{$point->id}}
                                          </td>
                                          <td>
                                            {{$point->event}}
                                          </td>
                                          <td>
                                            {{$point->value}}
                                          </td>
                                          <td>
                                            {{$point->month}}
                                          </td>
                                          <td>
                                            {{$point->year}}
                                          </td>
                                          <td>
                                            {{$point->created_at}}
                                          </td>
                                        </tr>
                                      @empty
                                        <tr>
                                          <td colspan="6" align="center">No existen registros</td>
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