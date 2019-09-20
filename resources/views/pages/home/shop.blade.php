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
              @forelse ($user->shops as $shop)
                  <div class="col-12 col-md-6 col-lg-4 mb-4">
                  <div class="card text-white bg-secondary shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Codigo: {{$shop['code']}}</h5>
                    </div>
                    <ul class="list-group list-group-flush text-white">
                    <li class="list-group-item list-group-item-dark">Puntos: {{$shop['totalpoints']}}</li>
                        <li class="list-group-item list-group-item-dark">Meta actual: {{$shop['fulfillmentgoal']}}</li>
                        <li class="list-group-item list-group-item-dark">Vestibulum at eros</li>
                    </ul>
                      <div class="card-body">
                        @if (session('current_shop') == $shop['code'])
                            <a href="/selectShop/{{$shop['code']}}" class="btn btn-primary disabled">Punto de venta actual</a>
                        @else
                            <a href="/selectShop/{{$shop['code']}}" class="btn btn-primary">Seleccionar tienda</a>
                        @endif
                      </div>
                    </div>
                </div>
                  @empty
                  <div class="col-12">
                    <div class="card text-white bg-secondary shadow h-100">
                        <div class="card-body">
                        <h5 class="card-title">Sin punto de venta</h5>
                          <p class="card-text">Actualmente no tiene ningún punto de venta relacionado, por favor póngase en contacto con soporte técnico.</p>
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
