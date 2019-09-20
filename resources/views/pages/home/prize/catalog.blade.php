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
          <div class="col-12">
            <div id="slider" class="cards-slider">
                @foreach ($prizes as $key => $prize)
                <div class="prize-item">
                  <div class="content-image rounded-top shadow" >
                    <a href="{{url('prize',$prize['id'])}}">
                    @if ($prize['prize']['image'])
                    <img src="{{$prize['prize']['image']}}" class="img-fluid" width="170" alt="...">
                    @else
                    <img src="{{asset('images/image.png')}}" class="img-fluid" alt="...">
                    @endif
                    </a>
                  </div>
                  <div class="box-text {{$colors[$key]}} text-left rounded-bottom shadow">
                    <p class="name" title="{{$prize['prize']['description']}}">{{$prize['prize']['name']}}</p>
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
