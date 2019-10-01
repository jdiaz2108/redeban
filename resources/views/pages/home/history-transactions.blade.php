@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
            @include('layouts.points', ['title' => 'Historial de transacciones'])
        <div class="row">
            <div class="col-md-9">
                    @include('layouts.messages')
                    <div class="table-responsive-md">
                <table class="table table-custom table-striped">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Año</th>
                            <th>Meta</th>
                            <th>Transacciones</th>
                        </tr>
                    </thead>
                    <tbody class="content-directory">
                        @forelse($historyFulfillment as $fulfillment)
                        <tr>
                            @php
                                $date = Carbon\Carbon::createFromFormat('m', $fulfillment['month'])->locale('es');
                            @endphp
                            <td class="text-capitalize">{{ $date->getTranslatedMonthName('Do MMMM')}}</td>
                            <td>{{$fulfillment['year']}}</td>
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
