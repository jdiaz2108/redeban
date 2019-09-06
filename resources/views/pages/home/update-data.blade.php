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
              <div class="col-md-2"></div>
              <div class="col-md-8 text-center content-update">
                <h3>Actualización de datos</h3>
                @include('layouts.messages')
                <form action="{{$action}}" class="form-update" method="POST">
                    @if ($user->updated)
                      @method('PUT')
                    @endif
                    @csrf
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/name.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="name" type="text" class="input-custom  @error('name') is-invalid @enderror"
                          value="{{$updatedData->name}}" placeholder="Nombre encargado">
                      </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/email.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="email" type="text" class="input-custom @error('email') is-invalid @enderror" value="{{$updatedData->email}}" placeholder="Correo electrónico">
                      </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/cellphone.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="phone" type="text" class="input-custom @error('phone') is-invalid @enderror" value="{{$updatedData->phone}}" placeholder="Telefono ó celular">
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
                        <input name="address" type="text" class="input-custom @error('address') is-invalid @enderror" value="{{$updatedData->address}}" placeholder="Dirección">
                      </div>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/city.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="city_id" type="text" class="input-custom @error('city_id') is-invalid @enderror" value="{{$updatedData->city_id}}" placeholder="Ciudad">
                      </div>
                      @error('city_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-custom">ENVIAR</button>
                    </div>
                </form>
                  </div>
              </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
