@extends('layouts.app')

@section('content')
<div class="page catalog">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-9">
            <h2 class="title">Catálogo</h2>
            <hr class="line">
            <p class="points">Puntos {{$user->points}}</p>
          </div>
          <div class="col-3">
            @if(!is_null($user->category_id))
              <img src="{{asset($user->categoryImage($user->category_id))}}" alt="">
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="image-show">
              @if ($prize['image'])
              <img src="{{$prize['image']}}" class="img-fluid mx-auto d-block" alt="...">
              @else
              <img src="{{asset('images/image.png')}}" class="img-fluid mx-auto d-block" alt="...">
              @endif
            </div>
          </div>
          <div class="col-6 info">
          @include('layouts.messages')
          @if ($redeem && !session('redeemed'))
            <h2 class="name">{{$prize['name']}}</h2>
            <h5 class="card-title text-center">Código de seguridad</h5>
            <form action="/redeem-validate-mail/{{$prize['code']}}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="code" placeholder="Ingrese aquí el código">
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-primary btn-custom">VERIFICAR</button>
                </div>
            </form>
          @else
              @if (session('redeemed'))
                {{session('redeemed')}}
              @endif
                <h2 class="name">{{$prize['name']}}</h2>
                <p class="points">{{$prize['point']}} Puntos {{$redeem}}</p>
                <p class="description">{{$prize['description']}}</p>
                @if ($user->points >= $prize['point'])
                  <form action="/redeem-validate-mail" method="POST">
                      @csrf
                      <input type="hidden" name="code" value="{{$prize['code']}}">
                      <button class="btn btn-primary btn-custom">REDIMIR</button>
                  </form>
                @else
                  <button type="submit" class="btn btn-primary btn-custom disabled">REDIMIR</button>
                @endif
              @endif
              </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
