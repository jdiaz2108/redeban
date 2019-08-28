@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 py-3">
                <div class="row">
                    <div class="col-6">
                        <img src="https://schneidereit-berlin.de/wp-content/uploads/2019/01/platzhalter.png" class="card-img-top bg-secondary rounded" alt="...">
                    </div>
                    <div class="col-6">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if ($redeem)
                        <h2 class="text-center">{{$prize['name']}}</h2>
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title text-center">Código de seguridad</h5>
                            <form action="/redeem-validate-mail/{{$prize['code']}}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="form-group">
                                        <input class="form-control form-control-lg" type="text" name="code" placeholder="Código">
                                      </div>
                                    <button class="btn btn-primary">Redimir</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <h2 class="text-center">{{$prize['name']}}</h2>
                        <div class="card shadow my-3">
                            <div class="card-body">
                                <p class="card-text">{{$prize['description']}}</p>
                            </div>
                        </div>
                        <div class="card shadow my-3">
                            <div class="card-body">
                            <p class="card-text text-center">Valor: {{$prize['point']}} Puntos {{$redeem}}</p>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush mb-0">
                            <li class="list-group-item">Quedan: {{$prize['stock']}} unidades</li>
                        </ul>
                        <div class="card shadow my-3">
                                <div class="card-body mx-auto">
                                  @if (Auth::user()->sumpoints >= $prize['point'])
                                    <form action="/redeem-validate-mail" method="POST">
                                        @csrf
                                        <input type="hidden" name="code" value="{{$prize['code']}}">
                                        <button class="btn btn-primary">Redimir</button>
                                    </form>
                                  @else
                                    <button class="btn btn-primary disabled">Redimir</button>                                   
                                  @endif
                                </div>
                            </div>
                            @endif
                        </div>
                </div>
        </div>
    </div>
</div>
@endsection