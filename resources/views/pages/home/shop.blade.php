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
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        @if (session('current_shop') == $shop['code'])
                            <a href="/shop/{{$shop['code']}}" class="btn btn-primary disabled">Tienda seleccionada</a>
                        @else
                            <a href="/shop/{{$shop['code']}}" class="btn btn-primary">Seleccionar tienda</a>
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
