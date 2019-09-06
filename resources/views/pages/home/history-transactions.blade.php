@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-9">
            <h2 class="title">Historial de transacciones <span class="line">|</span> <span class="points">Puntos {{$user->sumpoints}}</span></h2>
          </div>
          <div class="col-3">
            @if(!is_null($user->category_id))
              <img src="{{asset($user->categoryImage($user->category_id))}}" alt="">
            @endif
          </div>
        </div>
        <div class="row">
            <div class="col-md-9">
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
                <table class="table table-custom table-striped">
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Meta</th>
                            <th>Transacciones</th>
                        </tr>
                    </thead>
                    <tbody class="content-directory">
                        @forelse($historyFulfillment as $fulfillment)
                        <tr>
                            <td>{{$fulfillment['event']}}</td>
                            <td>{{$fulfillment['goal']}}</td>
                            <td>{{$fulfillment['value'] ?? 0}}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="4" align="center">No existen registros</td>
                        </tr>
                      @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
              <img src="{{asset('images/datafono.png')}}" class="img-fluid" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
