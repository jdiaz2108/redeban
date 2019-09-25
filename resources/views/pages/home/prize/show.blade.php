@extends('layouts.app')

@section('content')
<div class="page catalog">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
            @include('layouts.points')
        <div class="row">
          <div class="col-6">
            <div class="image-show rounded">
              @if ($prize['prize']['image'])
              <img src="{{$prize['prize']['image']}}" class="img-fluid mx-auto d-block" alt="...">
              @else
              <img src="{{asset('images/image.png')}}" class="img-fluid mx-auto d-block" alt="...">
              @endif
            </div>
          </div>
          <div class="col-6 info">
          @include('layouts.messages')
          @if ($redeem && !session('redeemed'))
            <h2 class="name">{{$prize['prize']['name']}}</h2>
            <h5 class="card-title text-center">Código de seguridad</h5>
            <form action="/redeem-validate-mail/{{$prize['id']}}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="code" placeholder="Ingrese aquí el código">
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-primary btn-custom">VERIFICAR</button>
                </div>
            </form>
          @else

          <h2 class="name">{{$prize['prize']['name']}}</h2>
          <p class="points">{{$prize['point']}} Puntos {{$redeem}}</p>
          <p class="description">{{$prize['prize']['description']}}</p>
        @if (!session('reddemed'))

                @if ($user->points >= $prize['point'])
                <form action="/redeem-validate-mail" method="POST">
                    @csrf
                    <input type="hidden" name="code" value="{{$prize['id']}}">
                    <button class="btn btn-primary btn-custom">REDIMIR</button>
                </form>
                @else

                <button type="submit" class="btn btn-primary btn-custom disabled mx-auto">TE FALTAN {{($prize['point'] - $user->points)}} PUNTOS</button>
                @endif
        @else
            @php
            session()->pull('reddemed', true)
            @endphp
        @endif
        @endif
    </div>
</div>
</div>
</div>
</div>
</div>
@endsection
