@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
          @include('layouts.points', ['title' => 'Historial de puntos'])
        <div class="row">
            <div class="col-md-9">
                    @include('layouts.messages')
                    <div class="table-responsive-md">
                <table class="table table-custom table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Concepto</th>
                            <th>Puntos</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="content-directory">
                        @forelse($historyPoints['points'] as $point)
                        <tr>
                          <td>{{$point->id}}</td>
                          <td>{{$point->event}}</td>
                          <td>{{$point->value}}</td>
                          <td>{{$point->created_at}}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="4" align="center">No existen registros</td>
                        </tr>
                      @endforelse
                    </tbody>
                </table>
                    </div>
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
