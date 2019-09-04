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
            <p class="points">Puntos {{$user->sumpoints}}</p>
          </div>
          <div class="col-3">
            @if(!is_null($user->category_id))
              <img src="{{asset($user->categoryImage($user->category_id))}}" alt="">
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div id="slider" class="cards-slider">
                @foreach ($prizes as $key => $prize)
                <div class="prize-item">
                  <div class="content-image">
                    <a href="{{url('prize',$prize['id'])}}">
                    @if ($prize['image'])
                    <img src="{{$prize['image']}}" class="img-fluid" alt="...">
                    @else
                    <img src="{{asset('images/image.png')}}" class="img-fluid" alt="...">
                    @endif
                    <span class="stock" title="Unidades">{{$prize['stock']}}</span>
                    </a>
                  </div>
                  <div class="box-text {{$colors[$key]}} text-left">
                    <p class="name" title="{{$prize['description']}}">{{$prize['name']}}</p>
                    <p class="num">{{$prize['point']}} Puntos</p>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
