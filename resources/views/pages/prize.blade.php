@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 py-3 row justify-content-center">
            @foreach ($prizes as $prize)
            <div class="col-3">
                <div class="card shadow">
                  <img src="https://schneidereit-berlin.de/wp-content/uploads/2019/01/platzhalter.png" class="card-img-top bg-secondary rounded" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{$prize['name']}}</h5>
                    <p class="card-text">{{$prize['description']}}</p>
                  </div>
                  <ul class="list-group list-group-flush mb-0">
                        <li class="list-group-item">Valor: {{$prize['point']}} Puntos</li>
                        <li class="list-group-item">Quedan: {{$prize['stock']}} unidades</li>
                      </ul>
                      <div class="card-body">
                        <a class="btn btn-primary" href="prizes/{{$prize['code']}}" role="button">Ver más</a>
                      </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection