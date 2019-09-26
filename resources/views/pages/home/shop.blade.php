@extends('layouts.app')

@section('content')
<div class="page update-data">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
          @include('layouts.points')
          <div class="row">
              <div class="col-md-12">
                @include('layouts.messages')
              </div>
              <!-- select -->

        @if ($shop)
            <div class="col-12 col-md-5 col-lg-8 offset-lg-2 mb-4 mb-4">
                <div class="card text-white shadow h-100 code code-active">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12 h5">
                                CÓDIGO ÚNICO:<br>
                                {{$shop['code']}}
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-white">
                        <li class="list-group-item list-code">Puntos: {{$shop['totalpoints']}}</li>
                        <li class="list-group-item list-code">Meta actual: {{$shop['fulfillmentgoal']}}</li>
                        <li class="list-group-item list-code">Transacciones actuales: {{$shop['FulfillmentValue']}}</li>
                        <li class="list-group-item list-code">
                            <div class="progress" style="height: 10px;">
                            <div class="progress-bar-green" role="progressbar" style="width: {{($shop['FulfillmentValue'] * 100) / ($shop['fulfillmentgoal'] ? $shop['fulfillmentgoal'] : 1)}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <b>{{$shop['FulfillmentValue']}}</b>
                            </div>
                            <div class="col-md-6 text-right">
                                <span class="goal">{{$shop['fulfillmentgoal']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
            <!-- end select -->
        @forelse ($user->shops as $shop)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card text-white shadow h-100 code {{ session('current_shop') == $shop['code'] ? 'code-active' : 'code-inactive'}}">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12 h5">
                                CÓDIGO ÚNICO:<br>
                                {{$shop['code']}}
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-white">
                        <li class="list-group-item list-code">Puntos: {{$shop['totalpoints']}}</li>
                        <li class="list-group-item list-code">Meta actual: {{$shop['fulfillmentgoal']}}</li>
                        <li class="list-group-item list-code">Transacciones actuales: {{$shop['FulfillmentValue']}}</li>
                        <li class="list-group-item list-code">
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar-green" role="progressbar" style="width: {{($shop['FulfillmentValue'] * 100) / ($shop['fulfillmentgoal'] ? $shop['fulfillmentgoal'] : 1)}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                    <div class="card-footer text-center">
                        @if (session('current_shop') == $shop['code'])
                            <a href="#" class="btn btn-custom-yellow disabled">ACTIVO</a>
                        @else
                            <a href="/selectShop/{{$shop['code']}}" class="btn btn-custom-blue">SELECCIONAR</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card text-white shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Sin código único</h5>
                        <p class="card-text">Actualmente no tiene ningún código único relacionado, por favor póngase en contacto con soporte técnico.</p>
                    </div>
                </div>
            </div>
        @endforelse


              </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
