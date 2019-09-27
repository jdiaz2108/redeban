@extends('layouts.app')

@section('content')
<div class="page catalog">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
            @include('layouts.points', ['title' => 'Catálogo'])
        <div class="row">
          <div class="col-12">
            <div id="slider" class="cards-slider">
                @foreach ($prizes as $key => $prize)
                <div class="prize-item mx-1">
                        <a href="{{url('prize',$prize['code'])}}">
                    <div class="row px-2">
                        <div class="col-6 p-0">
                            <div class="content-image" >
                              @if ($prize['prize']['image'])
                              <img src="{{$prize['prize']['image']}}" class="img-fluid" width="170" alt="...">
                              @else
                              <img src="{{asset('images/image.png')}}" class="img-fluid" alt="...">
                              @endif
                            </div>
                        </div>
                        <div class="col-6 p-0 h-100">
                            <div class="box-text {{$colors[$key]}} text-left shadow">
                            <p class="name text-center m-0" title="{{$prize['prize']['description']}}">{{$prize['prize']['name']}}</p>
                        </div>
                        <div class="text-truncate py-3 px-2 text-white">
                            {{$prize['prize']['description']}}
                        </div>
                        <div class="d-flex align-items-end">
                                <p class="num text text-center mx-auto {{$colors[$key]}}">{{$prize['point']}} Puntos</p>
                        </div>
                        </div>
                    </div>
                </a>
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
