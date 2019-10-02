@extends('layouts.app')

@section('content')
<div class="page dashboard">
  <div class="container">
      <div class="row">
        <div class="col-md-4 text-center">
          <div class="card-info">
            <p class="name"><i class="fa fa-users"></i> &nbsp; Usuarios </p>
            <p class="num">{{$users}}</p>
            <p class="small">Total de usuarios registrados</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card-info card2">
            <p class="name"><i class="fa fa-asterisk"></i> &nbsp; Codigos Unicos </p>
            <p class="num">{{$shops}}</p>
            <p class="small">Total de codigos unicos registrados</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card-info card3">
            <p class="name"><i class="fa fa-shopping-cart"></i> &nbsp; Premios </p>
            <p class="num">{{$prizes}}</p>
            <p class="small">Numero de premios disponibles</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card-info card4">
            <p class="name"><i class="fa fa-ticket"></i> &nbsp; Redenciones </p>
            <p class="num">{{$coupons}}</p>
            <p class="small">Numero de redenciones realizadas</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card-info">
              <p class="name"><i class="fa fa-address-card"></i> &nbsp; Usuarios Activos </p>
              <p class="num">{{$userDataCount}}</p>
              <p class="small">Total de usuarios datos actualizados</p>
            </div>
          </div>
      </div>
          <div class="row">
        <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_access_users" class="container_access_users"></div>
        </div>
        <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_users_categories" class="container_users_categories"></div>
        </div>
        <div class="col-md-4 d-none">
          <br> <br>
          <div style="max-height:370px;overflow-y:auto;">
            <table id="prizes_oro" class="table table-strop text-white">
              <thead>
                  <tr class="active">
                      <th>Premio</th>
                      <th>Inventario</th>
                      <th>Redimidos</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($prizes_categories as $item)
                  @if($item->category->id == 1)
                  <tr>
                    <td>{{$item->prize->name}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->redeem($item->id)}}</td>
                  </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
            <table id="prizes_plata" class="table table-strop text-white">
              <thead>
                  <tr class="active">
                      <th>Premio</th>
                      <th>Inventario</th>
                      <th>Redimidos</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($prizes_categories as $item)
                  @if($item->category->id == 2)
                  <tr>
                    <td>{{$item->prize->name}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->redeem($item->id)}}</td>
                  </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
            <table id="prizes_bronce" class="table table-strop text-white">
              <thead>
                  <tr class="active">
                      <th>Premio</th>
                      <th>Inventario</th>
                      <th>Redimidos</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($prizes_categories as $item)
                  @if($item->category->id == 3 || $item->category->id == 4 || $item->category->id == 5)
                  <tr>
                    <td>{{$item->prize->name}} - {{$item->category->name}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->redeem($item->id)}}</td>
                  </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_prizes_oro" class="container_prizes_oro"></div>
        </div> --}}
        <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_prizes_plata" class="container_prizes_plata"></div>
        </div>
        <div class="col-md-6 text-center">
          <br> <br>
          <div id="container_prizes_bronce" class="container_prizes_bronce"></div>
        </div>
        <div class="col-md-12 text-center">
          <br> <br>
          <div id="container_sections" class="container_sections"></div>
        </div>
        <div class="col-md-12 text-center">
          <br> <br>
          <div id="container_fulfillments_category" class="container_fulfillments_category"></div>
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
