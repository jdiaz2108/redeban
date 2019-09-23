@extends('layouts.app')

@section('content')
<div class="page dashboard">
  <div class="container">
      <div class="row">
        <div class="col-md-3 text-center">
          <div class="card-info">
            <p class="name"><i class="fa fa-users"></i> &nbsp; Usuarios </p>
            <p class="num">{{$users}}</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="card-info card2">
            <p class="name"><i class="fa fa-star"></i> &nbsp; Metas </p>
            <p class="num">{{$fulfillments}}</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="card-info card3">
            <p class="name"><i class="fa fa-shopping-cart"></i> &nbsp; Premios </p>
            <p class="num">{{$prizes}}</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="card-info card4">
            <p class="name"><i class="fa fa-ticket"></i> &nbsp; Redenciones </p>
            <p class="num">{{$coupons}}</p>
          </div>
        </div>
        <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_access_users"></div>
        </div>
        <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_users_categories"></div>
        </div>
        <div class="col-md-4">
          <br> <br>
          <div style="max-height:370px;overflow-y:auto;">
            <table id="prizes" class="table table-strop text-white">
              <thead>
                  <tr class="active">
                      <th>Premio - Categoria</th>
                      <th>Inventario</th>
                      <th>Redimidos</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($prizes_categories as $item)
                  <tr>
                    <td>{{$item->prize->name}} - {{$item->category->name}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->redeem($item->id)}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-8 text-center">
          <br> <br>
          <div id="container_prizes"></div>
        </div>
      </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="{{asset('js/custom/reports.js')}}"></script>
@endsection
