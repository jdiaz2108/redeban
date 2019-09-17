@extends('layouts.app')

@section('content')
<div class="page update-data">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-9">
            <h2 class="name-company">{{$user->name_company}}</h2>
            <hr class="line">
            <p class="points">Puntos {{$user->sumpoints}}</p>
          </div>
          <div class="col-3">
            @if(!is_null($user->category_id))
              <img src="{{asset($user->categoryImage($user->category_id))}}" alt="">
            @endif
          </div>
        </div>
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
                  <div class="card" style="width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Empty</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
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
