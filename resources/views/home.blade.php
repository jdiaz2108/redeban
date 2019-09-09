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
            <p class="name"><i class="fa fa-users"></i> &nbsp; Metas </p>
            <p class="num">{{$fulfillments}}</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="card-info card3">
            <p class="name"><i class="fa fa-users"></i> &nbsp; Premios </p>
            <p class="num">{{$prizes}}</p>
          </div>
        </div>
        <div class="col-md-3 text-center">
          <div class="card-info card4">
            <p class="name"><i class="fa fa-users"></i> &nbsp; Renciones </p>
            <p class="num">{{$coupons}}</p>
          </div>
        </div>
        <div class="col-md-12 text-center">
          <br> <br>
          <div id="container_access_users"></div>
        </div>
      </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="{{asset('js/custom/reports.js')}}"></script>
@endsection
