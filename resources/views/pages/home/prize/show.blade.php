@extends('layouts.app')

@section('content')
<div class="page catalog">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 content-page">
                @include('layouts.points')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="image-show rounded">
                            @if ($prize['prize']['image'])
                                <img src="{{$prize['prize']['image']}}" class="img-fluid mx-auto d-block" alt="...">
                            @else
                                <img src="{{asset('images/image.png')}}" class="img-fluid mx-auto d-block" alt="...">
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6 info">
                        @include('layouts.messages')
                        @if ($shop->hascoupon && !session('reddemed'))
                            <h2 class="name">{{$prize['prize']['name']}}</h2>
                            <p class="points">{{$prize['point']}} Puntos {{$redeem}}</p>
                            <p class="description">{{$prize['prize']['description']}}</p>
                            <button class="btn btn-primary btn-custom disabled mx-auto">YA HAS REDIMIDO UN PREMIO ESTE MISMO MES</button>
                        @else
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
                                        <button class="btn btn-primary btn-custom"  data-toggle="modal" data-target="#myModal2">REDIMIR</button>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-custom disabled mx-auto">TE FALTAN {{($prize['point'] - $user->points)}} PUNTOS</button>
                                    @endif
                                @else
                                    @php
                                        session()->pull('reddemed', true)
                                    @endphp
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-points">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VERIFICA TU DIRECCIÓN</h5>
            </div>
            <div class="modal-body">
                <p>
                   Verifica que tu dirección y número de contacto esten correctos para hacer válida tu redención.
                </p>

                <form action="/redeem-validate-mail" class="form-update p-4" method="POST">
                    @csrf
                    <input type="hidden" name="code" value="{{$prize['id']}}" >
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/cellphone.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="phone" type="text" class="input-custom @error('phone') is-invalid @enderror"
                        value="{{$user->userData->phone}}" placeholder="Teléfono fijo o celular" required>
                      </div>
                      @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/address.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="address" type="text" class="input-custom @error('address') is-invalid @enderror"
                         value="{{$user->userData->address}}" placeholder="Dirección" required>
                      </div>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  row row-input">
                      <div class="col-md-12">
                        <strong class="text-white">Tu ciudad actual es: {{$city}}</strong>
                      </div>
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/city.png')}}" alt="">
                      </div>
                      <div class="col-md-5">
                        <select class="select-custom" id="department_id">
                          <option value="" disabled selected>Selecione una opción</option>
                          @foreach($departments as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-5">
                        <select name="city_id" id="city_id" type="text" class="select-custom @error('city_id') is-invalid @enderror" placeholder="Ciudad">
                          <option value="" disabled selected>Selecione una opción</option>
                        </select>
                      </div>
                      @error('city_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group mt-5 text-center">
                      <button type="submit" class="btn btn-primary btn-custom">CONFIRMAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
